<style>
nav{
display: flex;
width: 100%;
justify-content: space-around;
}
</style>

<nav>
	<a href="?page=task/list">Tasks</a>
	<a href="?page=user/list">Users</a>
	<?php if(!empty($_SESSION["is_logged_in"])): ?>
		<a href="?page=task/alter">Change tasks</a>
		<a href="?page=user/alter">Change users</a>
		<a href="?page=logout">logout</a>
	<?php else: ?>
		<a href="?page=login">login</a>
	<?php endif ?>
</nav>
