<?php
	
	include("doconnect.php");

	$employee_name = $_REQUEST['employee_name'];	
	$role = $_REQUEST['role'];
	$email = $_REQUEST['email'];
	$outlet = $_REQUEST['outlet'];

	$sql = "INSERT INTO employee (name, role,email,outlet_id)
		VALUES ('".$employee_name."', '".$role."' , '".$email."' , '".$outlet."')";

		if (mysqli_query($conn, $sql)) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);

		header("Location:../employees.php");

?>