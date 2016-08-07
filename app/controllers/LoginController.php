<?php 

class LoginController extends PageController {

	// Properties (attributes)

	// Constructor
	public function __construct() {

		parent::__construct();

		// If the user has submitted the registration form
		// if( isset($_POST['new-account']) ) {

		// }

		
	}

	// Methods (functions)


	public function buildHTML() {

		echo $this->plates->render('landing');
	}
}