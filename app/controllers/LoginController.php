<?php 

class LoginController extends PageController {

	// Properties (attributes)

	// Constructor
	public function __construct($dbc) {
		parent::__construct();

		// Save this database connection for later
		$this->dbc = $dbc;

		// If the login form has been submitted
		if(isset($_POST['login-button']) ){
			$this->processLogIn();
		}
	}

	// Methods (functions)


	public function buildHTML() {

		echo $this->plates->render('login', $this->data);
	}

	

	private function processLogIn() {

		$totalErrors = 0;

		// Make sure the email address has been provided
		if( strlen($_POST['email']) < 6 ) {

			// Prepare error message
			$this->data['emailMessage'] = "This is an invalid E-mail address";
			$totalErrors++;

		}

		// Make sure password is at least 8 characters
		if( strlen($_POST['password']) < 8 ) {

			$this->data['passwordMessage'] = 'This is an invalid password';
			$totalErrors++;
		}
	}
}




