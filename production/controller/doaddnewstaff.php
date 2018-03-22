<?php
	
	session_start();
	include("doconnect.php");
	include("session.php");

	$employee_name = $_REQUEST['employee_name'];	
	$role = $_REQUEST['role'];
	$email = $_REQUEST['email'];
	$outlet = $_REQUEST['outlet'];
  	$created_date =  date("Y-m-d");
  	$last_update_date =  date("Y-m-d");

	$sql = "INSERT INTO employee (name, role,email,outlet_id,created_by , created_date,last_update_by,last_update_date)
		VALUES ('".$employee_name."', '".$role."' , '".$email."' , '".$outlet."','".$user_check."','".$created_date."','".$user_check."','".$last_update_date."')";

		if (mysqli_query($conn, $sql)) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);

		header("Location:../employees.php");

?>