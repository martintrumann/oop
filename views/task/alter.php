<?php
require("./class/Task.php");
$tasks = Task::all();

$add = filter_input(INPUT_POST, "add", FILTER_SANITIZE_NUMBER_INT);
if(isset($add)){
	$name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
	$desc = filter_input(INPUT_POST, "desc", FILTER_SANITIZE_STRING);

	$task = new Task;

	$task->name = $name;
	$task->desc = $desc;

	$task->insert();
	array_push($tasks, $task);
}

$deleteId = filter_input(INPUT_POST, "delete", FILTER_SANITIZE_NUMBER_INT);
if(isset($deleteId)){
	$tasks[$deleteId]->delete();

	array_splice($tasks, $deleteId, 1);
}

$tasks = Task::all();
?>

<form class="d-flex justify-content-around"action="" method="POST">
	<input type="text" name="name" />
	<input type="text" name="desc" />
	<button class="btn btn-success" name="add" value="1">Add</button>
</form>

<table class="table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Change</th>
			<th>Delete</th>
		</tr>
	</thead>
	<?php if($tasks): foreach($tasks as $key => $task): ?>
		<tr>
			<td><?= $task->name ?></td>
			<td><?= $task->desc ?></td>
			<td><a href="?page=task/change&id=<?= $task->id ?>"><button class="btn btn-warning">change</button></a></td>
			<td><form method="POST"><button name="delete" class="btn btn-danger" value="<?= $key ?>">Delete</button></form></td>
		</tr>
	<?php endforeach; endif; ?>
</table>
