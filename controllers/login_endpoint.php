<?php 
	session_start();
	require_once "connect.php";


	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = "SELECT * FROM users WHERE username = '{$username}'";
	$user_information = mysqli_fetch_assoc(mysqli_query($conn, $query));


	if(empty($user_information)){
		header('location: ../views/login.php');
	} else {
		$hashed_password = $user_information['password'];

		if(password_verify($password, $hashed_password)){
			$_SESSION['user'] = $user_information;
			header('location: ../views/catalog.php');
		} else {
			header('location: ../views/login.php');
		}
	}


 ?>
