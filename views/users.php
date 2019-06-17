<?php
function getTitle(){
	echo "User List";
}

function getContent(){
	require_once "../controllers/connect.php";

	?>
	<h1 class="text-center py-4">User List</h1>
	<div class="container">
		<hr>
		<a href="add_user_form.php" class="btn btn-success btn-block my-2">
			<i class="fas fa-plus"></i>
			Add User
		</a>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>First Name</th>
					<th>Last 
					Name</th>
					<th>Username</th>
					<th>Email</th>
					<th>Address</th>
					<th>Role</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$query = "SELECT u.*, r.name as name FROM users u LEFT JOIN roles r ON (u.role_id = r.id)";

				$users = mysqli_query($conn, $query);

				foreach($users as $index => $user){
					?>
					<tr>
						<td><?php echo ++$index; ?></td>
						<td><?php echo ucwords($user['firstname']); ?></td>
						<td><?php echo ucwords($user['lastname']); ?></td>
						<td><?php echo $user['username']; ?></td>
						<td><?php echo $user['email']; ?></td>
						<td><?php echo $user['address']; ?></td>
						<td><?php echo $user['name']; ?></td>
						<td><?php echo $user['status'] == 1 ? "<span class='badge badge-success'>Enabled</span>" : "<span class='badge badge-danger'>Disabled</span>"; ?></td>
						<td>
							<a href="edit_user_form.php?id=<?php echo $user['id']; ?>" class="btn btn-primary">
								<i class="fas fa-edit"></i>
							</a>
							<?php 
							if($user['status'] == 1){
								?>
								<a href="../controllers/change_user_status_endpoint.php?id=<?php echo $user['id']; ?>" class="btn btn-danger">
									<i class="fas fa-user-times"></i>
								</a>

								<?php
							} else {
								?>
								<a href="../controllers/change_user_status_endpoint.php?id=<?php echo $user['id']; ?>" class="btn btn-secondary">
									<i class="fas fa-user-check"></i>
								</a>
								<?php
							}
							?>
							
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