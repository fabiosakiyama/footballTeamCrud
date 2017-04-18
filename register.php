<!-- Login logic. Using BCrypted passwords -->

<!DOCTYPE html>  
<html>
   <head>
      <title>FootBall Team - Register</title>
      <!-- Bootstrap -->
      <link rel="stylesheet" href="libs/football.css" />
   </head>
   <body>
   <br />  
      <div class="container" style="width:500px;">
         <img src="images/teamlogo.jpg" class="img-responsive center-block" alt="Responsive image">
         <h3>Register</h3>
         <br /> 
         
         <?php
            if($_POST){
             
                // DB connection
                include 'config/database.php';
                // Getting username from the form
                $userName=htmlspecialchars(strip_tags($_POST['userName']));
                // The query that select a user with passed username
                $validationQuery = "SELECT userName FROM user WHERE userName = ?";
                // Preparing the query
                $validationStmt = $con->prepare($validationQuery);
                // Binding the value to the query
                $validationStmt->bindParam(1, $userName);
                // Executing the query
                $validationStmt->execute();
                // Checks if there's a result on the query
                $num = $validationStmt->rowCount();
                // If there is, means that the username already exists on the database
                if($num>0){
                	$message = '<label>Username already in use</label>'; 
                }else{
	             
	                try{
	                    // The query that will add a player
	                    $query = "INSERT INTO user SET userName=:userName, pass=:pass, privilege=:privilege";
	             
	                    // Preparing the query
	                    $stmt = $con->prepare($query);
	             
	                    // Getting the values from the form
	                    $pass=htmlspecialchars(strip_tags($_POST['pass']));
	                    if(isset($_POST['privilege'])){
	                    	$privilege=1;
	                    }else{
	                    	$privilege=0;
	                    }
	             
	                    $hashPass=password_hash($pass, PASSWORD_DEFAULT);
	                    
	                    // Binding the values to the query
	                    $stmt->bindParam(':userName', $userName);
	                    $stmt->bindParam(':pass', $hashPass);
	                    $stmt->bindParam(':privilege', $privilege);
	                     
	                    // Executing the query
	                    if($stmt->execute()){
	                    	// Redirecting to the read.php passing the action, so the read.php can alert the user
	                        header('Location: index.php?action=registered');
	                    }else{
	                    	die('Unable to register new user.');
	                    }
	                }
	                catch(PDOException $exception){
	                    die('ERROR: ' . $exception->getMessage());
	                }
                }
            }
         ?> 
          <?php  
            if(isset($message)){  
            	echo '<label class="text-danger">'.$message.'</label>';  
            }  
         ?>
         <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label>Username</label>  
            <input type="text" name="userName" class="form-control" />  
            <br />  
            <label>Password</label>  
            <input type="password" name="pass" class="form-control" />  
            <div class="checkbox">
		    <label>
		    	<input type="checkbox" name="privilege"> Admin?
		    </label>
		    </div>  
            <br />  
            <input type="submit" name="save" class="btn btn-info" value="Save" />
            <a href='index.php' class='btn btn-danger'>Back to Login</a>  
         </form>
      </div>
      <br />
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="libs/jquery-3.2.0.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="libs/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>  
   </body>
</html>