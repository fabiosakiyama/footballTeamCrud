<!-- This .php is responsible for listing all players and restricting access for delete/add/update operations -->

<?php
	// Resuming the session with the username setted on login page
	session_start();
	if(!isset($_SESSION["userName"]))
	{
		// Since there is no username on session, it'll redirect to the index.php
		header("location:../index.php");
	}
?>
<!DOCTYPE HTML>
<html>
   <head>
      <title>FootBall Team Site - List</title>
      <!-- Bootstrap -->
      <link rel="stylesheet" href="../libs/football.css" />
   </head>
   <body>
      <div class="container">
         <div class="page-header">
            <img src="../images/teamlogo2.jpg" class="img-responsive pull-right" alt="Responsive image">
            <h1>FootBall Players</h1>
         </div>
         <?php
         
        	// DB connection
            include '../config/database.php';
            
            // Verifies is there's an action redirected by delete page
            $action = isset($_GET['action']) ? $_GET['action'] : "";
            
            // And if it was, alerts the user that the player was deleted.
            if($action=='deleted'){
            	echo "<div class='alert alert-success'>Player was deleted.</div>";
            }
             
            // The query to select all players
            $query = "SELECT playerID, squadNumber, playerName, playerPosition, playerAge FROM player ORDER BY playerName ASC";
            // Preparing the query
            $stmt = $con->prepare($query);
            // Executing the query
            $stmt->execute();
            
            // Will create the add button only if the user is an admin
            if($_SESSION["privilege"] == 1){
            	echo "<a href='create.php' class='btn btn-primary'>Add Player</a>";
            }
             
            // Checks if there's a result on the query
            $num = $stmt->rowCount();
            if($num>0){
             
                echo "<table class='table table-hover table-responsive table-bordered'>";//start table
                 
                    // Generating the table
                    echo "<tr>";
                        echo "<th>Squad Number</th>";
                        echo "<th>Player Name</th>";
                        echo "<th>Player Position</th>";
                        echo "<th>Player Age</th>";
                    echo "</tr>";
                     
                    // Fetching the results
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    	
                        // This makes $row['squadNumber'] = $squadNumber
                        extract($row);
                        
                        // So, for each line found, will create the td's below
                        echo "<tr>";
                            echo "<td>{$squadNumber}</td>";
                            echo "<td>{$playerName}</td>";
                            echo "<td>{$playerPosition}</td>";
                            echo "<td>{$playerAge}</td>";
                         	    // Will create the update/delete button only if the user is an admin
                                if($_SESSION["privilege"] == 1){
                                	echo "<td>";
            	                    	echo "<a href='update.php?playerID={$playerID}' class='btn btn-primary'>Edit</a>";
            	                    	echo "<a href='#' onclick='delete_user({$playerID});'  class='btn btn-danger'>Delete</a>";
                                	echo "</td>";
                                }
                        echo "</tr>";
                    }
                 
                echo "</table>";
            }
             
            // Nothing found
            else{
                echo "<div class='alert alert-danger'>No records found.</div>";
            }
            
            // Logout button
            echo '<br /><br /><a href="../logout.php" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-log-out"></span> Logout </a>';
            ?>
            
      </div>
      <script src="../libs/jquery-3.2.0.min.js"></script>
      <script src="../libs/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
      <script type='text/javascript'>
         function delete_user( playerID ){
             var answer = confirm('Are you sure?');
             if (answer){
                 // If confirmed, repass the id to delete.php
                 window.location = 'delete.php?playerID=' + playerID;
             } 
         }
      </script> 
   </body>
</html>