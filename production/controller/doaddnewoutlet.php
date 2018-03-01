<?php
	
	include("doconnect.php");

	$outlet_name = $_REQUEST['outlet_name'];	
	$address = $_REQUEST['address'];
	$email = $_REQUEST['email'];
	$phone = $_REQUEST['phone'];
	$city = $_REQUEST['city'];
	$province = $_REQUEST['province'];
	$postal_code = $_REQUEST['postal_code'];
	$date_founded = $_REQUEST['date_founded'];

	$sql = "INSERT INTO outlet (name, address,phone,city,province,postal_code,date_founded,email)
		VALUES ('".$outlet_name."', '".$address."' , '".$phone."' , '".$city."' , '".$province."','".$postal_code."','".$date_founded."','".$email."')";

		if (mysqli_query($conn, $sql)) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);

		header("Location:../outlets.php");

?>