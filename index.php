<?php
if (!isset($_SESSION)){
	session_start();
}

require "database.php";

require "views/index.php";
?>
