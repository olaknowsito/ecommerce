<?php 
	require_once('connect.php');

	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirm = $_POST['confirm'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$address = $_POST['address'];

	$errors = [];


	// validate username if its already taken
	$query = "SELECT * FROM users WHERE username = '{$username}'";
	$user = mysqli_fetch_assoc(mysqli_query($conn, $query));

	if(!empty($user)){
		array_push($errors, "Username is already taken.");
	}

	// validate password and confirm password if it matched
	if($password != $confirm){
		array_push($errors, "Password did not match.");
	} else if(strlen($password) < 8){
		array_push($errors, "Password should have a minimum of 8 characters.");
	}

	// validate if email is already used
	$query = "SELECT * FROM users WHERE email = '{$email}'";
	$email = mysqli_fetch_assoc(mysqli_query($conn, $query));

	if(!empty($email)){
		array_push($errors, "Email is already used.");
	}

	// create response to client
	if(!empty($errors)){
		$response = ["result" => "failed", "errors" => $errors];
	} else {
		$response = ["result" => "success"];
	}

	// display response in json format
	echo json_encode($response);

 ?>