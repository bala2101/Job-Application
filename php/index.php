<?php
session_start();
	if(isset($_SESSION['id'])){ //checking if the session is expired or not
		header("Location:indexpage.php");
		exit();
	}
if(isset($_POST["submit"])){  // PHP form validation || Back end validation
		if(!$_POST['firstName']){
			$error = "</br>Please enter your First Name.";
		}
		if(!$_POST['lastName']){
			$error .= "</br>Please enter your Last Name.";
		}
		if(!$_POST['address']){
			$error .= "</br>Please enter your Address.";
		}
		if(!$_POST['city']){
			$error .= "</br>Please enter your City.";
		}
		if(!$_POST['pcode']){
			$error .= "</br>Please enter your Postal code.";
		}
		if(!$_POST['phone']){
			$error .= "</br>Please enter your Phone number.";
		}
		if(!$_POST['email']){
			$error .= "</br>Please enter your email";
		}
		if(strlen($_POST['phone']) <8 OR strlen($_POST['phone'])>11){
			$error = "</br>Please enter a valid Phone number.";
		}
		if(strlen($_POST['pcode']) <5 OR strlen($_POST['pcode'])>8){
			$error = "</br>Please enter a valid Postal code.";
		}
		if(isset($error)){ // Displaying error message with little bootstrap
			$result = '<div class = "alert alert-danger"><strong>There were error(s) in your form:</strong>'.$error.'</div>';
		} else { // Displaying success message with little bootstrap
			$result = '<div class = "alert alert-success"><strong>Thank you for showing interest in the job. We will get back to you as soon as possible.</strong></div>';	
			
			$errmsg = "";
			include("connection.php");
		
			if($errmsg == ""){
				if($_POST['completed'] == 1){ // uploading the pdf file 
					$uploadfile = basename($_FILES['myfile']['name']);					// When we upload a file it saves in a temporary location
					move_uploaded_file($_FILES['myfile']['tmp_name'], $uploadfile);		// Moving file from temp location to permanent location.
					$fileAsString = base64_encode(file_get_contents($uploadfile));
					if(strlen($fileAsString) < 1000000){
						$query = "INSERT INTO `profiles` VALUES ('','".mysqli_real_escape_string($conn, $_POST['firstName'])."','".mysqli_real_escape_string($conn, $_POST['lastName'])."','".mysqli_real_escape_string($conn, $_POST['address'])."','".mysqli_real_escape_string($conn, $_POST['city'])."','".mysqli_real_escape_string($conn, $_POST['pcode'])."','".mysqli_real_escape_string($conn, $_POST['phone'])."','".mysqli_real_escape_string($conn, $_POST['email'])."', '".$fileAsString."')";
			
						mysqli_query($conn, $query);

						$errmsg = "Record inserted";
					} else {
						$errmsg = "Too large file";
					}
				} else {
					$errmsg = "Form not completed";
				}
			}
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
		<h2>Application for System Administrator position</h2></br></br></br> 
		<?php  // displaying the error messages.
			if(isset($result)){
				echo $result;
			}
		?>
		<form method = "POST" name ="jobform" enctype = "multipart/form-data" onSubmit = "return validate()"> <!-- Simple job application form -->
			<table>
				<tr><td><label for = "fname">First Name</label></br></br></td><td><input type="text" name="firstName" class = "form-group" value = "<?php if(isset($_POST['firstName'])){echo $_POST['firstName']; } ?>" placeholder = "First Name" required></td></tr>
				<tr><td><label for = "lname">Last Name</label></br></br></td><td><input type="text" name="lastName" class = "form-group" value = "<?php if(isset($_POST['lastName'])){echo $_POST['lastName']; } ?>" placeholder = "Last Name" required></td></tr>
				<tr><td><label for = "address">Address</label></br></br></td><td><input type="textarea" name="address" class = "form-group" value = "<?php if(isset($_POST['address'])){echo $_POST['address']; } ?>" placeholder = "Address" required></td></tr>
				<tr><td><label for = "city">City</label></br></br></td><td><input type="text" name="city" class = "form-group" value = "<?php if(isset($_POST['city'])){echo $_POST['city']; } ?>" placeholder = "City" required></td></tr>
				<tr><td><label for = "pcode">Postal Code</label></br></br></td><td><input type="text" name="pcode" class = "form-group" value = "<?php if(isset($_POST['pcode'])){echo $_POST['pcode']; } ?>" placeholder = "Postal code" required></td></tr>
				<tr><td><label for = "phone">Phone</label></br></br></td><td><input type="text" name="phone" class = "form-group" value = "<?php if(isset($_POST['phone'])){echo $_POST['phone']; } ?>" placeholder = "Phone" required></td></tr>
				<tr><td><label for = "email">Email</label></br></br></td><td><input type="email" name="email" class = "form-group" value = "<?php if(isset($_POST['email'])){echo $_POST['email']; } ?>" placeholder = "Email" required></td></tr>
				<tr><td><label for = "cv">CV</label></td><td></br><input type = "hidden" name = "MAX_FILE_SIZE" value = "1000000"><input type = "hidden" name = "completed" value = "1"><input type="file" name="myfile" value = "<?php if(isset($_POST['myfile'])){echo $_POST['myfile']; } ?>" required><h6>only pdf file...</h6></td></tr>
				<tr><td></br></br><input type="submit" value ="Apply Job" name="submit" class="btn btn-success btn-lg"></td></tr>
			</table>
		</form>
	</div>
	<div id = "footer">
		<p>&copy; <script>new Date().getFullYear()</script> Bala Jaswanth. All rights reserved.</p>
	</div>
	</div>
	</div>
  </div>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 </body>
</html>
