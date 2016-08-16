<?php 

class ReviewController extends PageController {

	// Properties (attributes)

	// Constructor
	public function __construct($dbc) {

		parent::__construct();

		// Save this database connection for later
		$this->dbc = $dbc;
	}

	// Methods (functions)


	public function buildHTML() {

		// Get latest reviews
		$allReviews = $this->getLatestReviews();

		$this->data['allReviews'] = $allReviews;

		echo $this->plates->render('review', $this->data);

	}

	private function getLatestReviews() {

		// Prepare some SQL
		$sql = "SELECT *
				FROM review";

		// Run the SQL and capture the result
		$result = $this->dbc->query($sql);

		// Extract the result as an array
		$allReviews = $result->fetch_all(MYSQLI_ASSOC);

		// Return the results to the code that called this function
		return $allReviews;
	}

	
}
