<?php 
	session_start();

	if(!array_key_exists('cart', $_SESSION)){
		$_SESSION['cart'] = [];
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title><?php getTitle(); ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">

	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	
  	
</head>
<body>
	  <div class="wrapper">