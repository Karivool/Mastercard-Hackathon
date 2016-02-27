<!DOCTYPE html>
<html>
   <head>
      <script src="https://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
   </head>
   <style type="text/css">
    #map-canvas {
       width: 400px;
       height: 400px;
    }
   </style>
   <body>
   <div id="map-canvas"></div>
   <script type="text/javascript">


    function initialize() {
       var mapOptions = {
          center: new google.maps.LatLng(40.680898,-8.684059),
          zoom: 11,
          mapTypeId: google.maps.MapTypeId.ROADMAP
       };
       var map = new google.maps.Map(document.getElementById("map-canvas"),
     mapOptions);
    }
    google.maps.event.addDomListener(window, 'load', initialize);

   </script>
   </body>
</html>