<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- for map -->
    <style>
      #map-canvas {
         width: 100%;
         height: 400px;
      }

      li.list-group-item{
        margin-top: 1em;
        margin-bottom: 1em;
      }

    </style>
    <!-- end for map -->
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>


  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Hot or Cold</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<!--           <ul class="nav navbar-nav">
            <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Link</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul> -->
          <form class="navbar-form navbar-left" role="search">
            
            <div class="form-group">
            We determine how popular your bar is before you go!
              <!-- <input type="text" class="form-control" placeholder="Search"> -->
            </div>
            <!-- <button type="submit" class="btn btn-default">Submit</button> -->
          </form>
          <ul class="nav navbar-nav navbar-right">
<!--             <li><a href="#">Sign Up</a></li>
            <li><a href="#">Sign In</a></li> -->
<!--             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <button type="submit" class="btn btn-default">Submit</button>
                <li><a href="#">Sign Up</a></li>
                <li><a href="#">Sign In</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </li> -->
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    
    <div class="container">
    
      <!-- intro -->
<!--       <div class="jumbotron">

        <h1>Hot Or Cold</h1>
        <p>We determine how popular your bar is before you go!</p>
        <p><a class="btn btn-primary btn-lg" href="learn" role="button">Learn more</a></p>
      </div> -->
      <!-- search bar -->
      <div>
        <!-- ( merchants only nearby ) -->
        <!-- disabled for now -->
<!--         <form class="" role="search">
          <div class="input-group">
              <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
              <div class="input-group-btn">
                  <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
              </div>
          </div>
        </form> -->
      </div>

    <!-- explain to user about map details -->
<!--     <div class="panel panel-default">
      <div class="panel-body">
        Merchant locations near zip <span id="user_zipcode">xxxxxx</span> 
      </div>
    </div> -->

    <!-- merchant list -->
    <div class="panel panel-default" style="margin-top: 1em;">
      <div class="panel-body">
        <!-- Looking for merchants -->
        <div id="progress_status">Looking for your location...</div>
        <div class="progress" style="margin: 0.5em;">
          <div id="progressbar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
            <span class="sr-only">10% Complete</span>
          </div>
        </div>
      </div>
    </div>

    <!-- start map -->
    <div id="map-canvas"></div>

    <ul id="merchant_list" class="list-group">
      
    </ul>



    <footer class="footer">
      <div>Copyright 2015</div>
    </footer>
 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <!-- <script src="http://maps.google.com/maps/api/js?sensor=false"></script> -->
    <script>  
 
      var latitude;
      var longitude;
      var zip_code;

      // initially request user to get their location
      navigator.geolocation.getCurrentPosition(GetLocation);


      // keep looking for location
      // then load google map with local location
      var main = setInterval( function() {

        // find the users location:
        // 
        if ( latitude && longitude ) {

          console.log('found location');

          // RUN ZIP FUNCTIONS
          // gets zip from google api
          // update dom with current zip
          // OTHERS
          runZip();

          // TODO: more some logic over here


        } else {

          console.log("no location found");


        }

        // list functions
        function runZip() {

          //TEMP
          //check if ajax is working
          var google_api_url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + latitude + "," + longitude;
          var google_api_key = "AIzaSyA4TKWj9R6p-QHfoiGI2ujqTT8IznUeiGo";

          var first_zip_address;

          var zip_code;

          // convert location from lat&log to zipcode
          $.ajax({url: google_api_url , success: function(result){

              // found only zip
              zip_code = result.results[0].address_components[8].long_name;

              // update dom
              $("#progress_status").html( "Found your zip code of <strong>" + zip_code + "</strong><br> Searching for merchants in your area..." );

              // TODO: try to move this logic

              // get relevent xml with zip
              $.post("get_merchants.php",
                {
                    zip_code: zip_code
                },
                function(data, status){


                  // all the merchant data found to handle
                  // make an array of merchants
                  var merchant_response = JSON.parse(data);

                  merchant_response = merchant_response.MerchantPOIArray;
                  // console.log(merchant_response);
                  // merchant_response = merchant_response.MerchantPOI;

                  var index;

                  console.log('adding list');

                  // create a list with merchant response
                  // compile html for ul
                  var ul_content = "";
                  

                  for (index = 0; index < merchant_response.length; ++index) {

                    if ( typeof merchant_response[index].MerchantStreetAddress === 'string' || merchant_response[index].MerchantStreetAddress instanceof String ) {
                      console.log(merchant_response[index]);

                      var current_status = merchant_response[index].HotCold;

                      var status = getStatus();

                      function getStatus () {

                        if (current_status == "N") {
                          return "Cold";
                        } else {
                          return "Hot";
                        };
                        
                      }

                      // merchant_response[index].HotCold


                      ul_content = ul_content + "<a class='merchant_link' href='merchants?hc=" + 
                        status + "&name=" + 
                        merchant_response[index].MerchantName + "&streetaddress=" + 
                        merchant_response[index].MerchantStreetAddress + "&city=" + 
                        merchant_response[index].City + "&state=" +
                        merchant_response[index].State + "&zipcode=" + 
                        merchant_response[index].ZipCode + "'><li class='list-group-item'>" 
                        + status  + 
                        "<br>" + merchant_response[index].MerchantName + 
                        "<br>" + merchant_response[index].MerchantStreetAddress +
                        "<br>" + merchant_response[index].City + ", " + 
                        merchant_response[index].State + " " + 
                        merchant_response[index].ZipCode + "</li></a>";

                    };



                    
                      // console.log( merchant_response[index].Longitude );
                      

                  }

                  // apply content to list
                  $("#merchant_list").html( ul_content );



                  // gather all of the found markers
                  // pass to initialize
                  var latlongs = [];


                  // load google map
                  initialize(latitude, longitude);

                  // stop interval
                  clearInterval(main);

                  // update progress bar to complete
                  $("#progress_status").html( "Completed." );
                  $("#progressbar").removeClass("progress-bar-striped");
              });
              
          }});

        }

      } , 5000 );



      function GetLocation(location) {

          latitude = location.coords.latitude;
          longitude = location.coords.longitude;

          console.log(latitude, longitude);

      }

 
    </script>

    <script type="text/javascript">

          function initialize() {

             var mapOptions = {
                center: new google.maps.LatLng(latitude,longitude),
                zoom: 11,
                mapTypeId: google.maps.MapTypeId.ROADMAP
             };



             var map = new google.maps.Map(document.getElementById("map-canvas"),
           mapOptions);

             // make all the markers
              var marker = new google.maps.Marker({
                position: new google.maps.LatLng(latitude,longitude),
                map: map,
                title: ''
              });

          }
          // google.maps.event.addDomListener( window, 'load', initialize);



          // function updateProgressBar(){

          //   var width = 0;

          //   var progress_timer = setInterval(function (){

          //     width = width + 24;

          //     $("#progressbar").css('width', width );

          //     console.log($("#progressbar").css('width'));


              
          //     if ( $("#progressbar").css('width') >= 100) {

          //       width = 100;
          //       $("#progressbar").css('width', width);

          //       console.log('complete');
          //       clearInterval(progress_timer);
          //     };

          //   }, 1000);
          // }
          // updateProgressBar();

   </script>



</body>
</html>