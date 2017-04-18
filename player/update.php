<!-- This .php is responsible for updating a player -->

<?php
	// Resuming the session with the username and privilege setted on login page
	session_start();
	if(!isset($_SESSION["userName"]) || $_SESSION["privilege"] != 1)
	{
		// Since there is no username on session or the privilege does not match, it'll redirect to the index.php
		header("location:../index.php");
	}
?>
<!DOCTYPE HTML>
<html>
   <head>
      <title>FootBall Team Site - Edit</title>
      <!-- Bootstrap -->
      <link rel="stylesheet" href="../libs/football.css" />
   </head>
   <body>
      <div class="container">
         <div class="page-header">
         	<img src="../images/teamlogo2.jpg" class="img-responsive pull-right" alt="Responsive image">
            <h1>Edit Player</h1>
         </div>
         <?php
         	// This part of the code is used to find the player and start the page with his existing values.
         
         	// The function isset verifies if a value exists or not. If exists, returns the id
            // else, error since this page was redirected by read.php
            $playerID=isset($_GET['playerID']) ? $_GET['playerID'] : die('ERROR: Player not found.');
             
            // DB connection
            include '../config/database.php';
             
            // Selecting the player with his id
            try {
            	
                // Query that select all fields of a player given a playerID
                $query = "SELECT playerID, squadNumber, playerName, playerPosition, playerAge FROM player WHERE playerID = ? LIMIT 0,1";
                // Preparing the query
                $stmt = $con->prepare( $query );
                 
                // Binding the value to the query
                $stmt->bindParam(1, $playerID);
                 
                // Executing the query
                $stmt->execute();
                 
                // Fetching the results
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                 
                // Assigning the values found on the database to variables
                $squadNumber= $row['squadNumber'];
                $playerName= $row['playerName'];
                $playerPosition= $row['playerPosition'];
                $playerAge= $row['playerAge'];
            }
             
            catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());
            }
            ?>
         <?php
         	// This part of the code is used to update the player, saving changes on the database
         
	        // The function isset verifies if a value exists or not. If exists, returns the id
	        // else, error since this page was redirected by read.php
            $playerID=isset($_GET['playerID']) ? $_GET['playerID'] : die('ERROR: Player not found.');
             
            // DB connection
            include '../config/database.php';
             
            // Check if form was submitted
            if($_POST){
                 
                try{
                	
                	//Query to update the player. This one is not using question marks, instead it's using labels to make it more readable
                    $query = "UPDATE player 
                                SET squadNumber=:squadNumber, playerName=:playerName, playerPosition=:playerPosition, playerAge=:playerAge
                                WHERE playerID=:playerID";
             
                    // Preparing the query
                    $stmt = $con->prepare($query);
             
                    // Getting the values from the form
                    $squadNumber=htmlspecialchars(strip_tags($_POST['squadNumber']));
                    $playerName=htmlspecialchars(strip_tags($_POST['playerName']));
                    $playerPosition=htmlspecialchars(strip_tags($_POST['playerPosition']));
                    $playerAge=htmlspecialchars(strip_tags($_POST['playerAge']));
             
                    // Binding the values to the query
                    $stmt->bindParam(':squadNumber', $squadNumber);
                    $stmt->bindParam(':playerName', $playerName);
                    $stmt->bindParam(':playerPosition', $playerPosition);
                    $stmt->bindParam(':playerAge', $playerAge);
                    $stmt->bindParam(':playerID', $playerID);
                     
                    // Executing the query
                    if($stmt->execute()){
                        echo "<div class='alert alert-success'>Player was updated.</div>";
                    }else{
                        echo "<div class='alert alert-danger'>Unable to update player. Please try again.</div>";
                    }
                }
                 
                catch(PDOException $exception){
                    die('ERROR: ' . $exception->getMessage());
                }
            }
            ?>
         <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?playerID={$playerID}");?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
               <tr>
                  <td>Squad Number</td>
                  <td><input type='text' name='squadNumber' value="<?php echo htmlspecialchars($squadNumber, ENT_QUOTES);  ?>" class='form-control' /></td>
               </tr>
               <tr>
                  <td>Player Name</td>
                  <td><input type='text' name='playerName' value="<?php echo htmlspecialchars($playerName, ENT_QUOTES);  ?>" class='form-control' /></td>
               </tr>
               <tr>
                  <td>Player Position</td>
                  <td><input type='text' name='playerPosition' value="<?php echo htmlspecialchars($playerPosition, ENT_QUOTES);  ?>" class='form-control' /></td>
               </tr>
               <tr>
                  <td>Player Age</td>
                  <td><input type='text' name='playerAge' value="<?php echo htmlspecialchars($playerAge, ENT_QUOTES);  ?>" class='form-control' /></td>
               </tr>
               <tr>
                  <td></td>
                  <td>
                     <input type='submit' value='Save Changes' class='btn btn-primary' />
                     <a href='read.php' class='btn btn-danger'>Back to players list</a>
                  </td>
               </tr>
            </table>
         </form>
      </div>
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="../libs/jquery-3.2.0.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="../libs/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
   </body>
</html>