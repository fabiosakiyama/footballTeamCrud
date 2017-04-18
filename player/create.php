<!-- This .php is responsible for having the add player form and it's logic -->

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
      <title>FootBall Team Site - Add</title>
      <!-- Bootstrap -->
      <link rel="stylesheet" href="../libs/football.css" />
   </head>
   <body>
      <div class="container">
         <div class="page-header">
         	<img src="../images/teamlogo2.jpg" class="img-responsive pull-right" alt="Responsive image">
            <h1>Add Player</h1>
         </div>
         <?php
            if($_POST){
             
                // DB connection
                include '../config/database.php';
             
                try{
                 
                    // The query that will add a player
                    $query = "INSERT INTO player SET squadNumber=:squadNumber, playerName=:playerName, playerPosition=:playerPosition, playerAge=:playerAge";
             
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
                     
                    // Executing the query
                    if($stmt->execute()){
                        echo "<div class='alert alert-success'>Player was added.</div>";
                    }else{
                    	echo $stmt->errorCode();
                        echo "<div class='alert alert-danger'>Unable to add player.</div>";
                    }
                }
                catch(PDOException $exception){
                    die('ERROR: ' . $exception->getMessage());
                }
            }
            ?> 
          
         <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <table class='table table-hover table-responsive table-bordered'>
               <tr>
                  <td>Squad Number</td>
                  <td><input type='text' name='squadNumber' class='form-control' /></td>
               </tr>
               <tr>
                  <td>Player Name</td>
                  <td><input type='text' name='playerName' class='form-control' /></td>
               </tr>
               <tr>
                  <td>Player Position</td>
                  <td><input type='text' name='playerPosition' class='form-control' /></td>
               </tr>
               <tr>
                  <td>Player Age</td>
                  <td><input type='text' name='playerAge' class='form-control' /></td>
               </tr>
               <tr>
                  <td></td>
                  <td>
                     <input type='submit' value='Save' class='btn btn-primary' />
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