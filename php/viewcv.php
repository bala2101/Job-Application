<?php
	session_start();

	$fname = $_GET['firstName'];
	$idval = $_GET['id'];

		include("connection.php");
		$database = "test1";
			mysqli_select_db($conn, $database) or die( "Unable to select database");
	
	$query="SELECT cv FROM `users` WHERE id='".$idval."' AND firstName='".$fname."'";
	
	$result = mysqli_query($conn,$query);

		
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
			<li><a href='indexpage.php'>Home</a></li>
			<li class = "pull-right"><a href="login.php?Logout=1">Log Out</a></li>
		</ul>
	</div>
	<div id = "main" class = "jobform">
		<h2><?php echo $fname?>'s CV.</h2></br></br></br> 
<?php
	$row = mysqli_fetch_array($result);
	$fileAsString = base64_decode($row['cv']);
	header("Content-type: application/pdf");
	print($fileAsString);
?>

		
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
