<?php 

	session_start();

	$item_id = $_GET['id'];
	unset($_SESSION['cart'][$item_id]);

	header("location: {$_SERVER['HTTP_REFERER']}");

 ?>

