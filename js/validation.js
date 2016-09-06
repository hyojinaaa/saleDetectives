$(document).ready(function() {

	var ValidEmail = false;
	var ValidPassword = false;
	var ValidUsername = false;
	var ValidConfirmPassword = false;

	// Validate Email

	// $('#email').focus(function() {
	// 	alert("test");
	// });
	$('#email').blur(function() {
		$('#emailMessage').empty();

		// Must be required
		if( $(this).val().length === 0 ){

			$('#emailMessage').removeClass("success").addClass("error").append("<p>Email address is required</p>");
			ValidEmail = false;
			return;
		}

		// Checks with Regular Express to see if it is a valid Email
			var reg = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
		if( !$(this).val().match(reg)){
			$("#emailMessage").removeClass("success").addClass("error").append("<p>This email address is invalid</p>");
			ValidEmail = false;
			return;
		}

		//Success
		$("#emailMessage").removeClass("error").addClass("success").append("<p>This email address is available</p>");
		ValidEmail = true;


	});

	$('#password').blur(function(){
		$("#passwordMessage").empty();
		
		//Must be Required
		if( $(this).val().length === 0 ){
			$("#passwordMessage").removeClass("success").addClass("error").append("<p>Password is required</p>");
			ValidPassword = false;
			return;
		}

		//Must be at least 8 Characters
		if( $(this).val().length < 8 ){
			$("#passwordMessage").removeClass("success").addClass("error").append("<p>Password must be at least 8 Characters</p>");
			ValidPassword = false;
			return;
		}

		//Must be at least 8 Characters
		if( $(this).val().length > 20 ){
			$("#passwordMessage").removeClass("success").addClass("error").append("<p>Password must be at most 20 Characters</p>");
			ValidPassword = false;
			return;
		}

		//Success
		$("#passwordMessage").removeClass("error").addClass("success").append("<p>This password is valid</p>");
		ValidPassword = true;

	});

	//Validate Confirom Password
	$( "#confirm-password" ).blur(function() {
		$("#confirmPasswordMessage").empty();



		//Must be required
		if( $(this).val().length === 0 ){
			$("#confirmPasswordMessage").removeClass("success").addClass("error").append("<p>Please confirm your password</p>");
			ValidConfirmPassword = false;
			return;
		}

		//Must match previous password
		var Match = $("#password").val();
		if( !$(this).val().match(Match)){
			$("#confirmPasswordMessage").removeClass("success").addClass("error").append("<p>Password does not match</p>");
			ValidConfirmPassword = false;
			return;
		}

		//Success
		$("#confirmPasswordMessage").removeClass("error").addClass("success").append("<p>Password is confirmed</p>");
		ValidConfirmPassword = true;
	});

	//Validate Name
	$( "#username" ).blur(function() {
		$("#usernameMessage").empty();

		//Must be required
		if( $(this).val().length === 0 ){
			$("#usernameMessage").removeClass("success").addClass("error").append("<p>User name is required</p>");
			ValidUsername = false;
			return;
		}

		//Cannot be greater than 20 Characters
		if( $(this).val().length > 20 ){
			$("#usernameMessage").removeClass("success").addClass("error").append("<p>User name must be at most 20 characters</p>");
			ValidUsername = false;
			return;
		}

		//Success
		$("#usernameMessage").removeClass("error").addClass("success").append("<p>This user name is available</p>");
		ValidUsername = true;
	});

	//When submit button is clicked
	$('#new-account').click(function(event) {
		event.preventDefault();
		if(ValidEmail === true && ValidPassword === true && ValidConfirmPassword === true && ValidUsername === true) {
			$('#register').submit();
		}
	});




});

