<?php 

class MyAccountController extends PageController {

	// Properties (attributes)

	// Constructor
	public function __construct($dbc) {

		parent::__construct();

		// Save this database connection for later
		$this->dbc = $dbc;

		$this->mustBeLoggedIn();

		$this->getAccountData();
	}

	// Methods (functions)


	public function buildHTML() {

		echo $this->plates->render('my-account', $this->data);

		
	}

	private function getAccountData() {

		$userID = $_SESSION['id'];

		$sql = "SELECT id, email, username, profile_photo, star_point
				FROM user 
				WHERE id = $userID";

		$result = $this->dbc->query($sql);

		// If query failed
		if( !$result || $result->num_rows == 0 ) {
			// Redirect user to 404 page
			header('Location: index.php?page=error404');
		} else {
			// Yay! 
			$this->data['userData'] = $result->fetch_assoc();
		}
	}

	
}