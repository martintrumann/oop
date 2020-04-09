<?php
require("./class/User.php");
$users = User::all();

$add = filter_input(INPUT_POST, "add", FILTER_SANITIZE_NUMBER_INT);
if(isset($add)){
	$inArr = filter_input_array(INPUT_POST, [
		'email'		=> FILTER_SANITIZE_EMAIL,
		"firstName"	=> FILTER_SANITIZE_STRING,
		"lastName"	=> FILTER_SANITIZE_STRING,
		'pass'		=> FILTER_SANITIZE_STRING,
	]);

	$user = new User;

	$user->email		= $inArr["email"];
	$user->firstName	= $inArr["firstName"];
	$user->lastName		= $inArr["lastName"];
	$user->lastLogin	= date("Y-m-d H:i:s");
	$user->pass			= password_hash($inArr["pass"], PASSWORD_DEFAULT);

	$user->insert();
	array_push($users, $user);
}

$deleteId = filter_input(INPUT_POST, "delete", FILTER_SANITIZE_NUMBER_INT);
if(isset($deleteId)){
	$users[$deleteId]->delete();

	array_splice($users, $deleteId, 1);
}

$users = User::all();
?>

<form class="d-flex justify-content-around" action="" method="POST">
	<input type="text" placeholder="E-mail" name="email" />
	<input type="text" placeholder="First Name" name="firstName" />
	<input type="text" placeholder="Last Name" name="lastName" />
	<input type="password" placeholder="Password" name="pass" />
	<button class="btn btn-success"name="add" value="1">Add</button>
</form>

<table class="table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Last Login</th>
			<th>Status</th>
			<th>Change</th>
			<th>Delete</th>
		</tr>
	</thead>
	<?php if($users): foreach($users as $key => $user): ?>
		<tr>
			<td><?= $user->firstName . " " . $user->lastName ?></td>
			<td><?= $user->lastLogin ?></td>
			<td><?= $user->status ?></td>
			<td><a href="?page=user/change&id=<?= $user->id ?>"><button class="btn btn-warning">change</button></a></td>
			<td><form method="POST"><button name="delete" class="btn btn-danger" value="<?= $key ?>">Delete</button></form></td>
		</tr>
	<?php endforeach; endif; ?>
</table>
