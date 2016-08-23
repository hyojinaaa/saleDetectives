<?php 

class EditCommentController extends PageController {

	// Properties (attributes)

	// Constructor
	public function __construct($dbc) {

		parent::__construct();

		// Save this database connection for later
		$this->dbc = $dbc;
		
		$this->mustBeLoggedIn();

		$this->mustOwnComment();

		// Did the user submit the form?
		if( isset($_POST['edit-comment']) ) {
			$this->processEdittingComment();
		}
	}

	// Methods (functions)


	public function buildHTML() {

		echo $this->plates->render('edit-comment', $this->data);

	}

	private function mustOwnComment() {

		// Get the logged in user iD
		$userID = $_SESSION['id'];

		// Get the comment ID
		$commentID = $this->dbc->real_escape_string($_GET['id']);

		// Get the comment details
		$sql = "SELECT comment, review_id
				FROM comment
				WHERE id = $commentID
				AND user_id = $userID";

		// Run the query and capture the result
		$result = $this->dbc->query( $sql );

		// If there isn't a result
		if( !$result || $result->num_rows == 0 ) {
			// Redirect the user
			header('Location: index.php?page=review-individual&reviewid='.$this->data['review_id']);
		} else {
			$theComment = $result->fetch_assoc();

			$this->data['comment'] = $theComment['comment'];
			$this->data['review_id'] = $theComment['review_id'];
		}
	}

	private function processEdittingComment() {

		$totalErrors = 0;

		// Check the length
		if( strlen($_POST['comment']) > 500 ) {
			$this->data['commentError'] = "Comment can't be more than 500 characters";
			$totalErrors++;
		}

		// If all is good, update the database
		if( $totalErrors == 0 ) {

			// Get the comment ID
			$commentID = $_GET['id'];

			$comment = $this->dbc->real_escape_string($_POST['comment']);

			// Prepare SQL
			$sql = "UPDATE comment
					SET comment = '$comment'
					WHERE id = $commentID";

			$this->dbc->query($sql);

			// Redirect user back to the review that has their comment
			header('Location: index.php?page=review-individual&reviewid='.$this->data['review_id']);
		}
	}

	
}






