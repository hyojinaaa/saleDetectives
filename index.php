<?php 
session_start();

// Make everything in the vendor folder available to use 
require 'vendor/autoload.php';
require 'app/controllers/PageController.php';

// Load approrpirate page
$page = isset($_GET['page']) ? $_GET['page'] : 'landing';

// Connect to the database
$dbc = new mysqli('localhost', 'root', '', 'saleDetectives');

// Load the appropriate file based on page
switch($page) {

	case 'landing':
		require 'app/controllers/LandingController.php';
		$controller = new LandingController($dbc);
	break;

	case 'sale-calendar':
		require 'app/controllers/SaleCalendarController.php';
		$controller = new SaleCalendarController($dbc);
	break;

	case 'sale-calendar-individual':
		require 'app/controllers/SaleIndividualController.php';
		$controller = new SaleIndividualController($dbc);
	break;

	case 'sale-calendar-post':
		require 'app/controllers/SalePostController.php';
		$controller = new SalePostController($dbc);
	break;

	case 'review':
		require 'app/controllers/ReviewController.php';
		$controller = new ReviewController($dbc);
	break;

	case 'review-individual':
		require 'app/controllers/ReviewIndividualController.php';
		$controller = new ReviewIndividualController($dbc);
	break;

	case 'review-post':
		require 'app/controllers/ReviewPostController.php';
		$controller = new ReviewPostController($dbc);
	break;

	case 'my-account':
		require 'app/controllers/MyAccountController.php';
		$controller = new MyAccountController($dbc);
	break;

	case 'edit-comment':
		require 'app/controllers/EditCommentController.php';
		$controller = new EditCommentController($dbc);
	break;

	case 'login':
		require 'app/controllers/LoginController.php';
		$controller = new LoginController($dbc);
	break;

	case 'signup':
		require 'app/controllers/SignUpController.php';
		$controller = new SignUpController($dbc);
	break;

	case 'signup-success':
		require 'app/controllers/SignUpSuccessController.php';
		$controller = new SignUpSuccessController($dbc);
	break;

	case 'logout':
		require 'app/controllers/LogoutController.php';
		$controller = new LogoutController($dbc);
	break;

	default:
		require 'app/controllers/Error404Controller.php';
		$controller = new Error404Controller();
	break;

}

$controller->buildHTML();
