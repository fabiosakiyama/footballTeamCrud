<!-- This .php is responsible for deleting a player -->

<?php
	// Resuming the session with the username and privilege setted on login page
	session_start();
	if(!isset($_SESSION["userName"]) || $_SESSION["privilege"] != 1)
	{
		// Since there is no username on session or the privilege does not match, it'll redirect to the index.php
		header("location:../index.php");
	}
	
	// DB connection
	include '../config/database.php';
	
	try {
		
		
		// The function isset verifies if a value exists or not. If exists, returns the id
		// else, error since this page was redirected by read.php
		$playerID=isset($_GET['playerID']) ? $_GET['playerID'] : die('ERROR: Player not found.');
		
		// The query to delete
		$query = "DELETE FROM player WHERE playerID = ?";
		// Preparing the query
		$stmt = $con->prepare($query);
		// Binding the values to the query
		$stmt->bindParam(1, $playerID);
		
		// Executing the query
		if($stmt->execute()){
			
			// Redirecting to the read.php passing the action, so the read.php can alert the user
			header('Location: read.php?action=deleted');
		}else{
			die('Unable to delete player.');
		}
	}
	catch(PDOException $exception){
		die('ERROR: ' . $exception->getMessage());
	}
?>