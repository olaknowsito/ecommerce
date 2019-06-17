<?php 

require_once "connect.php";

$username = $_POST['username'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$address = $_POST['address'];
$role_id = $_POST['role'];

if($password != ''){

	$hashed_password = password_hash($password, PASSWORD_BCRYPT);
}



$query = "UPDATE users SET
			username = '{$username}',
			password = '{$hashed_password}',
			firstname = '{$firstname}',
			lastname = '{$lastname}',
			email = '{$email}',
			address = '{$address}',
			role_id = {$role_id} 
		WHERE id = {$_GET['id']}";

mysqli_query($conn, $query);

header('location: ../views/login.php');

mysqli_close($conn);
?>

