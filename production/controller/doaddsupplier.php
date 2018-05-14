<?php
	session_start();
	include("doconnect.php");
	include("session.php");
	include ("../query/find_ledger.php");

	$supplier_name = $_REQUEST['supplier_name'];	
	$supplier_site = $_REQUEST['supplier_site'];
	$supplier_type = $_REQUEST['supplier_type'];
	$tax = $_REQUEST['tax'];	
	$status = 'Active';
	$created_date =  date("Y-m-d");
	$last_update_date =  date("Y-m-d");



	if (is_numeric($tax) == 0) {
		echo "
			<script>
		  			alert('Tax must be a number');
    				window.history.back();
    		</script>";
	}
	else{
		
		$sql = "INSERT INTO ap_supplier_all (supplier_name, supplier_site,supplier_type,status,tax , created_by , created_date,last_update_by,last_update_date,ledger_id)
		VALUES ('".$supplier_name."', '".$supplier_site."','".$supplier_type."','".$status."','".$tax."','".$user_check."','".$created_date."','".$user_check."','".$last_update_date."','".$ledger_new."')";

		if (mysqli_query($conn, $sql)) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);

		header("Location:../form_supplier.php");
	}

?>