<?php 

function getTitle(){
	echo "Add User";
}

function getContent(){
	require_once "../controllers/connect.php";
	?>

	<h1 class="text-center py-4">Add User</h1>
	<div class="container">
		<hr>
		<form action="../controllers/register_endpoint.php" method="POST">
			<div class="form-group">
				<label>First Name</label>
				<input type="text" name="firstname" class="form-control">
			</div>
			<div class="form-group">
				<label>Last Name</label>
				<input type="text" name="lastname" class="form-control">
			</div>
			<div class="form-group">
				<label>Username</label>
				<input type="text" name="username" class="form-control">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" class="form-control">
			</div>
			<div class="form-group">
				<label>Confirm Password</label>
				<input type="password" name="confirm" class="form-control">
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" name="email" class="form-control">
			</div>
			<div class="form-group">
				<label>Address</label>
				<input type="text" name="address" class="form-control">
			</div>
			
			<div class="form-group">
				<label>Roles:</label>
				<select name="role" class="form-control">
					<option value=""></option>
					<?php 
					$query = "SELECT * FROM roles";
					$roles = mysqli_query($conn, $query);

					foreach($roles as $role){
						echo "<option value='{$role['id']}'>{$role['name']}</option>";
					}
					?>
				</select>
			</div>
			<button type="submit" class="btn btn-primary btn-block"><i class="fas fa-check"></i> Submit</button>
		</form>
	</div>

	<?php
}

require_once "../partials/template.php"
?>