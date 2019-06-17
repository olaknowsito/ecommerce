<?php 

	require_once("connect.php");

	function generate_image_name($conn){
		$image_name = '';

		while($image_name == ''){
			$random_string = 'image-' . uniqid();
			$query = "SELECT image_path FROM items WHERE image_path = '{$random_string}'";
			$item = mysqli_query($conn, $query);

			if(mysqli_num_rows($item) == 0){
				$image_name = $random_string;
			}
		}

		return $image_name;
	
	}

	$name = $_POST['name'];
	$price = $_POST['price'];
	$category = $_POST['category'];
	$description = $_POST['description'];

	$upload_directory = "../assets/images/"; // Upload directory
	$image_file_type = strtolower(pathinfo(basename($_FILES['image']['name']), PATHINFO_EXTENSION));
	$filename = generate_image_name($conn) .'.'. $image_file_type;
	$upload_path = $upload_directory . $filename;

	move_uploaded_file($_FILES["image"]['tmp_name'], $upload_path);

	$query = "INSERT INTO items (
							name,
							price,
							description,
							image_path,
							category_id	
						) VALUES (
							'{$name}',
							{$price},
							'{$description}',
							'{$filename}',
							{$category}
						)";

	mysqli_query($conn, $query);

	header('location: ../views/items.php');

 ?>