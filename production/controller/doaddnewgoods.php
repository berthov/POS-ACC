<?php

	include("doconnect.php");
	session_start();
	$user_check = $_SESSION['login_user'];
	
	include ("../query/find_ledger.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){

	$item_code = $_REQUEST['item_code'];	
	$description = $_REQUEST['description'];
	$qty = $_REQUEST['qty'];
	// $unit_price = $_REQUEST['unit_price'];
	$min = $_REQUEST['min'];
	$max = $_REQUEST['max'];
	// $cogs = $_REQUEST['cogs'];
	$created_date =  date("Y-m-d");	
	$last_update_date =  date("Y-m-d");


		$check_item = "SELECT * FROM inventory WHERE ledger_id = '".$ledger_new."' and item_code = '".$item_code."' ";
		$result_item = mysqli_query($conn,$check_item);
		$existing_item = mysqli_fetch_assoc($result_item);


		if ($existing_item) { 
	     if ($existing_item['item_code'] === $item_code) {
		      echo 'Item already exist';
		    }
		}
		else{

		$sql = "INSERT INTO inventory (item_code, description,qty,unit_price,min,max,hpp,created_by , created_date,last_update_by,last_update_date,ledger_id)
		VALUES ('".$item_code."', '".$description."','".$qty."' , '".$unit_price."' , '".$min."' , '".$max."','".$cogs."','".$user_check."','".$created_date."','".$user_check."','".$last_update_date."','".$ledger_new."')";

		if (mysqli_query($conn, $sql)) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);

		// header("Location:../form_validation.php");


	}
}

?>