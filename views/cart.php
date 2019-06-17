<?php 


function getTitle(){
	echo "Cart";
}

function getContent(){

	require_once("../controllers/connect.php");
	?>

	<div class="container">
		<h1 class="text-center">Cart</h1>
		<hr>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Subtotal</th>
					<th>Action</th>
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
							<button class="btn btn-secondary subtract-quantity" data-id="<?php echo $item['id']; ?>" <?php echo $quantity > 1 ? '' : 'disabled' ?>>
								<i class="fas fa-minus"></i>
							</button>
							<span class="quantity-text"><?php echo $quantity; ?></span>
							<button class="btn btn-secondary add-quantity" data-id="<?php echo $item['id']; ?>">

								<i class="fas fa-plus"></i>
							</button>
						</td>
						<td class="subtotal text-right"><?php echo $subtotal ?></td>
						<td class="action text-center">
							
							<a href="../controllers/remove_cart_item_endpoint.php?id=<?php echo $item['id']?>" class="btn btn-danger">
								<i class="fas fa-trash"></i>
							</a>

						</td>
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
		<?php 
			if(isset($_SESSION['user'])){
				?>
					<a href="checkout.php" class="btn btn-primary btn-block">Checkout</a>
				<?php					
			} else {
				?>
					<div class="alert alert-danger text-center" role="alert">
						Please Login first to proceed on transaction <i class="fas fa-exclamation"></i>
					</div>
			
					<button disabled class="btn btn-primary btn-block">Checkout</button>
					
				<?php
			}
								
		?>
		
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_confirm_order">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Finalize Order</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Are you sure want to finalize order?</p>
				</div>
				<div class="modal-footer">
					<a href="../controllers/order_endpoint.php" class="btn btn-primary">Order</a>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>

	</div>
	<?php
}

require_once "../partials/template.php";

?>

