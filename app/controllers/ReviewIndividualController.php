<?php 

class ReviewIndividualController extends PageController {

	// Properties (attributes)

	// Constructor
	public function __construct($dbc) {

		parent::__construct();

		// Save this database connection for later
		$this->dbc = $dbc;

		// Did the user add a comment?
		if( isset($_POST['new-comment']) ) {
		
			$this->processNewComment();
		}

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
		$sql = "SELECT title, review_about, location, description, image, created_at, user_id, username
				FROM review
				JOIN user
				ON user_id = user.id
				WHERE review.id = $reviewID";

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

		// Get all the comments!
		$sql = "SELECT comment, created_at, username
				FROM comment
				JOIN user
				ON comment.user_id = user.id
				WHERE review_id = $reviewID
				ORDER BY created_at DESC ";

		$result = $this->dbc->query($sql);

		// Extract the data as an associate array
		$this->data['allComments'] = $result->fetch_all(MYSQLI_ASSOC); 

	}

	private function processNewComment() {

		// Validate the comment
		$totalErrors = 0;

		$comment = trim($_POST['comment']);

		if( strlen($comment) == 0 ) {

			$this->data['commentMessage'] = 'Comment is required';
			$totalErrors++;

		} elseif( strlen($comment) > 1000 ) {

			$this->data['commentMessage'] = 'Comment cannot be more than 1000 characters';
			$totalErrors++;

		}

		if( $totalErrors == 0 ) {

			$filteredComment = $this->dbc->real_escape_string( $_POST['comment'] );
			$userID = $_SESSION['id'];
			$reviewID = $this->dbc->real_escape_string( $_GET['reviewid'] );

			// prepare SQL
			$sql = "INSERT INTO comment (comment, user_id, review_id)
					VALUES ('$filteredComment', $userID, $reviewID) ";

			// Run the SQL
			$this->dbc->query($sql);

		}


	}

	
}