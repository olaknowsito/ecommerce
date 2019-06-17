<?php 

function getTitle(){
	echo "Login";
}

function getContent(){
	?>
	<div class="container py-4">
		<h1 class="text-center">User Login</h1>
		<hr>
		<form action="../controllers/login_endpoint.php" method="POST">
			<div class="form-group">
				<label>Username</label>
				<input type="text" class="form-control" name="username" id="username" required>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" name="password" id="password" required>
			</div>
			<button class="btn btn-primary btn-block">Login</button>
		</form>
	</div>

	<?php
}

require_once "../partials/template.php";

?>