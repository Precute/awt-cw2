<?php
ob_start();
require_once 'connection.php';

$stmt = $db->prepare('SELECT id, totalitems, totalprice, DATE_FORMAT(timeorderplaced, \'%d-%m-%Y %H:%i\') as timeorderplaced, transactionid, TID, payer_email, first_name, last_name, amount, currency, country, txn_id, txn_type, payment_status, payment_type, DATE_FORMAT(payment_date, \'%d-%m-%Y %H:%i\') as payment_date, num_cart_items FROM orders LEFT JOIN transactions ON transactionid=TID');
$stmt->execute();
$result = $stmt->fetchAll();
class Order
{
}

$orders = array();

foreach($result as $row) {
	$o = new Order();
	$o->id = $row['id'];
	$o->totalitems = $row['totalitems'];
	$o->totalprice = $row['totalprice'];
	$o->timeorderplaced = $row['timeorderplaced'];
	$o->transactionid = $row['transactionid'];
    $o->TID = $row['TID'];
	$o->payer_email = $row['payer_email'];
	$o->first_name = $row['first_name'];
	$o->last_name = $row['last_name'];
	$o->amount = $row['amount'];
	$o->currency = $row['currency'];
	$o->country = $row['country'];
	$o->txn_id = $row['txn_id'];
	$o->txn_type = $row['txn_type'];
	$o->payment_status = $row['payment_status'];
	$o->payment_type = $row['payment_type'];
	$o->payment_date = $row['payment_date'];
	$o->num_cart_items = $row['num_cart_items'];
	$orders[] = $o;
}

header('Content-Type: application/json');
echo json_encode($orders);
ob_end_flush();
?>