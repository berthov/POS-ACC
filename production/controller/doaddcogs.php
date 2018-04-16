<?php
	session_start();
	include("doconnect.php");

	$user_check = $_SESSION['login_user'];
	include("../query/find_ledger.php");

	$inventory_item_id = $_REQUEST['inventory_item_id'];	
	$cogs = $_REQUEST['cogs'];
	// $periode = $_REQUEST['periode'];
	$type = 'Manual';
	$periode = date('Y-m-d', strtotime($_REQUEST['periode']));
	$created = date("Y-m-d");


	if($_SERVER["REQUEST_METHOD"]=="POST"){
			
		$sql = "INSERT INTO cogs (inventory_item_id, item_cost,periode,type,ledger_id,created_date , last_update_date , created_by , last_update_by)
		VALUES ('".$inventory_item_id."', '".$cogs."','".$periode."','".$type."','".$ledger_new."','".$created."','".$created."','".$user_check."','".$user_check."')";

		if (mysqli_query($conn, $sql)) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);

		header("Location:../cogs.php");
	
}
?>