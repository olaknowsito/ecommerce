<?php 
function getTitle(){

	echo "Catalog";
}

function getContent(){
	require_once "../controllers/connect.php";

	?>

	<div class="row no-gutters">
		<div class="col-md-3">
			<h2>Categories</h2>
			<div class="card mx-2">
				<ul class="list-group list-group-flush">
					<li class="list-group-item"><a href="catalog.php">All</a></li>
					<?php 
					$query = "SELECT * FROM categories";
					$categories = mysqli_query($conn, $query);

					foreach ($categories as $category) {
						?>
						<li class="list-group-item"><a href="catalog.php?<?php echo array_key_exists('sort', $_GET) ? "sort={$_GET['sort']}&" : "" ?>category_id=<?php echo $category['id'] ?>"><?php echo $category['name'] ?></a></li>

						<?php
					}

					?>
				</ul>
			</div>
			<h2>Sort</h2>
			<div class="card mx-2">
				<ul class="list-group list-group-flush">
					<li class="list-group-item"><a href="catalog.php?sort=ASC<?php echo array_key_exists('category_id', $_GET) ? "&category_id={$_GET['category_id']}" : "" ?>">Price (Lowest to Highest)</a></li>
					<li class="list-group-item"><a href="catalog.php?sort=DESC<?php echo array_key_exists('category_id', $_GET) ? "&category_id={$_GET['category_id']}" : "" ?>">Price (Highest to Lowest)</a></li>

				</ul>
			</div>
		</div>
		<div class="col-md-9">
			<div class="row no-gutters">

				<?php 

				$query = "SELECT * FROM items";

				if(array_key_exists('category_id', $_GET)){
					$query.=" WHERE category_id = {$_GET['category_id']}";
				}

				if(array_key_exists('sort', $_GET)){
					$query.=" ORDER BY price {$_GET['sort']}";
				}

				$items = mysqli_query($conn, $query);


				foreach ($items as $item) {
					?>
					<div class="col-md-3 py-2">
						<div class="card">
							<img src="<?php echo "../assets/images/".$item['image_path']; ?>" class="card-img-top" style="height: 200px; width: 100%; object-fit: cover;"  >

							<div class="card-body">
								<div class="card-title"><?php echo $item['name']; ?></div>
								<div class="card-text"><?php echo $item['price']; ?></div>
							</div>
							<div class="card-footer">
								<input type="number" name="quantity" class="form-control" value="1">
								
								<button class="btn btn-primary btn-block mt-2 add-to-cart"  data-id="<?php echo $item['id'] ?>">
									<i class="fas fa-shopping-cart"></i>
								</button>

							</div>
						</div>
					</div>

					<?php
				}


				?>
			</div>
		</div>
	</div>

	<?php
}

require_once "../partials/template.php";

?>