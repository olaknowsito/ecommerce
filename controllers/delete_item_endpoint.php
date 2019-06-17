<?php 

	require_once "connect.php";
	$item_id = $_GET['id'];

	$query = "DELETE FROM items WHERE id = {$item_id}";
	mysqli_query($conn, $query);

	header("location: {$_SERVER['HTTP_REFERER']}");

 ?>