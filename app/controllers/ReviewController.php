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

		$allImages = $this->getImages();

		$this->data['allImages'] = $allImages;

		echo $this->plates->render('review', $this->data);

	}

	private function getLatestReviews() {

		// Prepare some SQL
		$sql = "SELECT review.id, title, review_about, location, description, created_at, user_id, username
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

	}

	private function getImages() {

		$sql = "SELECT image.id, image, review_id
				FROM image
				JOIN review
				ON review_id = review.id";

		$result = $this->dbc->query($sql);

		$allImages = $result->fetch_all(MYSQLI_ASSOC);

		return $allImages;
	}

	
}
