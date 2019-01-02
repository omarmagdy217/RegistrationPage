<?php
    session_start();
	include_once("./controllers/common.php");
	include_once("./models/user.php");
	$successMessage = "";
	$updateError = "";
    if (array_key_exists("id", $_COOKIE)) {
        $_SESSION['id'] = $_COOKIE['id'];
    } 
	if (array_key_exists("id", $_SESSION)) {
		Database::connect('register', 'root', '');
		$user = new User($_SESSION['id']);
	}
	else {
        header("Location: ./index.php");
    }
	if((safeGet('success') != null) && (safeGet('success'))) {
		$successMessage = $_SESSION['success'];
	} else if((safeGet('updateError') != null) && (safeGet('updateError'))) {
		$updateError = $_SESSION['updateError'];
	}
	include("./components/header.php");
?>

	<nav class="navbar navbar-dark bg-dark fixed-top">
	  <a class="navbar-brand" href="#"><strong>Profile Page</strong></a>
	  <div class="div-inline">
		<button class="btn btn-outline-success my-2 my-sm-0" id="logout">Logout</button>
	  </div>
	</nav>
	
	<div id="success" style="text-align:center; width: 50%; margin: 70px auto;"><?php echo $successMessage; ?></div>
	<div id="updateError" style="text-align:center; width: 50%; margin: 70px auto;"><?php echo $updateError; ?></div>

	<div class="container-fluid" style="background-color:white; color:black; position:absolute; top:150px; border-radius: 5%;">
	  <div class="row">
		<div class="col-sm" style="border-right: 1px yellow solid; margin: 50px auto;">
			<div class="card" style="border: 2px green solid; border-style: dashed; text-align:center; width: 18rem; margin: 50px auto; display:block;">
			  <img src="images/<?=$user->image?>" class="card-img-top" height="200">
			  <div class="card-body">
				<h5 class="card-title"><?=$user->name?></h5>
				<a href="#" id="edit" class="btn btn-primary">Change</a>
			  </div>
			</div>
		</div>
		<div class="col-sm" style="border-left: 1px green solid; margin: 50px auto;">
			<form class="middle" action="controllers/updateuser.php" method="post" enctype='multipart/form-data'>
			  <fieldset disabled>
			  	<div class="form-group">
				  <label for="disabledName"><strong>Name</strong></label>
				  <input type="text" name="updateName" id="disabledName" class="form-control" value="<?=$user->name?>">
				</div>
				<div class="form-group">
				  <label for="disabledEmail"><strong>Email</strong></label>
				  <input type="text" name="updateEmail" id="disabledEmail" class="form-control" value="<?=$user->email?>">
				</div>
				<div class="form-group">
				  <label for="disabledPassword"><strong>Password</strong></label>
				  <input type="text" name="updatePassword" id="disabledPassword" class="form-control" value="<?=$user->password?>">
				</div>
				<div class="form-group">
					<label for="disabledFormFile"><strong>Photo</strong></label>
					<input type="file" name="updatePhoto" accept=".gif,.jpg,.jpeg,.png" class="form-control-file" id="disabledFormFile">
				</div>
				<button type="submit" name="update" class="btn btn-secondary">Update</button>
			  </fieldset>
			</form>
		</div>
	  </div>
	</div>
<?php
    
    include("./components/footer.php");
?>
