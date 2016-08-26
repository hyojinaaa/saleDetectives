<?php 

class ReviewIndividualController extends PageController {

	// Properties (attributes)

	// Constructor
	public function __construct($dbc) {

		parent::__construct();

		// Save this database connection for later
		$this->dbc = $dbc;

		// Does user want to delete this post?
		if( isset($_GET['delete-comment']) ) {
			$this->deleteComment();
		}


		// Does user want to delete this post?
		if( isset($_GET['delete']) ) {
			$this->deleteReview();
		}

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
		$sql = "SELECT title, review_about, location, description, created_at, user_id, username, image1, image2
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
		$sql = "SELECT comment.id, comment, created_at, username, user_id
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

	private function deleteReview() {

		// If user is not logged in 
		if( !isset($_SESSION['id']) ) {
			return;
		}

		// Make sure the user owns this post
		$reviewID = $this->dbc->real_escape_string($_GET['reviewid']);
		$userID = $_SESSION['id'];
		$privilege = $_SESSION['privilege'];

		// Delete the image first
		$sql = "SELECT image1
				FROM review
				WHERE id = $reviewID";

				// If the user is not an admin
				if( $privilege != 'admin' ) {
				$sql .= " AND user_id = $userID";
				}

		// Run the query
		$result = $this->dbc->query($sql);

		// If the query failed, either post doesn't exist, or you don't own the post
		if( !$result || $result->num_rows == 0 ) {
			return;
		}

		$result = $result->fetch_assoc();

		$fileName1 = $result['image1'];

		// Delete the image first
		$sql = "SELECT image2
				FROM review
				WHERE id = $reviewID";

				// If the user is not an admin
				if( $privilege != 'admin' ) {
				$sql .= " AND user_id = $userID";
				}

		// Run the query
		$result = $this->dbc->query($sql);

		// If the query failed, either post doesn't exist, or you don't own the post
		if( !$result || $result->num_rows == 0 ) {
			return;
		}

		$result = $result->fetch_assoc();

		$fileName2 = $result['image2'];

		unlink("image/unloads/review/original/$filename1");
		unlink("image/unloads/review/original/$filename2");
		unlink("image/unloads/review/stream/$filename1");
		unlink("image/unloads/review/stream/$filename2");
		unlink("image/unloads/review/individual/$filename1");
		unlink("image/unloads/review/individual/$filename2");
		

		// Prepare the SQL
		$sql = "DELETE FROM review
				WHERE id = $reviewID";

		// Run the query
		$this->dbc->query($sql);

		header('Location: index.php?page=review');
		die();
	}

	private function deleteComment() {

		// If user is not logged in 
		if( !isset($_SESSION['id']) ) {
			return;
		}

		// Make sure the user owns this post
		$reviewID = $this->dbc->real_escape_string($_GET['reviewid']);
		$userID = $_SESSION['id'];
		$privilege = $_SESSION['privilege'];

		// Delete the image first

		// Prepare the SQL
		$sql = "DELETE FROM comment
				WHERE review_id = $reviewID";


		// If the user is not an admin, they must own the post
		if( $privilege != 'admin' ) {
			$sql .= " AND user_id = $userID";
		}

		// Run the query
		$this->dbc->query($sql);

	}

	
}




