<?php 

class SaleIndividualController extends PageController {

	// Properties (attributes)

	// Constructor
	public function __construct($dbc) {

		parent::__construct();

		// Save this database connection for later
		$this->dbc = $dbc;
	}

	// Methods (functions)


	public function buildHTML() {

		echo $this->plates->render('sale-calendar-individual');

		// // Prepare a container for data
		// $data = [];
	}

	
}