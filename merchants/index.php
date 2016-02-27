<?php include_once('../header.php'); ?>

    <div class="container">
      
      <div class="row">
        <div class="col-sm-3">
          <!-- status ( hot or cold ) -->
          <div id="popularity_status">
            <?php echo $_GET["hc"]; ?>
          </div>
          <!-- merchant name -->
          <div>
            <h3>
              <?php echo urldecode( $_GET["name"] ); ?>
            </h3>
          </div>
          <!-- address -->
          <div>
            <?php echo urldecode($_GET["streetaddress"]); ?><br>
            <?php echo urldecode($_GET["city"]) . ", " . $_GET["state"] . " " . $_GET["zipcode"]; ?>
          </div>
          <!-- merchant image -->
          <div class="thumbnail">
            <img src="../assets/merchant_default.png" alt="...">
          </div>
        </div>
      </div>
      <div>
        <img src="">
      </div>
      <!-- any deals (maybe later) -->
    


    <footer class="footer">
      <div>Copyright 2015</div>
    </footer>
 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>

</body>
</html>
 