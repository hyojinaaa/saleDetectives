<?php 

class LandingController extends PageController {

	// Properties (attributes)

	// Constructor
	public function __construct($dbc) {

		parent::__construct();

		// Save this database connection for later
		$this->dbc = $dbc;

		// If the user has submitted the registration form
		if( isset($_POST['new-account']) ) {
			$this->processNewAccount();
		}
	}

	// Methods (functions)


	public function buildHTML() {

		echo $this->plates->render('landing');

		// // Prepare a container for data
		// $data = [];
	}

	
}