<?php 

class LoginController extends PageController {

	// Properties (attributes)

	// Constructor
	public function __construct() {

		parent::__construct();

		// If the user has submitted the registration form
		print_r( $_POST );

		
	}

	// Methods (functions)


	public function buildHTML() {

		echo $plates->render('landing');
	}
}