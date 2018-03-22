<?php
	
	session_start();
	include("doconnect.php");
	include("session.php");

	$payment_number = $_REQUEST['payment_number'];	
	$payment_date = date('Y-m-d', strtotime($_REQUEST['payment_date']));
	$payment_type = $_REQUEST['payment_type'];
	$payment_amount = $_REQUEST['payment_amount'];
	$po_header_id = $_REQUEST['po_header_id'];
  	$created_date =  date("Y-m-d");
  	$last_update_date =  date("Y-m-d");



	$sql = "INSERT INTO ap_check_all (po_header_id, payment_number,payment_date,payment_type,payment_amount,created_by , created_date,last_update_by,last_update_date)
		VALUES ('".$po_header_id."', '".$payment_number."' , '".$payment_date."' , '".$payment_type."' , '".$payment_amount."','".$user_check."','".$created_date."','".$user_check."','".$last_update_date."')";

		if (mysqli_query($conn, $sql)) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);

		header("Location:../payment_po.php?po_header_id=$po_header_id");

?>