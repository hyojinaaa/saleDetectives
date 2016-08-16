<?php 

abstract class PageController {

	protected $plates;
	protected $dbc;
	protected $data = [];

	public function __construct() {

		// Instantiate (create instance of) Plates library
		$this->plates = new League\Plates\Engine('app/templates');

	}

	// Force children classes to have the buildHTML function
	abstract public function buildHTML();

	public function mustBeLoggedIn() {

		// If you are not logged in
		if( !isset($_SESSION['id']) ) {
			// Redirect the user to the login page
			header('Location: index.php?page=login');
			die();
		}
	}
}