<?php 

	session_start();

	$item_id = $_POST['item_id'];
	$quantity = $_POST['quantity'];

	if(array_key_exists($item_id, $_SESSION['cart'])){
		$_SESSION['cart'][$item_id] += $quantity;
	} else {
		$_SESSION['cart'][$item_id] = $quantity;
		// array_push($_SESSION['cart'], $item_id => $quantity);
	}

	echo array_sum($_SESSION['cart']);
 ?>