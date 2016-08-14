<?php 

class SignUpController extends PageController {

	// Properties (attributes)
	private $emailMessage;

	// Constructor
	public function __construct($dbc) {
		parent::__construct();

		// Save this database connection for later
		$this->dbc = $dbc;

		// If the user has submitted the registration form
		if( isset($_POST['new-account-button']) ) {
			$this->processNewAccount();
		}
	}

	// Methods (functions)


	public function buildHTML() {

		// Prepare a container for data
		$data = [];

		// If there is an E-mail error
		if($this->emailMessage != '') {
			$data['emailMessage'] = $this->emailMessage;
		}

		echo $this->plates->render('signup', $data);
	}

	private function processNewAccount() {

		$totalErrors = 0;

		// Make sure the E-Mail is not in use
		$filteredEmail = $this->dbc->real_escape_string( $_POST['email'] );

		$sql = "SELECT email
				FROM user
				WHERE email = '$filteredEmail'  ";

				// Run the query 
				$result = $this->dbc->query($sql);

		// If the query failed OR there is a result
		if( !$result || $result->num_rows > 0 ) {
			$this->emailMessage = 'This E-Mail is already in use';
			$totalErrors++;
		}

		if( $totalErrors == 0 ) {		

			// Hash the password 
			$hash = password_hash( $_POST['password'], PASSWORD_BCRYPT );

			$username = $this->dbc->real_escape_string( $_POST['username'] );

			// Prepare the SQL
			$sql = "INSERT INTO user (email, password, username)
					VALUES ('$filteredEmail', '$hash', '$username') ";
			
			// Run the query
			$this->dbc->query($sql);

			// Log the user in
			$_SESSION['id'] = $this->dbc->insert_id;

			// Redirect the user to their landing page
			header('Location: index.php?page=signup-success');

		}

	}

}
