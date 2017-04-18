<!-- This .php is responsible for getting the connection from the database -->
<?php

// Parameters of the database
$host = "localhost";
$db_name = "football";
$username = "root";
$password = "";
$port = "3307";

try {
	$con = new PDO("mysql:host={$host};port={$port};dbname={$db_name}", $username, $password);
}
catch(PDOException $exception){
	echo "Connection error: " . $exception->getMessage();
	die();
}
?>