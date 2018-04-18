<?php
	session_start();
	include("doconnect.php");

	$user_check = $_SESSION['login_user'];
	include("../query/find_ledger.php");

	$inventory_item_id = $_REQUEST['inventory_item_id'];	
	$qty = $_REQUEST['qty'];
	$description = $_REQUEST['description'];
	$transaction_date = date('Y-m-d H:i:s', strtotime($_REQUEST['transaction_date']));
	$type = 'Adjustment';
	$created = date("Y-m-d H:i:s");


	if($_SERVER["REQUEST_METHOD"]=="POST"){
			
		$sql = "INSERT INTO material_transaction (inventory_item_id, ledger_id,transaction_date,qty,description,created_by , created_date , last_update_by,last_update_date,type)
		VALUES ('".$inventory_item_id."', '".$ledger_new."','".$transaction_date."','".$qty."','".$description."','".$user_check."','".$created."','".$user_check."','".$user_check."','".$type."')";

		if (mysqli_query($conn, $sql)) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}


		/*update on hand quantity*/
		$sql_onhand = "UPDATE inventory SET qty= (select sum(qty) from material_transaction where inventory_item_id = '".$inventory_item_id."') , last_update_date= '".$last_update_date."' ,last_update_by= '".$user_check."' WHERE id = '".$inventory_item_id."'";
		
		mysqli_query($conn, $sql_onhand);

		mysqli_close($conn);

		header("Location:../adjustment_inventory.php");
	
}
?>