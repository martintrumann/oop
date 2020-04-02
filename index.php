<?php
if (!isset($_SESSION)){
	session_start();
}

require "database.php";

$allPages = ["task/list", "task/alter", "task/change", "user/list", "user/alter", "user/change"];
$allowedPages = ["task/list", "user/list"];

$getPage = filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRING);

if(!isset($getPage)){
	$page = "task/list";
}elseif($getPage == "logout"){
	require("./class/Auth.php");
	Auth::logout();
	header("Location: ?");
}elseif(in_array($getPage, $allPages)){
	if(in_array($getPage, $allowedPages)){
		$page = $getPage;
	}elseif(in_array($getPage, $allPages) && !empty($_SESSION["is_logged_in"])){
		$page = $getPage;
	}else{
		$page = "login";
	}
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
	<?php if($page != "login"): ?>
		<?php require "./views/menu.php" ?>
	<?php endif ?>
	<?php require "./views/" . $page . ".php" ?>
</body>
</html>
