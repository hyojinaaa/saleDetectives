<?php 

use Intervention\Image\ImageManager;

class ReviewPostController extends PageController {

	// Properties (attributes)
	private $acceptableImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/tiff'];

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

		foreach ($_FILES['image']['error'] as $singleImageError) {

			// Make sure the user has provided an image
			if( in_array( $singleImageError, [1,3,4] ) ) {
				// Show error message
				$this->data['imageMessage'] = 'This image is failed to upload';
				$totalErrors++;

			}
			// } elseif( !in_array( $_FILES['image']['type'], $this->acceptableImageTypes ) ) {
			// 	$this->data['imageMessage'] = 'Image file must be an image (jpg, gif, png, tif etc)';
			// 	$totalErrors++;
			// }

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

			$reviewID = $this->dbc->insert_id;

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

				// Insert data
				$sql = "INSERT INTO image(image, review_id)
						VALUES ('$fileName$fileExtension', $reviewID) ";

				$this->dbc->query($sql);

			}


			header('Location: index.php?page=review');



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















