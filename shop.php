<html ng-app="RobinsNestStore">
  <head>
    <title>Robin's Nest Merchandise Store</title>

    <!-- jQuery, Angular -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript" ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.5/angular.min.js" type="text/javascript"></script>

    <!-- Bootstrap -->
    <link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet" type="text/css"/>
    <!--<script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js" type="text/javascript" ></script>-->
<?php require_once 'header.php'; ?>
    <!-- RobinsNestStore app -->
    <script src="js/product.js" type="text/javascript"></script>
    <script src="js/store.js" type="text/javascript"></script>
    <script src="js/order.js" type="text/javascript"></script>
    <script src="js/orders.js" type="text/javascript"></script>
    <script src="js/shoppingCart.js" type="text/javascript"></script>
    <script src="js/app.js" type="text/javascript"></script>
    <script src="js/controller.js" type="text/javascript"></script>
    <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
  </head>

  <body>

    <!-- 
        bootstrap fluid layout
        (12 columns: span 10, offset 1 centers the content and adds a margin on each side)
    -->
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span10 offset1">
                <div ng-view></div>
            </div>
        </div>
    </div>

  </body>
</html>