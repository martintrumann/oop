<?php
class Auth{
	public static function login($email, $password){
		global $pdo;

		$statement = $pdo->prepare('SELECT * FROM User WHERE email = :email');
		$statement->bindParam(":email", $email);

		$statement->execute();

		$account = $statement->fetch(PDO::FETCH_ASSOC);

		if($account){
			if(password_verify($password, $account["pass"])){
				$_SESSION["is_logged_in"] = 1;
				return array("success" => 1);
			} else {
				return array("success" => 0, "error" => "password wrong");
			}
		}else{
			return array("success" => 0, "error" => "username wrong");
		}
	}

	public static function logout(){
		session_unset();
		session_destroy();
		$_SESSION["is_logged_in"] = 0;
		return 1;
	}
}
