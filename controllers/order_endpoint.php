<?php 
session_start();
require_once('connect.php');

function generate_transaction_code($conn){

	$transaction_code = '';
	while($transaction_code == ''){
		$random_string = date('ymd') . uniqid();
		$query = "SELECT * FROM orders WHERE transaction_code = '{$random_string}'";
		$count = mysqli_num_rows(mysqli_query($conn, $query));

		if($count == 0){
			$transaction_code = $random_string;
		}
	}

	return $transaction_code; 
}


$transaction_code = generate_transaction_code($conn);
$user_id = $_SESSION['user']['id'];
$purchase_date = date('Y-m-d');
$payment_mode_id = 1;

	// Insert the order
$query = "INSERT INTO orders (
transaction_code,
user_id,
purchase_date,
status_id,
payment_mode_id
) VALUES (
'{$transaction_code}',
{$user_id},
'{$purchase_date}',
1,
$payment_mode_id
)";

mysqli_query($conn, $query);	

	// get order id
$order_id = mysqli_insert_id($conn);

	// Insert order items

foreach($_SESSION['cart'] as $item_id => $quantity){
	$query = "SELECT price FROM items WHERE id = {$item_id}";
	$item = mysqli_fetch_assoc(mysqli_query($conn, $query));


	$query = "INSERT INTO orders_items (
	order_id,
	item_id,
	quantity,
	price
	) VALUES (
	{$order_id},
	{$item_id},
	{$quantity},
	{$item['price']})";	

	mysqli_query($conn, $query);

	if(!$conn){
		echo mysqli_error();
		die();
	}

}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

$mail = new PHPMailer(true); 
// Passing `true` enables exceptions

$staff_email = 'hotels.com.confirmation@gmail.com';
$password = '123123drink';
$brand = 'PC-Rigz';

$customer_email = $_SESSION['user']['email'];          //
$subject = 'PC-Rigz - Order Confirmation';
$body = '<div style="text-transform:uppercase;"><h3>Reference No.: '.$transaction_code.'</h3></div>'."<div>Ship to {$_SESSION['user']['address']}</div>";
try {
    //Server settings
    $mail->SMTPDebug = 4;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $staff_email;                       // SMTP username
    $mail->Password = $password;                     // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($staff_email, $brand);
    $mail->addAddress($customer_email);  // Name is optional

    //Content
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body = $body;

    
	// unset($_SESSION['cart']);
	$_SESSION['cart'] = [];
	// redirect to success page]
	header("location: ../views/order_success.php?transaction_code={$transaction_code}");
    
    $mail->send();
    // echo 'Message has been sent';

} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}





?>