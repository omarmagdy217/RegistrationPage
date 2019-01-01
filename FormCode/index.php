<?php
	include_once("./controllers/common.php");
	include_once("./components/header.php");
    session_start();
	$error = "";
    if (safeGet('logout')) {
        session_unset();
		session_destroy();
		unset($_COOKIE["id"]);
        setcookie("id", "", time() - 60*60,'/');
		echo '<style type="text/css">
				#signUpForm {
						display:none;
				}
			  </style>';
    } else if (array_key_exists("id", $_SESSION) OR array_key_exists("id", $_COOKIE)) {
		header("Location: profile.php");
    } else if(safeGet('error') != null) {
		$error = $_SESSION['error'];
		if(safeGet('error')) {
			echo '<style type="text/css">
					#signUpForm {
						display:none;
					}
				  </style>';
		} else {
			echo '<style type="text/css">
					#logInForm {
						display:none;
					}
				  </style>';
		}
	} else {
		echo '<style type="text/css">
				#logInForm {
					display:none;
				}
			  </style>';
	}
?>

	<div class="container">
	    <h1 class="center">Registration Form</h1>
		<div id="error"><?php echo $error; ?></div>
		<form action="controllers/registeruser.php" method="post" id = "signUpForm" class="resgiter" enctype='multipart/form-data'>
		  <input type="hidden" name="signUp" value=1>
		  <div class="form-group">
			<label for="formUserName"><strong>Name</strong></label>
			<input type="text" name="username" class="form-control" id="formUserName" placeholder="Enter your name">
		  </div>
		  <div class="form-group">
			<label for="signUpFormEmail"><strong>Email address</strong></label>
			<input type="email" name="email" class="form-control" id="signUpFormEmail" aria-describedby="emailHelp" placeholder="Enter email">
		  </div>
		  <div class="form-group">
			<label for="signUpFormPassword"><strong>Password</strong></label>
			<input type="password" name="password" class="form-control" id="signUpFormPassword" placeholder="Password">
		  </div>
		  <div class="form-group form-check center">
			<input type="checkbox" name="stayLoggedIn" class="form-check-input" id="signUpFormCheck" value=1>
			<label class="form-check-label" for="signUpFormCheck">Stay logged in</label>
		  </div>
		  <div class="form-group">
			<label for="formFile"><strong>Photo</strong></label>
			<input type="file" name="photo" accept=".gif,.jpg,.jpeg,.png" class="form-control-file" id="formFile">
		  </div>
		  <div class="form-group">
			<button type="submit" name="submit" class="btn btn-success">Sign Up!</button>
		  </div>
		  <p class="center"><a href="#" class="toggleForms">Log in</a></p>
		</form>
		
		<form action="controllers/registeruser.php" method="post" id = "logInForm" class="resgiter">
		  <input type="hidden" name="signUp" value=0>
		  <div class="form-group">
			<label for="logInFormEmail"><strong>Email address</strong></label>
			<input type="email" name="email" class="form-control" id="logInFormEmail" aria-describedby="emailHelp" placeholder="Enter email">
		  </div>
		  <div class="form-group">
			<label for="logInFormPassword"><strong>Password</strong></label>
			<input type="password" name="password" class="form-control" id="logInFormPassword" placeholder="Password">
		  </div>
		  <div class="form-group form-check center">
			<input type="checkbox" name="stayLoggedIn" class="form-check-input" id="logInFormCheck" value=1 checked>
			<label class="form-check-label" for="logInFormCheck">Stay logged in</label>
		  </div>
		  <div class="form-group">
		    <button type="submit" name="submit" class="btn btn-success">Log In!</button>
		  </div>
		  <p class="center"><a href="#" class="toggleForms">Sign up</a></p>
		</form>
	</div>
	
<?php include("./components/footer.php"); ?>