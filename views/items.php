<?php
function getTitle(){
	echo "Item List";
}

function getContent(){
	require_once "../controllers/connect.php";

	?>
	<h1 class="text-center py-4">Item List</h1>
	<div class="container">
		<hr>
		<a href="add_item_form.php" class="btn btn-success btn-block my-2">
			<i class="fas fa-plus"></i>
			Add Item
		</a>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Price</th>
					<th>Image</th>
					<th>Category</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$query = "SELECT i.*, c.name as category_name FROM items i LEFT JOIN categories c ON (i.category_id = c.id)";

				$items = mysqli_query($conn, $query);

				foreach($items as $index => $item){
					?>
					<tr>
						<td class="align-middle text-center"><?php echo ++$index; ?></td>
						<td class="align-middle"><?php echo $item['name']; ?></td>
						<td class="align-middle text-right"><?php echo $item['price']; ?></td>
						<td class="align-middle text-center"><img src="../assets/images/<?php echo $item['image_path']; ?>" class="item-image"></td>
						<td class="align-middle text-center"><?php echo $item['category_name'] ?></td>
						<td class="align-middle text-center">

							<a href="edit_item_form.php?id=<?php echo $item['id']; ?>" class="btn btn-primary">
								<i class="fas fa-edit"></i>
							</a>

							<a href="../controllers/delete_item_endpoint.php?id=<?php echo $item['id']; ?>" class="btn btn-danger">
								<i class="fas fa-trash"></i>
							</a>
						</td>
					</tr>
					<?php
				}

				?>

			</tbody>
		</table>

	</div>

	<?php
}

require_once('../partials/template.php');
?>