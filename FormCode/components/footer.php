   
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
         
	<!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
 
	<script type="text/javascript">
		$(document).ready(function() {
			$(".toggleForms").click(function() {
				$("#signUpForm").toggle();
				$("#logInForm").toggle();
				$("#error").html("");
			});   
			$('#logout').click(function(event) {
				window.location.href = "index.php?logout=1";
			});
			$('#edit').click(function(event) {
				$("fieldset").removeAttr("disabled");
				$("#disabledPassword").val("");
			});
			$("#signUpForm").submit(function(e) {
				var error = "";
				if ($("#formUserName").val() == "") {
				  error += "Name is required.<br>"
				}
				if ($("#signUpFormEmail").val() == "") {
				  error += "The email field is required.<br>"
				}
				if ($("#signUpFormPassword").val() == "") {
				  error += "The password is required.<br>"
				}
				if ($("#formFile").val() == "") {
				  error += "Photo is required.<br>"
				}
				if (error != "") {
					$("#error").html('<div class="alert alert-danger" role="alert"><p><strong>There were error(s) in your form:</strong></p>' + error + '</div>');
					return false;
				} else {
					return true;
				}
			});  
			$("#logInForm").submit(function(e) {
				var error = "";
				if ($("#logInFormEmail").val() == "") {
				  error += "The email field is required.<br>"
				}
				if ($("#logInFormPassword").val() == "") {
				  error += "The password is required.<br>"
				}
				if (error != "") {
					$("#error").html('<div class="alert alert-danger" role="alert"><p><strong>There were error(s) in your form:</strong></p>' + error + '</div>');
					return false;
				} else {
					return true;
				}
			});   			
		});   
	</script>
      
  </body>
</html>
