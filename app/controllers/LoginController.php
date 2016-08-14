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

		// Check the database for the E-Mail address
		// Get the hashed password too
		$filteredEmail = $this->dbc->real_escape_string( $_POST['email'] );

		$sql = "SELECT id, password
				FROM user
				WHERE email= '$filteredEmail'   ";

		// Run the query
		$result = $this->dbc->query( $sql );

		// Is there a result?
		if( $result->num_rows == 1 ) {
			
			$userData = $result->fetch_assoc();

			// Check the password
			$passwordResult = password_verify( $_POST['password'], $userData['password'] );

			// If the result was good 
			if( $passwordResult == true ) {
				// Log the user in
				$_SESSION['id'] = $userData['id'];

				header('Location: index.php?page=landing');
			} else {

				// Prepare error message
				$this->data['loginMessage'] = 'E-mail or Password incorrect';
			}

		} else {

			// Credentials do not match our records
			$this->data['loginMessage'] = 'E-mail or Password incorrect';

		}
	}
}




