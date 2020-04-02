<?php
require("./class/Task.php");
$tasks = Task::all();
?>

<table>
	<?php if($tasks): foreach($tasks as $key => $task): ?>
	<tr>
		<td><?= $task->name ?></td>
		<td><?= $task->desc ?></td>
	</tr>
	<?php endforeach; endif; ?>
</table>
