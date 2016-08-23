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

		$this->data['allImages'] = $allImages;

		echo $this->plates->render('review', $this->data);

	}

	private function getLatestReviews() {

		// Prepare some SQL
		$sql = "SELECT *
				FROM review
				JOIN user
				ON user_id = user.id
				ORDER BY created_at DESC";

		// Run the SQL and capture the result
		$result = $this->dbc->query($sql);

		// Extract the result as an array
		$allReviews = $result->fetch_all(MYSQLI_ASSOC);

		// Return the results to the code that called this function
		return $allReviews;

		// Get images
		$sql = "SELECT id, image, review_id
				FROM image";

		$result = $this->dbc->query($sql);

		$allImages = $result->fetch_all(MYSQLI_ASSOC);

		return $allImages;

	}

	
}
