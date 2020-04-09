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

<main class="login">
	<form action="" method="POST">
		<input type="text" name="email" placeholder="email" />
		<input type="password" name="password" placeholder="password" />
		<button name="action" value="login">Login</button>
	</form>
</main>
