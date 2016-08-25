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

		// Make sure the user has provied an image
		if( in_array( $_FILES['image1']['error'], [1,3,4] ) ) {
				// Show error message
				$this->data['imageMessage'] = 'Image failed to upload';
				$totalErrors++;
			} elseif( !in_array( $_FILES['image1']['type'], $this->acceptableImageTypes ) ) {
				$this->data['imageMessage'] = 'Must be an image (jpg, gif, png, tif etc)';
				$totalErrors++;
			}

		// Make sure the user has provied an image
		if( in_array( $_FILES['image2']['error'], [1,3,4] ) ) {
				// Show error message
				$this->data['imageMessage'] = 'Image failed to upload';
				$totalErrors++;
			} elseif( !in_array( $_FILES['image2']['type'], $this->acceptableImageTypes ) ) {
				$this->data['imageMessage'] = 'Must be an image (jpg, gif, png, tif etc)';
				$totalErrors++;
			}


		

		// If there are no errors
		if( $totalErrors == 0 ) {

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


			// Filter the data
			$filteredTitle = $this->dbc->real_escape_string($title);
			$reviewAbout = $_POST['review-about'];
			$filteredLoc = $this->dbc->real_escape_string($location);
			$filteredDesc = $this->dbc->real_escape_string($desc); 

			// Get the ID of logged in user
			$userID = $_SESSION['id'];

			// SQL (INSERT)
			$sql = "INSERT INTO review (title, review_about, location, description, user_id, image1, image2)
					VALUES ('$filteredTitle', '$reviewAbout', '$filteredLoc', '$filteredDesc', $userID, '$fileName1$fileExtension1', '$fileName2$fileExtension2') ";

			$this->dbc->query($sql);
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















