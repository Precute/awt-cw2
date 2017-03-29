<?php
ob_start();
require_once 'connection.php';

$insert = "INSERT INTO products (id, name, description, price, details) VALUES (:id, :name, :description, :price, :details)";
$stmt = $db->prepare($insert);

$stmt->bindParam(':id', $_POST['id']);
$stmt->bindParam(':name', $_POST['name']);
$stmt->bindParam(':description', $_POST['description']);
$stmt->bindParam(':price', $_POST['price']);
$stmt->bindParam(':details', $_POST['details']);
$stmt->execute();

$stmt = $db->prepare('SELECT id FROM products ORDER BY created DESC LIMIT 1');
$stmt->execute();
$result = $stmt->fetch();

$order_id = $result ["id"];
echo $result ["id"];



ob_end_flush();
?>