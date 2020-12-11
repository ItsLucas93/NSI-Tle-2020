<?php

$servername = "localhost"; // Database IP
$username = "root"; // Database username
$password = ""; // Database password /!\ Not so secure to put that here, have to crypt it
$dbname = "reservation"; // Database name
$dbtable1 = "clientreservation"; // Table
$debugmod = FALSE; // If you want to see message of successfull operation

// Create connection to see if DB exists or not, if isnt, creating one from $dbname var
$conn = new mysqli($servername, $username, $password);
$sql = "CREATE DATABASE IF NOT EXISTS ". $dbname . ""; // SQL Command
if ($conn->query($sql) === TRUE) { // Check if the query is OK, if isn't, send error message.
	if ($debugmod == TRUE) {
 	 echo "Database created successfully"; }
} else {
  echo "Error creating database: " . $conn->error;
}
$conn->close(); // Kill connection

// New connection with table
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection

if ($conn->connect_error) { // Check if the connection is OK, if isn't, send error message.
 	die("Connection failed: " . $conn->connect_error);
 	$connected = FALSE;
} else {
	if ($debugmod == TRUE) {
		echo "Connected successfully"; }
	$connected = TRUE;
}

// Create Table if not already exist

if ($connected == TRUE && $dbname != "") {
	$sql = "CREATE TABLE IF NOT EXISTS ". $dbtable1 ." (clientId INTEGER PRIMARY KEY AUTO_INCREMENT, clientFirstName VARCHAR(255) NOT NULL, clientLastName VARCHAR(255) NOT NULL, clientemail VARCHAR(255) NOT NULL, resadate DATE NOT NULL);"; // SQL Command
	if ($conn->query($sql) === TRUE) { // Check if the query is OK, if isn't, send error message.
		if ($debugmod == TRUE) {
	 		echo "Table created successfully"; }
	} else {
		echo "Error creating Table: " . $conn->error;
	}
}
?> 