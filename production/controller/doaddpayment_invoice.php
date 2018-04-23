<?php
	
	session_start();
	include("doconnect.php");
	include("session.php");

	if($_SERVER["REQUEST_METHOD"]=="POST"){

	$payment_number = $_REQUEST['payment_number'];	
	$payment_date = date('Y-m-d', strtotime($_REQUEST['payment_date']));
	$payment_type = $_REQUEST['payment_type'];
	$payment_amount = $_REQUEST['payment_amount'];
	$invoice_id = $_REQUEST['invoice_id'];
  	$created_date =  date("Y-m-d");
  	$last_update_date =  date("Y-m-d");


	$sql = "INSERT INTO ar_check_all (invoice_id, payment_number,payment_date,payment_type,payment_amount,created_by , created_date,last_update_by,last_update_date)
		VALUES ('".$invoice_id."', '".$payment_number."' , '".$payment_date."' , '".$payment_type."' , '".$payment_amount."','".$user_check."','".$created_date."','".$user_check."','".$last_update_date."')";
	mysqli_query($conn, $sql);
		


	// update outstanding
	$sql_header = "UPDATE invoice_header set amount_due_remaining =  amount_due_remaining - '".$payment_amount."' where invoice_id = '".$invoice_id."'";
	mysqli_query($conn, $sql_header);


	$check_outstanding = "SELECT * FROM invoice_header WHERE invoice_id = '".$invoice_id."' ";
	$result = mysqli_query($conn,$check_outstanding);
	$status = mysqli_fetch_assoc($result);


	// update status kalau amount due remaining sudah 0
	if ($status) { 
     if ($status['amount_due_remaining'] == 0) {
	
			$sql_header_status = "UPDATE invoice_header set outstanding_status = 'Paid'  where invoice_id = '".$invoice_id."'";
			mysqli_query($conn, $sql_header_status);
	
	    }
	    else{

			$sql_header_status = "UPDATE invoice_header set outstanding_status = 'Open'  where invoice_id = '".$invoice_id."'";
			mysqli_query($conn, $sql_header_status);
	    }
	}
		
		mysqli_close($conn);

		header("Location:../payment_invoice.php?invoice_id=$invoice_id");

}

?>