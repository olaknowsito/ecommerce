<?php 

require_once "connect.php";

$username = $_POST['username'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$address = $_POST['address'];
$role_id = 2;

if(array_key_exists('role', $_POST)){
	$role_id = $_POST['role'];
}


$hashed_password = password_hash($password, PASSWORD_BCRYPT);


$query = "INSERT INTO users (
				username,
				password,
				firstname,
				lastname,
				email,
				address,
				role_id
			) VALUES (
				'$username',
				'$hashed_password',
				'$firstname',
				'$lastname',
				'$email',
				'$address',
				$role_id
			)";

mysqli_query($conn, $query);

header('location: ../views/login.php');

mysqli_close($conn);
?>

