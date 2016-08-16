<?php 

class SalePostController extends PageController {

	// Properties (attributes)

	// Constructor
	public function __construct($dbc) {

		parent::__construct();

		// Save this database connection for later
		$this->dbc = $dbc;

		$this->mustBeLoggedIn();
	}

	// Methods (functions)


	public function buildHTML() {

		echo $this->plates->render('sale-calendar-post');

		// // Prepare a container for data
		// $data = [];
	}

	
}