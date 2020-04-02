<?php require("./class/Task.php");
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$task = Task::find($id);

$action = filter_input(INPUT_POST, "action", FILTER_SANITIZE_STRING);
if($action == "change"){
	$errors = [];
	$name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
	if(empty($name)){
		array_push($errors, "name cannot be empty");
	}

	$desc = filter_input(INPUT_POST, "desc", FILTER_SANITIZE_STRING);
	if(empty($desc)){
		array_push($errors, "desc cannot be empty");
	}

	if(count($errors) == 0){
		$bookstmt = $pdo->prepare("UPDATE Task SET name=:name, `desc`=:desc WHERE id=:id");
		try {
			$bookstmt->execute(["name"=> $name, "desc"=> $desc, "id" => $id]);
			header("Location: #");
		} catch(PDOExpection $e){
			echo $e;
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<?php if(!isset($id)): ?>
		<h1>Id not set</h1>
	<?php elseif(empty($task)): ?>
		<h1>Task Not found</h1>
	<?php elseif(!empty($task)):?>
		<?php if(!empty($errors) && isset($errors)):?>
			<div class="errors"><ul class="errorlist"><li class="error"><?php echo join("</li><li class=\"error\">", $errors)?></li></ul></div>
		<?php endif?>
		<form method="post" action="">
			<input name="id" type="hidden" value="<?=$task->id?>">
			<input name="name" type="" value="<?=$task->name?>">
			<input name="desc" type="" value="<?=$task->desc?>">
			<button name="action" value="change">Change</button>
		</form>
	<?php endif?>
	<a href="index.php"><button>Back</button></a>
</body>
</html>
