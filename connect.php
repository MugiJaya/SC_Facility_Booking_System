<?php

$servername = "localhost";
$user = "root";
$password="";
$database = "sports_complex";

$conn = new mysqli($servername, $user, $password, $database);

// check connection
if ($conn->connect_error) 
{
	die("Connection failed: " . $conn->connect_error);
}

?>