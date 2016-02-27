<?php 

// RE PHRASE INSTRUCTIONS
// fetches an xml document according to zipcode if it exists already
// otherwise will request to create a new db record

$_POST['zip_code'];

// $zip_code = "10013";
$zip_code = $_POST['zip_code'];

exec ( "/usr/local/miniconda/bin/python2.7 main.py $zip_code" );

$xml_string = file_get_contents("db/$zip_code.xml");

$xml = simplexml_load_string($xml_string);
echo $json = json_encode($xml);

?>