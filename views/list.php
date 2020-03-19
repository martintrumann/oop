<?php
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
	header("Location: #");
}

$tasks = Task::all();
?>

<form action="" method="POST">
	<input type="text" name="name" />
	<textarea name="desc" cols="30" rows="1"></textarea>
	<button name="add" value="1">Add</button>
</form>
<table>
	<?php if($tasks): foreach($tasks as $key => $task): ?>
	<tr>
		<td><?= $task->name ?></td>
		<td><?= $task->desc ?></td>
		<td><form method="POST"><button name="delete" value="<?= $key ?>">Delete</button></form></td>
		<td><a href="change.php?id=<?= $task->id ?>"><button>change</button></a></td>
	</tr>
	<?php endforeach; endif; ?>
</table>
