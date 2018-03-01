<?php
	
	include("doconnect.php");
	$id = $_REQUEST['id'];

		$sql = "DELETE from INVENTORY where ID = '".$id."'";
		
		if (mysqli_query($conn, $sql)) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);

		header("Location:../tables_dynamic.php");
	

?>