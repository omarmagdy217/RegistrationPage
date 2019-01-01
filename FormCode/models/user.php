<?php
	include_once('database.php');

	class User extends Database{
		function __construct($id) {
			$sql = "SELECT * FROM users WHERE id = $id;";
			$statement = Database::$db->prepare($sql);
			$statement->execute();
			$data = $statement->fetch(PDO::FETCH_ASSOC);
			if(empty($data)){return;}
			foreach ($data as $key => $value) {
				$this->{$key} = $value;
			}
		}

		public static function add($name,$email,$password,$photo) {
			$hash = password_hash($password, PASSWORD_DEFAULT);
			$sql = "INSERT INTO users (name, email ,password, image) VALUES (?,?,?,?);";
			$statement = Database::$db->prepare($sql);
			$statement->execute([$name, $email, $hash, $photo]);
			if(!$statement) {
				return 0;
			}
			else {
				$target = "images/". basename($_FILES["photo"]["name"]);
				$LAST_ID = Database::$db->lastInsertId();
				if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target)) {
					$_SESSION['id'] = $LAST_ID;
					if (safeGet('stayLoggedIn')) {
						setcookie("id", $LAST_ID, time() + 60*60*24*5,'/');
					} 
					return 2;
				} else {
					$sql = "DELETE FROM users WHERE id = $LAST_ID;";
					Database::$db->query($sql);
					return 1;
				}
			}
		}
				
		public function save($type) {
			if($type == 2) {
				$sql = "UPDATE users SET name = ?, email = ?, password = ?, image = ? WHERE id = ?;";
				Database::$db->prepare($sql)->execute([$this->name, $this->email, $this->password, $this->image, $this->id]);
			} else if($type == 1) {
				$sql = "UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?;";
				Database::$db->prepare($sql)->execute([$this->name, $this->email, $this->password, $this->id]);
			}
		}

		public static function check($email) {
			$sql = "SELECT COUNT(*) FROM users WHERE email = '$email';";
			$statement = Database::$db->prepare($sql);
			$statement->execute();
			$res = $statement->fetchColumn();
			if($res > 0){
				return 1;
			}
			else {
				return 0;
			}
		}
		public static function logIn($email,$password) {
			$sql = "SELECT * FROM users WHERE email = '$email';";
			$statement = Database::$db->prepare($sql);
			$statement->execute();
			$data = $statement->fetch(PDO::FETCH_ASSOC);
			if(!empty($data)) {
				if(password_verify($password, $data['password'])){
					$_SESSION['id'] = $data['id'];
					if (safeGet('stayLoggedIn')) {
						setcookie("id", $data['id'], time() + 60*60*24*5,'/');
					} 
					return 2;
				} else {
					return 1;
				}
			} else {
				return 0;
			}
			foreach ($data as $key => $value) {
				$this->{$key} = $value;
			}
		}

	}
?>