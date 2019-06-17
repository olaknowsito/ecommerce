<?php 

function getTitle(){
	echo "Edit Item";
}

function getContent(){
	require_once "../controllers/connect.php";

	$query = "SELECT * FROM items WHERE id = {$_GET['id']}";
	$item = mysqli_fetch_assoc(mysqli_query($conn, $query));
	// $item [name, price, description, image path, category_id]

	?>

	<h1 class="text-center my-4">Edit Item</h1>
	<div class="container">
		<hr>
		<form action="../controllers/edit_item_endpoint.php?id=<?php echo $item['id'] ?>" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label>Item Image:</label>
				<input type="file" name="image" class="form-control">
			</div>
			<div class="">
				<img src="../assets/images/<?php echo $item['image_path']; ?>" id="preview" class="item-image img-thumbnail">
			</div>
			<div class="form-group">
				<label>Item Name:</label>
				<input type="text" name="name" class="form-control" value="<?php echo $item['name']; ?>">
			</div>
			<div class="form-group">
				<label>Price:</label>
				<input type="number" name="price" class="form-control" value="<?php echo $item['price']; ?>">
			</div>
			<div class="form-group">
				<label>Categories:</label>
				<select name="category" class="form-control">
					<option value=""></option>
					<?php 
					$query = "SELECT * FROM categories";
					$categories = mysqli_query($conn, $query);

					foreach($categories as $category){
						
						if($category['id'] == $item['category_id']){
							echo "<option value='{$category['id']}' selected>{$category['name']}</option>";
						} else {
							echo "<option value='{$category['id']}'>{$category['name']}</option>";
						}
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label>Description:</label>
				<textarea name="description" class="form-control"><?php echo $item['description']; ?></textarea>
			</div>
			<button type="submit" class="btn btn-primary btn-block"><i class="fas fa-check"></i> Submit</button>
		</form>
	</div>

	<?php
}

require_once "../partials/template.php";
?>