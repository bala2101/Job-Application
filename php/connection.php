<?php
$sqluser = "root";
$sqlpassword = "root";
$database = "test1";

$conn= mysqli_connect("localhost", $sqluser, $sqlpassword);

if (!mysqli_select_db($conn, $database)) {
	$qquery = "CREATE DATABASE".$database;
    if(mysqli_query($conn, $qquery)){}else{echo "Error creating database:".mysql_error();}
    mysqli_select_db($conn, $database) or die( "Unable to select database");
}

$queryCreateProfilesTable = "CREATE TABLE IF NOT EXISTS `profiles` (`id` int(11) unsigned NOT NULL PRIMARY KEY auto_increment, `firstName` text, `lastName` text, `address` varchar(50), `city` text, `pcode` int(11), `phone` int(11), `email` varchar(30), `cv` longblob)";

if(mysqli_query($conn, $queryCreateProfilesTable)){}else{echo "Error creating profiles table:".mysqli_error($conn);}

$queryCreateAdminTable = "CREATE TABLE IF NOT EXISTS `admin` (`admin` text, `password` varchar(20))";

if(mysqli_query($conn, $queryCreateAdminTable)){
	$queryCred = "INSERT INTO `admin` VALUES('admin','admin')";
	if(mysqli_query($conn, $queryCred)){}else{echo "Error entering values:".myqli_error($conn);}
} else {
	echo "Error creating admin table:".mysqli_error($conn);
}

?>