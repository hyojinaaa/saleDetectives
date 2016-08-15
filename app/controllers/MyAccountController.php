<?php 

class MyAccountController extends PageController {

	// Properties (attributes)

	// Constructor
	public function __construct($dbc) {

		parent::__construct();

		// Save this database connection for later
		$this->dbc = $dbc;
	}

	// Methods (functions)


	public function buildHTML() {

		echo $this->plates->render('my-account');

		// // Prepare a container for data
		// $data = [];
	}

	
}