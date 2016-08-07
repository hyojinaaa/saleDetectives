<?php 

class LandingController extends PageController {

	// Properties (attributes)

	// Constructor
	public function __construct() {

		parent::__construct();
	}

	// Methods (functions)


	public function buildHTML() {

		echo $this->plates->render('landing');
	}
}