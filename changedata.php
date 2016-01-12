<?php
	require_once("functions.php");
	require_once("carmanager.php");
	
	if(!isset($_SESSION["logged_in_user_id"])){
		header("Location: login.php");
		
		// see  katkestab faili edasise lugemise
		exit();
	}
	
	if(isset($_GET["logout"])){
		
		session_destroy();
		
		header("Location: login.php");
	}
	$CarManager= new CarManager($mysqli, $_SESSION["logged_in_user_id"] );
	if(isset($_GET["new_carnumber"])){
		
		$add_new_response=$CarManager->addCar($_GET["new_Car"]);
		
	}
	
?>