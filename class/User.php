<?php
class User{
	public $id;
	public $email;
	public $firstName;
	public $lastName;
	public $lastLogin;
	public $pass;
	public $status;
	public $role;

	public static function find($id = 0){
		global $pdo;
		$statement = $pdo->prepare('SELECT * FROM User where id=? LIMIT 1');
		$statement->setFetchMode(PDO::FETCH_CLASS, 'User');
		$statement->execute([$id]);
		return $statement->fetch();
	}

	public static function all(){
		global $pdo;
		$statement = $pdo->prepare('SELECT id, email, firstName, lastName, status, lastLogin, role FROM User');
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_CLASS, 'User');
	}

	public function login($pass){
		global $pdo;
		global $_SESSION;

		if(password_verify($pass, $this->password)){
			$_SESSION["login"] = true;
			$sql = "UPDATE User SET lastLogin=NOW() WHERE id=:id)";
			return 1;
		}else{
			return 0;
		}

	}

	public function insert(){
		global $pdo;
		$sql = "INSERT INTO User (email, firstName, lastName, lastLogin, pass, status, role) VALUES (:email, :firstName, :lastName, :lastLogin, :pass, :status, :role)";
		$stmt = $pdo->prepare($sql);

		$stmt->bindParam(":email", $this->email);
		$stmt->bindParam(":firstName", $this->firstName);
		$stmt->bindParam(":lastName", $this->lastName);
		$stmt->bindParam(":lastLogin", $this->lastLogin);
		$stmt->bindParam(":pass", $this->pass);
		$stmt->bindParam(":status", $this->status);
		$stmt->bindParam(":role", $this->role);

		$success = $stmt->execute();

		if($success){
			$this->id = $pdo->lastInsertId();
		}

		return $success;
	}

	public function update(){
		global $pdo;
		$sql = "UPDATE User SET email=:email, firstName=:firstName, lastName=:lastName, pass=:pass, status=:status, role=:role WHERE id=:id)";

		$stmt->bindParam(":email", $this->email);
		$stmt->bindParam(":lastName", $this->lastName);
		$stmt->bindParam(":lastLogin", $this->lastLogin);
		$stmt->bindParam(":pass", $this->pass);
		$stmt->bindParam(":status", $this->status);
		$stmt->bindParam(":role", $this->role);

		$stmt->bindParam(":id", $this->id);

		$success = $stmt->execute();

		return $success;
	}

	public function delete(){
		global $pdo;
		$deletestmt = $pdo->prepare("DELETE FROM User WHERE id=:id");
		$deletestmt->execute(["id"=> $this->id]);
	}
}
?>
