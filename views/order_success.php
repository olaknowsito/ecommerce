<?php 


function getTitle(){
	echo "Order Confirmation";
}

function getContent(){
	?>

	<div class="container">
		<div class="text-center">
			<?php 
			echo "Your Order is successful! <br>";
			echo "Transaction Code: 
				<span class='font-weight-bold'>
					{$_GET['transaction_code']}
				</span>";
			?>
		</div>
	</div>

	<?php
}

	require_once "../partials/template.php"

?>
<a href="catalog.php" class="btn btn-primary">Continue Shopping</a>