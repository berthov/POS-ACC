<?php
	session_start();
	include("doconnect.php");

	$user_check = $_SESSION['login_user'];
	include("../query/find_ledger.php");

	$inventory_item_id = $_REQUEST['inventory_item_id'];	
	$qty = $_REQUEST['qty'];
	$description = $_REQUEST['description'];
	$single_cal2 = date('Y-m-d H:i:s', strtotime($_REQUEST['single_cal2']));
	$type = 'Adjustment';
	$created = date("Y-m-d H:i:s");


	if($_SERVER["REQUEST_METHOD"]=="POST"){
		
			if ($qty === '') {
			echo "Quantity must be filled";
			}
			else{


		$sql = "INSERT INTO material_transaction (inventory_item_id, ledger_id,transaction_date,qty,description,created_by , created_date , last_update_by,last_update_date,type,outlet_id)
		VALUES ('".$inventory_item_id."', '".$ledger_new."','".$single_cal2."','".$qty."','".$description."','".$user_check."','".$created."','".$user_check."','".$user_check."','".$type."','".$outlet_new."')";

		if (mysqli_query($conn, $sql)) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}


		/*update on hand quantity*/
		$sql_onhand = "UPDATE inventory SET qty= qty + '".$qty."' , last_update_date= '".$last_update_date."' ,last_update_by= '".$user_check."' WHERE id = '".$inventory_item_id."'";
		
		mysqli_query($conn, $sql_onhand);

		mysqli_close($conn);

		header("Location:../adjustment_inventory.php");
	}
}
?>