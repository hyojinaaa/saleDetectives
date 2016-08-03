<?php 

class LandingController extends PageController {

	// Properties (attributes)

	// Constructor
	public function __construct() {

		parent::__construct();
	}

	// Methods (functions)


	public function buildHTML() {

		$plates = new League\Plates\Engine('app/templates');

		echo $plates->render('landing');
	}
}