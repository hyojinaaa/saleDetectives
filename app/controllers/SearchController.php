<?php 

class SearchController extends PageController {

	// Properties (attributes)

	// Constructor
	public function __construct($dbc) {

		parent::__construct();

		// Save this database connection for later
		$this->dbc = $dbc;

		$this->mustBeLoggedIn();

		$this->getSearch();
		
	}

	// Methods (functions)


	public function buildHTML() {

		echo $this->plates->render('search', $this->data);

	}

	public function getSearch() {

		if(strlen($_POST['search']) === 0){
			$searchTerm = "";
		} else {
			$result = $_POST['search'];
			$searchTerm = strtolower($result);
		}

		$this->data['searchTerm'] = $searchTerm;

		$sql = "SELECT id, title AS search_title, description AS search_description, username AS search_username
				FROM review
				WHERE 
					title LIKE '%$searchTerm%' OR
					description LIKE '%$searchTerm%' OR
					username LIKE '%$searchTerm%'
				ORDER BY search_title ASC";

		$result = $this->dbc->query($sql);

		if( !$result || $result->num_rows == 0){

			$this->data['searchResults'] = "No Results";

		} else{
			
			$this->data['searchResults'] = $result->fetch_all(MYSQLI_ASSOC);
		}
	}

	

	
}