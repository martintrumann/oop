<?php
class Task{
	public $id;
	public $name;
	public $desc;

	public static function find($id = 0){
		global $pdo;
		$statement = $pdo->prepare('SELECT * FROM Task where id=? LIMIT 1');
		$statement->setFetchMode(PDO::FETCH_CLASS, 'Task');
		$statement->execute([$id]);
		return $statement->fetch();
	}

	public static function all(){
		global $pdo;
		$statement = $pdo->prepare('SELECT * FROM Task');
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_CLASS, 'Task');
	}

	public function insert(){
		global $pdo;
		$sql = "INSERT INTO Task (name, `desc`) VALUES (:name, :desc)";
		$stmt = $pdo->prepare($sql);

		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":desc", $this->desc);

		$success = $stmt->execute();

		if($success){
			$this->id = $pdo->lastInsertId();
		}

		return $success;
	}

	public function update(){
		global $pdo;
		$sql = "UPDATE Task SET name=:name desc=:desc WHERE id=:id";

		$stmt = $pdo->prepare($sql);

		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":desc", $this->desc);
		$stmt->bindParam(":id", $this->id);

		$success = $stmt->execute();

		return $success;
	}

	public function delete(){
		global $pdo;
		$deletestmt = $pdo->prepare("DELETE FROM Task WHERE id=:id");
		$deletestmt->execute(["id"=> $this->id]);
	}
}
?>
