<?php
	session_start();
	$updateError = "";
    include_once("./common.php");
	include_once("../models/user.php");
    if (array_key_exists("update", $_POST)) {
		Database::connect('register', 'root', '');
		$user = new User($_SESSION['id']);
		$user->name = safeGet("updateName");
		$user->email = safeGet("updateEmail");
		$hash = password_hash(safeGet("updatePassword"), PASSWORD_DEFAULT);
		$user->password = $hash;
		if ($_FILES['updatePhoto']['name']) {
			$user->image = $_FILES['updatePhoto']['name'];
			$target = "images/". basename($_FILES["updatePhoto"]["name"]);
			if (move_uploaded_file($_FILES["updatePhoto"]["tmp_name"], $target)) {
				$user->save(2);
			} else {
				$user->save(1);
				$updateError = '<div class="alert alert-success" role="alert">Sorry, there was an error updating your photo.</div>';
				$_SESSION['updateError'] = $updateError;
				header("Location: ../profile.php?updateError=1");
			}
		} else {
			$user->save(1);
		}
		header("Location: ../profile.php?updateError=0");
    }
?>