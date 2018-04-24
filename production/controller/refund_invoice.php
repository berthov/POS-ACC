<?php
	session_start();
	include("doconnect.php");

	$user_check = $_SESSION['login_user'];


	$invoice_id = $_REQUEST['invoice_id'];	
	$created = date("Y-m-d");
	$description = 'Refund Invoice:'.$invoice_id;

			
	$check_refund = "SELECT * FROM invoice_header WHERE invoice_id = '".$invoice_id."'";
	$result = mysqli_query($conn,$check_refund);
	$existing_result = mysqli_fetch_assoc($result);

	if ($existing_result) {
		if ($existing_result['refund_status'] === 'Yes') {
			echo "Invoice already Refunded";
		}
		else{
	
			$sql = "UPDATE invoice_header SET refund_status = 'Yes' where invoice_id = '".$invoice_id."'";
			mysqli_query($conn, $sql);

			$sql = "SELECT *  
		    FROM invoice
		    WHERE
		    invoice_id= '".$invoice_id."'";
		    $result = $conn->query($sql);
		    while($row = $result->fetch_assoc()) {

		    // insert ke mutasi
		    $sql = "INSERT INTO material_transaction (inventory_item_id, ledger_id,transaction_date,qty,description,created_by , created_date , last_update_by,last_update_date,type)
		    VALUES ('".$row['inventory_item_id']."', '".$row['ledger_id']."','".$created."','".$row['qty']."','".$description."','".$user_check."','".$created."','".$user_check."','".$created."','Refund')";
	    	mysqli_query($conn, $sql);

	    	// update qty onhand
    		$sql_onhand = "UPDATE inventory SET qty= (select sum(qty) from material_transaction where inventory_item_id = '".$row['inventory_item_id']."') , last_update_date= '".$last_update_date."' ,last_update_by= '".$user_check."' WHERE id = '".$row['inventory_item_id']."'";
			mysqli_query($conn, $sql_onhand);

			header("Location:../tables_invoice.php");			    
		    
		    }

		}
		
	}

	mysqli_close($conn);



?>
