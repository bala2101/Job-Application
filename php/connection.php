<?php
$sqluser = "root";
$sqlpassword = "root";
$database = "test5";

$conn= mysqli_connect("localhost", $sqluser, $sqlpassword); // establishing connection to the database

if (!mysqli_select_db($conn, $database)) { // check if the database exits or not. If not, create a new database
	$qquery = "CREATE DATABASE `".$database."`";
    if(mysqli_query($conn, $qquery)){}else{echo "Error creating database:".mysqli_error($conn);}
    mysqli_select_db($conn, $database) or die( "Unable to select database");
}

$queryCreateProfilesTable = "CREATE TABLE IF NOT EXISTS `profiles` (`id` int(11) unsigned NOT NULL PRIMARY KEY auto_increment, `firstName` text, `lastName` text, `address` varchar(50), `city` text, `pcode` int(11), `phone` int(11), `email` varchar(30), `cv` longblob)"; // check if the profiles table exits or not. If not, create a new profile table.

if(mysqli_query($conn, $queryCreateProfilesTable)){}else{echo "Error creating profiles table:".mysqli_error($conn);}

$queryCreateAdminTable = "CREATE TABLE IF NOT EXISTS `admin` (`admin` text, `password` varchar(100))"; // check if the admin table exits or not. If not, crate a new admin table.

if(mysqli_query($conn, $queryCreateAdminTable)){} else {echo "Error creating admin table:".mysqli_error($conn);}

$check = "SELECT * FROM `admin`";
$check1 = mysqli_query($conn, $check);
$rows = mysqli_num_rows($check1);
if(!$rows){ // entering the log in credentials of the admin into the database.
	$ausername = "admin";
	$apassword = "admin";
$queryCred = "INSERT INTO `admin` VALUES('".$ausername."','".md5(md5($ausername).$apassword)."')"; // .md5(md5($_POST['email']).$_POST['password']).
	if(mysqli_query($conn, $queryCred)){}else{echo "Error entering values:".myqli_error($conn);}
}
?>