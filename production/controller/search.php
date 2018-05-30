<?php

	include("doconnect.php");
	session_start();

	$query = "SELECT * FROM inventory WHERE name LIKE "%'.$search_string.'%"";
 
 	$result = mysqli_query($conn,$query);
	while($results = $result->fetch_array()) {
		$result_array[] = $results;
	}

 ?>