<?php 
    $lat = $_POST['lat'];
    $long = $_POST['long'];
    if(!isset($_SESSION)) { session_start(); }

 $_SESSION['lat'] = $lat;
    $_SESSION['long'] = $long;
    header( 'Location: members.php' ) ;
   error_log($lat);
?>
