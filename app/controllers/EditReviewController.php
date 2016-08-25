<?php 

use Intervention\Image\ImageManager;

class EditReviewController extends PageController {

	// Properties (attributes)

	// Constructor
	public function __construct($dbc) {

		parent::__construct();

		// Save this database connection for later
		$this->dbc = $dbc;
		
		$this->mustBeLoggedIn();

		// Did the user submit the edit form?
		if( isset($_POST['edit-review']) ) {
			$this->processEditedReview();
		}
		// Get info about the review
		$this->getReviewInfo();

		$this->getImageInfo();

	}

	// Methods (functions)


	public function buildHTML() {

		echo $this->plates->render('edit-review', $this->data);
		
	}

	private function getReviewInfo() {

		// Get the Review ID from the Get array
		$reviewID = $this->dbc->real_escape_string($_GET['id']);

		// Get the user ID
		$userID = $_SESSION['id'];

		// Prepare the query
		$sql = "SELECT title, review_about, location, description
				FROM review
				WHERE id = $reviewID
				AND user_id = $userID";

		// Run the query
		$result = $this->dbc->query($sql);

		// If the query failed
		if( !$result || $result->num_rows == 0 ) {
			// Send the user back to the post page
			header("Location: index.php?page=review-individual&reviewid=$reviewID");
		} else {
			$this->data['review'] = $result->fetch_assoc();
		}


	}

	private function getImageInfo() {


		// Get the Review ID from the Get array
		$reviewID = $this->dbc->real_escape_string($_GET['id']);

		// Get the user ID
		$userID = $_SESSION['id'];

		// Get info about image
		$sql = "SELECT image, review_id
				FROM image
				WHERE review_id = $reviewID ";

		$result = $this->dbc->query($sql);

		// If the query failed
		if( !$result || $result->num_rows == 0 ) {
			header("Location: index.php?page=review-individual&reviewid=$reviewID");
		} else {
			$this->data['reviewImages'] = $result->fetch_all(MYSQLI_ASSOC);
		}

	}

	private function processEditedReview() {

		// Count errors
		$totalErrors = 0;

		$title = trim($_POST['title']);
		$desc = trim($_POST['description']);
		$location = trim($_POST['location']);

		

		// Title
		if( strlen($title) == 0 ) {

			$this->data['titleError'] = 'Title is required';
			$totalErrors++;

		} elseif( strlen($title) > 100 ) {

			$this->data['titleError'] = 'Title cannot be more than 100 characters';
			$totalErrors++;

		}

		// Location
		if( strlen($location) == 0 ) {

			$this->data['locationError'] = 'Store location is required';
			$totalErrors++;

		} elseif( strlen($location) > 20 ) {

			$this->data['locationError'] = 'Store location cannot be more than 20 characters';
			$totalErrors++;

		}

		// Description
		if( strlen($desc) == 0 ) {

			$this->data['textError'] = 'Review is required';
			$totalErrors++;

		} elseif( strlen($desc) > 1000 ) {

			$this->data['textError'] = 'Review cannot be more than 1000 characters';
			$totalErrors++;

		}


		// Make sure the user has provided an image
		if( $_FILES['image']['name'] != '' ) {
			foreach ($_FILES['image']['error'] as $singleImageError) {

				// Make sure the user has provided an image
				if( in_array( $singleImageError, [1,3] ) ) {
					// Show error message
					$this->data['imageError'] = 'This image is failed to upload';
					$totalErrors++;

				}

			}
		}

		if( $totalErrors == 0 ) {

			$reviewID = $this->dbc->real_escape_string($_GET['id']);

			// Delete the old images
			$sql = "SELECT image, review_id 
					FROM image
					WHERE review_id = $reviewID ";

			// Run the query
			$result = $this->dbc->query($sql);
							
			// Extract the data
			$result = $result->fetch_assoc();

			// Get the image name
			$imageName = $result['image'];

			

			// If the user uploaded an image
			if( $_FILES['image']['name'] != '' ) {

				// Instance of Intervention Image
				$manager = new ImageManager();
				
				foreach ($_FILES['image']['tmp_name'] as $singleImage) {

					// Get the file that was just uploaded
					$image = $manager->make( $singleImage ); 

					// Get file extension
					$fileExtension = $this->getFileExtension( $image->mime() );

					// Make file name
					$fileName = uniqid();

					$image->save("img/uploads/review/original/$fileName$fileExtension");

					$image->resize(400, 400);

					$image->save("img/uploads/review/individual/$fileName$fileExtension");

					$image->resize(210, 210);

					$image->save("img/uploads/review/stream/$fileName$fileExtension");

					unlink("img/uploads/review/original/$imageName");
					unlink("img/uploads/review/stream/$imageName");
					unlink("img/uploads/review/individual/$imageName");

					$imageName = $fileName.$fileExtension;

					
				}


			}

			// Filter the data
			$filteredTitle = $this->dbc->real_escape_string($title);
			$reviewAbout = $_POST['review-about'];
			$filteredLoc = $this->dbc->real_escape_string($location);
			$filteredDesc = $this->dbc->real_escape_string($desc); 

			$userID = $_SESSION['id'];

			// Prepare the SQL
			$sql = "UPDATE review 
					SET title = '$filteredTitle',
						review_about = '$reviewAbout',
						location = '$filteredLoc',
						description = '$filteredDesc' 
					WHERE id = $reviewID ";

			$this->dbc->query($sql);

			


			

			

		

			// Validation
			if( $this->dbc->affected_rows == 0 ) {
				$this->data['reviewError'] = 'Sorry, nothing changed';
			} else {

				// Redirect the user to the post page
				header("Location: index.php?page=review-individual&reviewid=$reviewID");

			}

			

		}

	}

	private function getFileExtension( $mimeType ) {

			switch($mimeType) {

				case 'image/png':
					return '.png';
				break;

				case 'image/gif':
					return '.gif';
				break;

				case 'image/jpeg':
					return '.jpg';
				break;

				case 'image/bmp':
					return '.bmp';
				break;

				case 'image/tiff':
					return '.tif';
				break;
			}
	}


	
}






