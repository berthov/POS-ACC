<?php
	
	include("doconnect.php");

	$payment_number = $_REQUEST['payment_number'];	
	$payment_date = $_REQUEST['payment_date'];
	$payment_type = $_REQUEST['payment_type'];
	$payment_amount = $_REQUEST['payment_amount'];
	$po_header_id = $_REQUEST['po_header_id'];




	$sql = "INSERT INTO ap_check_all (po_header_id, payment_number,payment_date,payment_type,payment_amount)
		VALUES ('".$po_header_id."', '".$payment_number."' , '".$payment_date."' , '".$payment_type."' , '".$payment_amount."')";

		if (mysqli_query($conn, $sql)) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);

		header("Location:../payment_po.php");

?>