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
		echo $plates->render('sale-calendar');
	break;

	case 'sale-calendar-individual':
		echo $plates->render('sale-calendar-individual');
	break;

	case 'sale-calendar-post':
		echo $plates->render('sale-calendar-post');
	break;

	case 'review':
		echo $plates->render('review');
	break;

	case 'review-individual':
		echo $plates->render('review-individual');
	break;

	case 'review-post':
		echo $plates->render('review-post');
	break;

	case 'my-account':
		echo $plates->render('my-account');
	break;

	case 'login':
		require 'app/controllers/LoginController.php';
		$controller = new LoginController($dbc);
	break;

	default:
		echo $plates->render('error404');
	break;

}

$controller->buildHTML();
