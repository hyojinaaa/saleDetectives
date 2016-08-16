<?php 

class ReviewPostController extends PageController {

	// Properties (attributes)

	// Constructor
	public function __construct($dbc) {

		parent::__construct();

		// Save this database connection for later
		$this->dbc = $dbc;

		$this->mustBeLoggedIn();

		// Did the user submit the new review form?
		if( isset($_POST['new-review']) ) {
			$this->processNewReview();
		}
	}

	// Methods (functions)


	public function buildHTML() {

		echo $this->plates->render('review-post', $this->data);

		// // Prepare a container for data
		// $data = [];
	}

	private function processNewReview() {

		// Count errors
		$totalErrors = 0;

		$title = trim($_POST['title']);
		$desc = trim($_POST['description']);
		$location = trim($_POST['location']);

		// Title
		if( strlen($title) == 0 ) {

			$this->data['titleMessage'] = 'Title is required';
			$totalErrors++;

		} elseif( strlen($title) > 100 ) {

			$this->data['titleMessage'] = 'Title cannot be more than 100 characters';
			$totalErrors++;

		}

		// Location
		if( strlen($location) == 0 ) {

			$this->data['locationMessage'] = 'Store location is required';
			$totalErrors++;

		} elseif( strlen($location) > 20 ) {

			$this->data['locationMessage'] = 'Store location cannot be more than 20 characters';
			$totalErrors++;

		}

		// Description
		if( strlen($desc) == 0 ) {

			$this->data['textMessage'] = 'Review is required';
			$totalErrors++;

		} elseif( strlen($desc) > 1000 ) {

			$this->data['textMessage'] = 'Review cannot be more than 1000 characters';
			$totalErrors++;

		}

		// If there are no errors
		if( $totalErrors == 0 ) {

			// Filter the data
			$filteredTitle = $this->dbc->real_escape_string($title);
			$reviewAbout = $_POST['review-about'];
			$filteredLoc = $this->dbc->real_escape_string($location);
			$filteredDesc = $this->dbc->real_escape_string($desc); 

			// Get the ID of logged in user
			$userID = $_SESSION['id'];

			// SQL (INSERT)
			$sql = "INSERT INTO review (title, review_about, location, description, user_id)
					VALUES ('$filteredTitle', '$reviewAbout', '$filteredLoc', '$filteredDesc', $userID) ";

			$this->dbc->query($sql);

			header('Location: index.php?page=review');



		}


	}

	
}















