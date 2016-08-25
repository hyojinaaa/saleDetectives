<?php 

use Intervention\Image\ImageManager;

class EditReviewController extends PageController {

	// Properties (attributes)
	private $acceptableImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/tiff'];

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
		$sql = "SELECT title, review_about, location, description, image1, image2
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
		if( $_FILES['image1']['name'] != '' ) {
			
			if( in_array( $_FILES['image1']['error'], [1,3] ) ) {
				// Show error message
				$this->data['imageError'] = 'Image failed to upload';
				$totalErrors++;
			} elseif( !in_array( $_FILES['image1']['type'], $this->acceptableImageTypes ) ) {
				$this->data['imageError'] = 'Must be an image (jpg, gif, png, tif etc)';
				$totalErrors++;
			}
		}

		if( $_FILES['image2']['name'] != '' ) {
			
			if( in_array( $_FILES['image2']['error'], [1,3] ) ) {
				// Show error message
				$this->data['imageError'] = 'Image failed to upload';
				$totalErrors++;
			} elseif( !in_array( $_FILES['image2']['type'], $this->acceptableImageTypes ) ) {
				$this->data['imageError'] = 'Must be an image (jpg, gif, png, tif etc)';
				$totalErrors++;
			}
		}
		

		if( $totalErrors == 0 ) {

			$reviewID = $this->dbc->real_escape_string($_GET['id']);

			// Delete the old images
			$sql = "SELECT image1, image2 
					FROM review
					WHERE id = $reviewID ";

			// Run the query
			$result = $this->dbc->query($sql);
							
			// Extract the data
			$result = $result->fetch_assoc();

			// Get the image name
			$imageName1 = $result['image1'];

			

			// If the user uploaded an image
			if( $_FILES['image1']['name'] != '' ) {

				// Instance of Intervention Image
				$manager = new ImageManager();
				
				// Get the file that was just uploaded
				$image1 = $manager->make( $_FILES['image1']['tmp_name'] ); 

				// Get file extension
				$fileExtension1 = $this->getFileExtension( $image1->mime() );

				// Make file name
				$fileName1 = uniqid();

				$image1->save("img/uploads/review/original/$fileName1$fileExtension1");

				$image1->resize(400, 400);

				$image1->save("img/uploads/review/individual/$fileName1$fileExtension1");

				$image1->resize(210, 210);

				$image1->save("img/uploads/review/stream/$fileName1$fileExtension1");

				unlink("img/uploads/review/original/$imageName1");
				unlink("img/uploads/review/stream/$imageName1");
				unlink("img/uploads/review/individual/$imageName1");

				$imageName1 = $fileName1.$fileExtension1;

					
			}

			$imageName2 = $result['image2'];

			// If the user uploaded an image
			if( $_FILES['image2']['name'] != '' ) {

				// Instance of Intervention Image
				$manager = new ImageManager();
				
				// Get the file that was just uploaded
				$image2 = $manager->make( $_FILES['image2']['tmp_name'] ); 

				// Get file extension
				$fileExtension2 = $this->getFileExtension( $image2->mime() );

				// Make file name
				$fileName2 = uniqid();

				$image2->save("img/uploads/review/original/$fileName2$fileExtension2");

				$image2->resize(400, 400);

				$image2->save("img/uploads/review/individual/$fileName2$fileExtension2");

				$image2->resize(210, 210);

				$image2->save("img/uploads/review/stream/$fileName2$fileExtension2");

				unlink("img/uploads/review/original/$imageName2");
				unlink("img/uploads/review/stream/$imageName2");
				unlink("img/uploads/review/individual/$imageName2");

				$imageName2 = $fileName2.$fileExtension2;

					
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
						description = '$filteredDesc', 
						image1 = '$imageName1',
						image2 = '$imageName2'
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






