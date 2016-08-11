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
}