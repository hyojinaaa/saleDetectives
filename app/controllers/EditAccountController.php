<?php 

use Intervention\Image\ImageManager;

class EditAccountController extends PageController {

	// Properties (attributes)
	private $acceptableImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/tiff'];

	// Constructor
	public function __construct($dbc) {

		parent::__construct();

		// Save this database connection for later
		$this->dbc = $dbc;
		
		$this->mustBeLoggedIn();

		// Did the user submit the edit form?
		if( isset($_POST['update-account']) ) {
			$this->processEditedAccount();
		}

		//Get info about the review
		$this->getAccountInfo();


	}

	// Methods (functions)


	public function buildHTML() {

		echo $this->plates->render('edit-account', $this->data);
		
	}

	private function getAccountInfo() {

		// Get the user ID
		$userID = $_SESSION['id'];

		// Prepare the query
		$sql = "SELECT id, email, username, image
				FROM user
				WHERE id = $userID ";

		// Run the query
		$result = $this->dbc->query($sql);

		// If the query failed
		if( !$result || $result->num_rows == 0 ) {
			// Send the user back to the post page
			header("Location: index.php?page=landing");
		} else {
			$this->data['myAccount'] = $result->fetch_assoc();
		}


	}


	private function processEditedAccount() {

		// Count errors
		$totalErrors = 0;

		$username = trim($_POST['username']);


		// Make sure the user has provied an image
		if( $_FILES['image']['name'] != '' ) {
			
			if( in_array( $_FILES['image']['error'], [1,3] ) ) {
				// Show error message
				$this->data['imageError'] = 'Image failed to upload';
				$totalErrors++;
			} elseif( !in_array( $_FILES['image']['type'], $this->acceptableImageTypes ) ) {
				$this->data['imageError'] = 'Must be an image (jpg, gif, png, tif etc)';
				$totalErrors++;
			}
		}
		

		if( $totalErrors == 0 ) {

			$userID = $this->dbc->real_escape_string($_GET['id']);

			// Delete the old images
			$sql = "SELECT image
					FROM user
					WHERE id = $userID ";

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
				
				// Get the file that was just uploaded
				$image = $manager->make( $_FILES['image']['tmp_name'] ); 

				// Get file extension
				$fileExtension = $this->getFileExtension( $image->mime() );

				// Make file name
				$fileName = uniqid();

				$image->save("img/uploads/account/original/$fileName$fileExtension");

				$image->resize(200, 200);

				$image->save("img/uploads/account/view/$fileName$fileExtension");

				$image->resize(100, 100);

				$image->save("img/uploads/account/comment/$fileName$fileExtension");

				unlink("img/uploads/account/original/$imageName");
				unlink("img/uploads/account/view/$imageName");
				unlink("img/uploads/account/comment/$imageName");

				$imageName = $fileName.$fileExtension;

					
			}

			$filteredUsername = $this->dbc->real_escape_string($username);
			$userID = $_SESSION['id'];

			// Prepare the SQL
			$sql = "UPDATE user
					SET username = '$filteredUsername',
						image = '$imageName'
					WHERE id = $userID ";
					
				

			$this->dbc->query($sql);

			


			

			

		

			// Validation
			if( $this->dbc->affected_rows == 0 ) {
				$this->data['reviewError'] = 'Sorry, nothing changed';
			} else {

				// Redirect the user to the post page
				header("Location: index.php?page=my-account");

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






