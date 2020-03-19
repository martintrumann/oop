<?php

$allowedPages = ["list", "change"];

$getPage = filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRING);

if(!isset($getPage)){
	$page = "list";
}elseif(in_array($page, $allowedPages)){
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
	<?php require "./views/" . $page . ".php" ?>
</body>
</html>
