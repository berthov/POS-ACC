<?php
	
	session_start();
	include("doconnect.php");
	include("session.php");
	include("../query/find_ledger.php");


	$outlet_name = $_REQUEST['outlet_name'];	
	$address = $_REQUEST['address'];
	$email = $_REQUEST['email'];
	$phone = $_REQUEST['phone'];
	$city = $_REQUEST['city'];
	$province = $_REQUEST['province'];
	$postal_code = $_REQUEST['postal_code'];
	$date_founded = $_REQUEST['date_founded'];
  	$created_date =  date("Y-m-d");
  	$last_update_date =  date("Y-m-d");
  	$status = 'Active';
	

	$sql = "INSERT INTO outlet (name, address,phone,city,province,postal_code,date_founded,email,created_by , created_date,last_update_by,last_update_date,status,ledger_id)
		VALUES ('".$outlet_name."', '".$address."' , '".$phone."' , '".$city."' , '".$province."','".$postal_code."','".$date_founded."','".$email."','".$user_check."','".$created_date."','".$user_check."','".$last_update_date."','".$status."','".$ledger_new."')";

		if (mysqli_query($conn, $sql)) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);

		header("Location:../outlets.php");

?>