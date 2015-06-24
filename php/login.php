<?php
	session_start();
		
		if (isset($_GET["Logout"]) AND $_GET["Logout"]==1 AND $_SESSION['id']) { session_destroy();
		
			$message="You have been logged out. Have a nice day!";
		
		}

		include("connection.php");
		
		if (isset($_POST["submit"]) AND $_POST['submit'] == "Log In") {	
	
		$query = "SELECT * FROM `admin` WHERE admin='".mysqli_real_escape_string($conn, $_POST['username'])."'AND 
		password='".$_POST['password']."' LIMIT 1";

		$result = mysqli_query($conn, $query);
		if (!$result) {
		printf("Error: %s\n", mysqli_error($conn));
		//exit();
		}
		
		$row = mysqli_fetch_array($result);
		
		if($row){
		
			$_SESSION['id']=$row['id'];
			
			header("Location:indexpage.php");
    
		} else {
		
			$error = "We could not find a user with that email and password. Please try again.";
		}
	}
?>

<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="Bala Jaswanth">
  <meta name="Description" content="A simple website">
  <title>System Administrator</title>
  <link href="../css/style.css" rel="stylesheet">
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

 </head>
 <body>
  <div id = "container" class = "container">
  <div class = "row">
  <div class = "col-md-8 col-md-offset-3 jobbody">
	<div id = "header">
		<ul id='menu'> 
			<li><a href='../index.html'>Home</a></li>|
			<li><a href='index.php'>Apply Job</a></li>|
			<li><a href='login.php'>View Data</a></li>
		</ul>
	</div>
	<div id = "main" class = "jobform">
		<h2>Admin Login</h2></br></br></br> 

		<form method = "POST">
			<div class="form-group">
				<label for = "uname"><h4><strong>Username</strong></h4></label></br>
				<input type="text" name="username" placeholder="Username" class="form-control" value="<?php if(isset($_POST['username'])){echo addslashes($_POST['username']);} ?>" />
  			</div>
			<div class="form-group">
				<label for = "password"><h4><strong>Password</strong></h4></label></br>
				<input type="password" name="password" placeholder="Password" class="form-control" value="<?php if(isset($_POST['password'])){echo addslashes($_POST['password']);} ?>" />
  			</div>
  				<input type="submit" name= "submit" class="btn btn-success" value="Log In">
		</form>
		
	</div>
	<div id = "footer">
		<p>&copy; <script>new Date().getFullYear()</script> Bala Jaswanth. All rights reserved.</p>
	</div>
	</div>
	</div>
  </div>
  <!--<script src="../javascript/script.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
 </body>
</html>
