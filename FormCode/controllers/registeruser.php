<?php
	session_start();
	$error = "";  
    include_once("./common.php");
	include_once("../models/user.php");
    if (array_key_exists("submit", $_POST)) {
		Database::connect('register', 'root', '');
		if (!safeGet('username') && safeGet('signUp')) {
            $error .= "Name is required<br>";
        } 
        if (!safeGet('email')) {
            $error .= "An email address is required<br>";
        } 
        if (!safeGet('password')) {
            $error .= "A password is required<br>";
        } 
		if (!($_FILES['photo']['name']) && safeGet('signUp')) {
            $error .= "Photo is required<br>";
        } 
		if (empty($error)) {
            if (safeGet('signUp')) {
                if (User::check(safeGet('email'))) {
                    $error = "That email address is taken.";
                } else {
					if($upload = User::add(safeGet('username'),safeGet('email'),safeGet('password'),$_FILES['photo']['name'])) {
						if($upload == 2) {
							$emailTo = safeGet('email');
							$subject = "Welcome";
							$content = "We are glad to serve you.";
							$headers = "From: omr.magdy217@gmail.com";
							if (mail($emailTo, $subject, $content, $headers)) {
								$successMessage = '<div class="alert alert-success" role="alert">You are signed-up successfully, check your mail inbox!</div>';
								$_SESSION['success'] = $successMessage;
								header("Location: ../profile.php?success=1");
							} else {
								header("Location: ../profile.php?success=0");
							}
						} else if($upload == 1){
							$error = "Sorry, there was an error uploading your photo.";
						}
                    } else {
						$error = "<p>Could not sign you up - please try again later.</p>";
					}
                } 
                
            } else {                
				if ($log = User::logIn(safeGet('email'),safeGet('password'))) {
					if ($log == 2) {
						header("Location: ../profile.php");
					} else if ($log == 1) {
						$error = "That email/password combination could not be found.";
					}
				} else {
					$error = "This email could not be found.";
				}
			}
        }
		if (!empty($error)) {
            $error = '<div class="alert alert-danger" role="alert"><p><strong>There were error(s) in your form:</strong></p>' . $error . '</div>';
			$_SESSION['error'] = $error;
			if (safeGet('signUp')) {
				header("Location: ../index.php?error=0");
			} else if(!safeGet('signUp')) {
				header("Location: ../index.php?error=1");	
			}
        }
    }
?>