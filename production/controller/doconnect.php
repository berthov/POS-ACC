<?php
	date_default_timezone_set('Asia/Jakarta');	

    $servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "acc_test";
	
	$conn1 = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn1) {
    die("Connection failed: " . mysqli_connect_error());
}


?>