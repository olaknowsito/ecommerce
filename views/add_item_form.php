<?php 

function getTitle(){
	echo "Add Item";
}

function getContent(){
	require_once "../controllers/connect.php";
	?>

	<h1 class="text-center py-4">Add Item</h1>
	<div class="container">
		<hr>
		<form action="../controllers/add_item_endpoint.php" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label>Item Image:</label>
				<input type="file" name="image" class="form-control">
			</div>
			<div class="form-group">
				<label>Item Name:</label>
				<input type="text" name="name" class="form-control">
			</div>
			<div class="form-group">
				<label>Price:</label>
				<input type="number" name="price" class="form-control">
			</div>
			<div class="form-group">
				<label>Categories:</label>
				<select name="category" class="form-control">
					<option value=""></option>
					<?php 
					$query = "SELECT * FROM categories";
					$categories = mysqli_query($conn, $query);

					foreach($categories as $category){
						echo "<option value='{$category['id']}'>{$category['name']}</option>";
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label>Description:</label>
				<textarea name="description" class="form-control"></textarea>
			</div>
			<button type="submit" class="btn btn-primary btn-block"><i class="fas fa-check"></i> Submit</button>
		</form>
	</div>

	<?php
}

require_once "../partials/template.php"
?>