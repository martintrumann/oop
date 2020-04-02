<?php
require("./class/Auth.php");
Auth::logout();

header("Location: #");
exit();
?>
