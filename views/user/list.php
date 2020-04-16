<?php
require("./class/User.php");
$users = User::all();

?>
<table class="table">
	<thead>
		<tr>
			<th>Name</th>
			<th>last Login</th>
			<th>Role</th>
		</tr>
	</thead>
	<?php if($users): foreach($users as $key => $user): ?>
		<tr>
			<td><?= $user->firstName . " " . $user->lastName ?></td>
			<td><?= $user->lastLogin ?></td>
			<td><?= $user->role ?></td>
		</tr>
	<?php endforeach; endif; ?>
</table>
