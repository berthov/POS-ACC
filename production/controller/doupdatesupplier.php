<?php
	session_start();
	include("doconnect.php");
	include("session.php");
	
	$party_id = $_REQUEST['party_id'];
	$supplier_name = $_REQUEST['supplier_name'];	
	$supplier_site = $_REQUEST['supplier_site'];
	$supplier_type = $_REQUEST['supplier_type'];
	$tax = $_REQUEST['tax'];	
	$status = $_REQUEST['status'];
	$last_update_date =  date("Y-m-d");




	if (is_numeric($tax) == 0) {
		echo "
			<script>
		  			alert('Tax must be a number');
    				window.history.back();
    		</script>";
	}
	else{
		
		$sql = "UPDATE ap_supplier_all SET supplier_name= '".$supplier_name."', supplier_site = '".$supplier_site."',supplier_type = '".$supplier_type."',tax = '".$tax."',status='".$status."' ,last_update_by = '".$user_check."'  ,last_update_date = '".$last_update_date."'  where party_id = '".$party_id."'";
		
		if (mysqli_query($conn, $sql)) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);

		header("Location:../table_supplier.php");
	}

?>