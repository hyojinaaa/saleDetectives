<?php 

// Make everything in the vendor folder available to use 
require 'vendor/autoload.php';
// require 'app/controllers/PageController.php';

// Instantiate (create instance of) Plates library
		$plates = new League\Plates\Engine('app/templates');

		echo $plates->render('myAccount');