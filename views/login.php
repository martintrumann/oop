<?php
require("./class/Auth.php");

$action = filter_input(INPUT_POST, "action", FILTER_SANITIZE_STRING);
if($action == "login"){
	$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
	$pass = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

	$login = Auth::login($email, $pass);

	if($login["success"]): ?>
		<script type="text/javascript"> document.location = '?'; </script>
	<?php else:?>
		<?= $login["error"]; ?>
	<?php endif;
}

?>
<style>
.login{
	display: flex;
	justify-content:center;
	align-items: center;
	height:100%;
}

.login form{
	display:grid;
}

</style>

<form action="" method="POST">
	<input class="form-control" type="text" name="email" placeholder="email" />
	<input class="form-control" type="password" name="password" placeholder="password" />
	<button class="btn btn-primary" name="action" value="login">Login</button>
</form>
