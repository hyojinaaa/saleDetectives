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

		$sql = "SELECT review.id, user_id, location, image1, image2, created_at, title AS score_title, description AS score_description, username AS score_username
				FROM review
				JOIN user
				ON user.id = user_id
				WHERE 
					title LIKE '%$searchTerm%' OR
					description LIKE '%$searchTerm%' OR
					username LIKE '%$searchTerm%'
				ORDER BY score_title ASC";

		$result = $this->dbc->query($sql);

		if( !$result || $result->num_rows == 0){

			$this->data['searchResults'] = "No Results";

		} else{
			
			$this->data['searchResults'] = $result->fetch_all(MYSQLI_ASSOC);
		}
	}

	

	
}