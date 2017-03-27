<?php
ob_start();
require_once 'connection.php';

$insert = "INSERT INTO orders (totalitems, totalprice) VALUES (:totalItems, :totalPrice)";
$stmt = $db->prepare($insert);

$stmt->bindParam(':totalItems', $_POST['totalItems']);
$stmt->bindParam(':totalPrice', $_POST['totalPrice']);
$stmt->execute();
class Result

{
}

$response = new Result();
$response->id = $db->lastInsertId();
header('Content-Type: application/json');
echo json_encode($response);
ob_end_flush();
?>