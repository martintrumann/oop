<?php
require("./class/User.php");
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$user = User::find($id);

$change = filter_input(INPUT_POST, "change", FILTER_SANITIZE_NUMBER_INT);
if(isset($id) && $change){
	$inArr = filter_input_array(INPUT_POST, [
		'email'		=> FILTER_SANITIZE_EMAIL,
		"firstName"	=> FILTER_SANITIZE_STRING,
		"lastName"	=> FILTER_SANITIZE_STRING,
		'pass'		=> FILTER_SANITIZE_STRING,
		'status'	=> FILTER_SANITIZE_STRING,
	]);

	if($inArr["email"] != $user->email){
		$user->email		= $inArr["email"];
	}

	if($inArr["firstName"] != $user->firstName){
		$user->firstName	= $inArr["firstName"];
	}

	if($inArr["lastName"] != $user->lastName){
		$user->lastName		= $inArr["lastName"];
	}

	if($inArr["pass"] != $user->pass){
		$user->pass			= password_hash($inArr["pass"], PASSWORD_DEFAULT);
	}

	$user->update();
}

$user = User::find($id);
?>
<form style="display: grid; grid-template-columns: auto auto; align-items: center;" action="" method="POST">
	<?php foreach($user as $key => $val): ?>
		<label for="<?= $key?>"><?= $key?></label>
			<?php if(in_array($key, ["id", "lastLogin"])): ?>
				<p><?= $val ?></p>

			<?php elseif(in_array($key, ["status"])): ?>
				<input id="<?= $key?>" type="text" name="<?= $key?>" value="<?= $val?>" />
			<?php else: ?>
				<input id="<?= $key?>" type="text" name="<?= $key?>" value="<?= $val?>" required />
			<?php endif ?>
	<?php endforeach ?>
	<button style="grid-column: span 2;"name="change" value="1">Submit</button>
</form>
