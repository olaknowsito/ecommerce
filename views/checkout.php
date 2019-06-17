<?php 

function getTitle(){
	echo "Checkout";
}

function getContent(){

	require_once "../controllers/connect.php";
	?>
	<h1 class="text-center">Checkout</h1>
	<div class="container">
		<hr>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>

				<?php 

				$count = 1;
				$total = 0;

				foreach($_SESSION['cart'] as $item_id => $quantity){
					$query = "SELECT * FROM items WHERE id = {$item_id}";
					$item = mysqli_fetch_assoc(mysqli_query($conn, $query));

					$subtotal = $item['price'] * $quantity;
					$total += $subtotal;
					?>
					<tr>
						<td class="count"><?php echo $count++ ?></td>
						<td class="name"><?php echo $item['name']; ?></td>
						<td class="price text-right"><?php echo $item['price']; ?></td>
						<td class="quantity text-center">
							<?php echo $quantity ?>
						</td>
						<td class="subtotal text-right"><?php echo $subtotal ?></td>
					</tr>

					<?php
				}
				?>
				<tr>
					<td class="font-weight-bold text-right" colspan="4">Total</td>
					<td class="font-weight-bold text-right" id="total" colspan="2"><?php echo $total; ?></td>
				</tr>
			</tbody>

		</table>
		
		<a href="../controllers/order_endpoint.php" class="btn btn-primary btn-block">Order</a>
		<div id="paypal-container" class="my-2">
			<script src="https://www.paypal.com/sdk/js?client-id=AbyrCJEU6Fw3qM0kY1d_An8GQyAsX1-Zjr0Cy5xU7bk8dzp4wIS6puTQYjnO2VnPnh8oXxkDlE6sHxYV"></script>
			<script>paypal.Buttons({
				createOrder: function(data, actions) {
					return actions.order.create({
						purchase_units: [{
							amount: {
								value: <?php echo $total; ?>
							}
						}]
					});
				},
				onApprove: function(data, actions) {
      			// Capture the funds from the transaction
      			return actions.order.capture().then(function(details) {
        		// Show a success message to your buyer
        		alert('Transaction completed by ' + details.payer.name.given_name);
    			});
  			}
			}).render('#paypal-container');</script>
		</div>
</div>
<?php
}

require_once "../partials/template.php";

?>