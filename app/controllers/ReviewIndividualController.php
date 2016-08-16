<?php 

class ReviewIndividualController extends PageController {

	// Properties (attributes)

	// Constructor
	public function __construct($dbc) {

		parent::__construct();

		// Save this database connection for later
		$this->dbc = $dbc;

		$this->getReviewData();
	}

	// Methods (functions)


	public function buildHTML() {

		echo $this->plates->render('review-individual', $this->data);
	}

	private function getReviewData() {

		// Filter the ID
		$reviewID = $this->dbc->real_escape_string( $_GET['reviewid'] );

		// Get info about this post
		$sql = "SELECT title, review_about, location, description, image, created_at, user_id
				FROM review
				WHERE id = $reviewID";

		// Run the SQL
		$result = $this->dbc->query($sql);

		// If query failed
		if( !$result || $result->num_rows == 0 ) {
			// Redirect user to 404 page
			header('Location: index.php?page=error404');
		} else {
			// Yay! 
			$this->data['review'] = $result->fetch_assoc();
		}

	}

	
}