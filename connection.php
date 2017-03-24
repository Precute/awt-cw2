<?php
ob_start();
//$dsn = 'mysql:host=mudfoot.doc.stu.mmu.ac.uk;dbname=arpalikh';
//$username = 'arpalikh';
//$password = 'Vanscerq9';

//$dsn = 'mysql:host=127.0.0.1;dbname=awt';
//$username = 'root';
//$password = 'password';

$dsn = 'mysql:host=mudfoot.doc.stu.mmu.ac.uk;dbname=tanveeah';
$username = 'tanveeah';
$password = 'wErthlep4';

try {
	$db = new PDO($dsn, $username, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	error_log("Connected to Database");
}

catch(PDOException $e) {
	echo $e->getMessage();
}

ob_end_flush();
?>