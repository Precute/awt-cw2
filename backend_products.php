<?php
ob_start();
require_once 'connection.php';

$stmt = $db->prepare('SELECT * FROM products');
$stmt->execute();
$result = $stmt->fetchAll();
class Product
{
}

$products = array();

foreach($result as $row) {
	$p = new Product();
	$p->sku = $row['id'];
	$p->name = $row['name'];
	$p->description = $row['description'];
	$p->price = $row['price'];
	$p->details = $row['details'];
	$p->created = $row['created'];
	$products[] = $p;
}

header('Content-Type: application/json');
echo json_encode($products);
ob_end_flush();
?>