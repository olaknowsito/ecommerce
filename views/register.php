<?php 

function getTitle(){
	echo "Register";
}

function getContent(){
	?>
	<div class="container py-4">
		<h1 class="text-center">User Registration</h1>
		<div id="error_container"></div>
		<hr>
		<form action="../controllers/register_endpoint.php" method="POST" id="register_form">
			<div class="row">
				<div class="col">
					<div class="form-group">
						<label>Username</label>
						<input type="text" class="form-control" name="username" id="username" required>
						<small class='error-username'></small>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" name="password" id="password" required>
					</div>
					<div class="form-group">
						<label>Confirm Password</label>
						<input type="password" class="form-control" name="confirm" id="confirm" required>
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label>First Name</label>
						<input type="text" class="form-control" name="firstname" id="firstname" required>
					</div>
					<div class="form-group">
						<label>Lastname</label>
						<input type="text" class="form-control" name="lastname" id="lastname" required>
					</div>
					
					<div class="form-group">
						<label>E-Mail</label>
						<input type="email" class="form-control" name="email" id="email" required>
					</div>
				</div>

			</div>
			<div class="form-group">
				<label>Address</label>
				<input type="text" class="form-control" name="address" id="address" required>
			</div>
			<button type="button" class="btn btn-primary btn-block" id="register">Register</button>
		</form>
	</div>

	<?php
}

require_once "../partials/template.php";
?>