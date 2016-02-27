import sys
# import time
import os.path
import xml.etree.cElementTree as ET
from urllib2 import urlopen
from xml.dom import minidom


def get_hot_cold(hidden, local):
    if hidden == "Y" or local == "Y":
        return "Y"
    elif local == "N" or hidden == "N":
        return "N"
    else:
        return ""


def write_data(zip_code, ele_num, addy_list, merch_name, long_list, lat_list, hidden_list, local_list, city, state,
               zip):
    try:
        # data_time = int(time.time())
        # file_name = str(zip_code) + "-" + str(data_time)
        file_name = str(zip_code)
        root = ET.Element("MerchantPOIList")
        for element in range(ele_num):
            try:
                if str(addy_list[element].firstChild.nodeValue) == "" or \
                                str(merch_name[element].firstChild.nodeValue) == "" or \
                                str(long_list[element].firstChild.nodeValue) == "" or \
                                str(lat_list[element].firstChild.nodeValue) == "" or \
                                str(hidden_list[element].firstChild.nodeValue) == "" or \
                                str(local_list[element].firstChild.nodeValue) == "":
                    pass
                else:
                    doc = ET.SubElement(root, "MerchantPOIArray")
                    merchant = ET.SubElement(doc, "MerchantName")
                    address = ET.SubElement(doc, "MerchantStreetAddress")
                    city_name = ET.SubElement(doc, "City")
                    state_name = ET.SubElement(doc, "State")
                    zip_name = ET.SubElement(doc, "ZipCode")
                    longitude = ET.SubElement(doc, "Longitude")
                    latitude = ET.SubElement(doc, "Latitude")
                    hotcold = ET.SubElement(doc, "HotCold")
                    hidden = str(hidden_list[element].firstChild.nodeValue)
                    local = str(local_list[element].firstChild.nodeValue)
                    merchant.text = str(merch_name[element].firstChild.nodeValue)
                    address.text = str(addy_list[element].firstChild.nodeValue)
                    city_name.text = str(city)
                    state_name.text = str(state)
                    zip_name.text = str(zip)
                    longitude.text = str(long_list[element].firstChild.nodeValue)
                    latitude.text = str(lat_list[element].firstChild.nodeValue)
                    hotcold.text = str(get_hot_cold(hidden, local))
            except AttributeError:
                pass
        data_file = ET.ElementTree(root)
        data_file.write(os.path.join('db', file_name + ".xml"))
        print "Saved new file."
    except(ImportError, IndexError, AttributeError, SyntaxError, NameError, IOError):
        print "Error"


def main(argv):
    zip_code = sys.argv[1]
    url = minidom.parse(urlopen("http://dmartin.org:8026/merchantpoi/v1/merchantpoisvc.svc/merchantpoi?PostalCode=" +
                                zip_code + "&MCCCode=5813&CurrentRow=0&Offset=50"))
    url2 = minidom.parse(urlopen("http://dmartin.org:8026/merchantpoi/v1/merchantpoisvc.svc/merchantpoi?PostalCode=" +
                                zip_code + "&MCCCode=5814&CurrentRow=0&Offset=50"))
    addy_list = (url.getElementsByTagName('MerchantStreetAddress') + url2.getElementsByTagName('MerchantStreetAddress'))
    merch_name = (url.getElementsByTagName('MerchantName') + url2.getElementsByTagName('MerchantName'))
    long_list = (url.getElementsByTagName('Longitude') + url2.getElementsByTagName('Longitude'))
    lat_list = (url.getElementsByTagName('Latitude') + url2.getElementsByTagName('Latitude'))
    city = (url.getElementsByTagName('MerchantCityName'))
    city = (str(city[0].firstChild.nodeValue))
    state = (url.getElementsByTagName('MerchantStateProvidenceCode'))
    state = (str(state[0].firstChild.nodeValue))
    zip = zip_code
    hidden_list = (url.getElementsByTagName('HiddenGem') + url2.getElementsByTagName('HiddenGem'))
    local_list = (url.getElementsByTagName('LocalFavorite') + url2.getElementsByTagName('LocalFavorite'))
    ele_num = url.getElementsByTagName('MerchantPostalCode').length + url2.getElementsByTagName('MerchantPostalCode').length
    write_data(zip_code, ele_num, addy_list, merch_name, long_list, lat_list, hidden_list, local_list, city, state, zip)


if __name__ == "__main__":
    main(sys.argv)
