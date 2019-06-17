<?php 

	require_once("connect.php");

	$user_id = $_GET['id'];


	$query = "SELECT status FROM users WHERE id = {$user_id}";

	$status = mysqli_fetch_assoc(mysqli_query($conn, $query))['status'];

	$status = $status == 1 ? 0 : 1;

	$query = "UPDATE users SET status = $status WHERE id = $user_id";

	mysqli_query($conn, $query);

	header('location: ../views/users.php');
	
 ?>