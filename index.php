<?php
if (!isset($_SESSION)){
	session_start();
}

require "database.php";

$allowedPages = ["task/list", "task/change", "user/list", "user/change"];

$getPage = filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRING);

if(!isset($getPage)){
	$page = "task/list";
}elseif(in_array($getPage, $allowedPages)){
	$page = $getPage;
}else{
	$page = "404";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<?php require "./views/menu.php" ?>
	<?php require "./views/" . $page . ".php" ?>
</body>
</html>
