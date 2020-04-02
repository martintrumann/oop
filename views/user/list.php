<?php
require("./class/User.php");
$users = User::all();

?>
<table>
	<?php if($users): foreach($users as $key => $user): ?>
		<tr>
			<td><?= $user->firstName . " " . $user->lastName ?></td>
			<td><?= $user->lastLogin ?></td>
			<td><?= $user->status ?></td>
		</tr>
	<?php endforeach; endif; ?>
</table>
