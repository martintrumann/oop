<?php
if (!isset($_SESSION)){
	session_start();
}

require "database.php";

$allPages = ["task/list", "login", "task/alter", "task/change", "user/list", "user/alter", "user/change"];
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

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Tasker</title>

	<!-- Bootstrap core CSS -->
	<link href="jscss/bootstrap.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="style.css" rel="stylesheet">

</head>

<body>

	<div class="d-flex" id="wrapper">

		<!-- Sidebar -->
		<div class="bg-light border-right" id="sidebar-wrapper">
			<div class="sidebar-heading">Tasker</div>
			<div class="list-group list-group-flush">
				<a href="?page=task/list" class="list-group-item list-group-item-action bg-light">Tasks</a>
				<a href="?page=user/list" class="list-group-item list-group-item-action bg-light">Users</a>
				<?php if(!empty($_SESSION["is_logged_in"])): ?>
					<a href="?page=task/alter" class="list-group-item list-group-item-action bg-light">Change tasks</a>
					<a href="?page=user/alter" class="list-group-item list-group-item-action bg-light">Change users</a>
					<a href="?page=logout" class="list-group-item list-group-item-action bg-light">Logout</a>
				<?php else: ?>
					<a href="?page=login" class="list-group-item list-group-item-action bg-light">Login</a>
				<?php endif ?>
			</div>
		</div>
		<!-- /#sidebar-wrapper -->

		<!-- Page Content -->
		<div id="page-content-wrapper">

			<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
				<button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

<!--
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
						<li class="nav-item active">
							<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Link</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Dropdown
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</li>
					</ul>
				</div>
-->
			</nav>

			<div class="container-fluid">
				<?php require "./views/" . $page . ".php" ?>
			</div>
		</div>
		<!-- /#page-content-wrapper -->

	</div>
	<!-- /#wrapper -->

	<!-- Bootstrap core JavaScript -->
	<script src="jscss/jquery.min.js"></script>
	<script src="jscss/bootstrap.bundle.min.js"></script>

	<!-- Menu Toggle Script -->
	<script>
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});
	</script>

</body>

</html>
