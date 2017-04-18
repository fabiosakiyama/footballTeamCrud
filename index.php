<!-- Login logic. Using BCrypted passwords -->

<!DOCTYPE html>  
<html>
   <head>
      <title>FootBall Team - Login</title>
      <!-- Bootstrap -->
      <link rel="stylesheet" href="libs/football.css" />
   </head>
   <body>
      <?php  
         // Starting the session
         session_start();  
         
         // DB connection
         include 'config/database.php';
         
         // Verifies is there's an action redirected by register page
         $action = isset($_GET['action']) ? $_GET['action'] : "";
         
         // And if it was, alerts the user that the user was created.
         if($action=='registered'){
         	echo "<div class='alert alert-success'>User created!</div>";
         }
         
         if(isset($_POST["register"])){
         	header("location:register.php"); 
         }
          
         try{
         	// On submit
         	if(isset($_POST["login"])){  
         		// Checking required fields
         		if(empty($_POST["userName"]) || empty($_POST["pass"])){  
             		$message = '<label>All fields are required</label>';  
             	}  
             	else{  
             		
             		$userName= $_POST['userName']; //from username field
             		$pass = $_POST['pass']; // from password field
             		
             		// Query that select all fields of a user given an username
             		$query = "SELECT * FROM user WHERE userName = ?";
             		
             		// Preparing the query
             		$stmt= $con->prepare($query);
             		
             		// Executing the query, binding the username on its calls.
             		$stmt-> execute(array($userName));
             		
             		// Fetching the results
             		$row = $stmt->fetch(PDO::FETCH_ASSOC);
             		
             		// Getting the hashed password from database
             		$hashPass= $row['pass']; 
             		
             		// The method password_verify returns true if the pass and the hashpass matches.
             		$isPassCorrect = password_verify($pass, $hashPass);
             		
             		if($isPassCorrect){
             			// Setting username and privilege in the session
	             		$_SESSION["userName"] = $_POST["userName"];
	             		$_SESSION["privilege"] = $row['privilege'];
	             		// Redirects to read.php
             			header("location:player/read.php"); 
             		}else{
             			$message = '<label>Wrong Password/Username</label>'; 
             		}
         		}  
         	}  
         }catch(PDOException $error){
         	$message = $error->getMessage();  
         }  
         ?>  
      <br />  
      <div class="container" style="width:500px;">
         <?php  
            if(isset($message)){  
            	echo '<label class="text-danger">'.$message.'</label>';  
            }  
         ?>  
         <img src="images/teamlogo.jpg" class="img-responsive center-block" alt="Responsive image">
         <h3>Login</h3>
         <br />  
         <form method="post">  
            <label>Username</label>  
            <input type="text" name="userName" class="form-control" />  
            <br />  
            <label>Password</label>  
            <input type="password" name="pass" class="form-control" />  
            <br />  
            <input type="submit" name="login" class="btn btn-primary" value="Login" />  
            <label>Or</label>
            <input type="submit" name="register" class="btn btn-info" value="Register" />  
         </form>
      </div>
      <br />
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="libs/jquery-3.2.0.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="libs/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>  
   </body>
</html>