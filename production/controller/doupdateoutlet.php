<?php
	session_start();
	include("doconnect.php");
	include("session.php");
	include("../query/find_ledger.php");
	
	$outlet_id = $_REQUEST['outlet_id'];
	$outlet_name = $_REQUEST['outlet_name'];	
	$address = $_REQUEST['address'];
	$phone = $_REQUEST['phone'];
	$city = $_REQUEST['city'];
	$province = $_REQUEST['province'];
	$postal_code =  $_REQUEST['postal_code'];
	$email =  $_REQUEST['email'];
	$last_update_date =  date("Y-m-d");
	$outletUpdated = false;

	$sql = "UPDATE OUTLET SET name= '".$outlet_name."', address = '".$address."',phone='".$phone."',city='".$city."' ,last_update_by = '".$user_check."'  ,last_update_date = '".$last_update_date."' , province = '".$province."' , postal_code = '".$postal_code."', email = '".$email."' where outlet_id = '".$outlet_id."'";
		
	if (!(preg_match('/^[0-9]+$/', $phone))){
		echo "error";
	} else {
		if (mysqli_query($conn, $sql)){
			$outletUpdated = true;
	        $_SESSION['outletUpdated'] = $outletUpdated;
		    echo "ok";
		}
		
	}
?>