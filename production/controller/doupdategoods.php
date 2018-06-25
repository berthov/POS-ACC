<?php
	session_start();
	include("doconnect.php");
	include("session.php");
	include("../query/find_ledger.php");
		
	$id = $_REQUEST['id'];
	$item_code = $_REQUEST['item_code'];	
	$description = $_REQUEST['description'];
	$min = $_REQUEST['min'];
	$max = $_REQUEST['max'];
	$category = $_REQUEST['category'];
	$last_update_date =  date("Y-m-d");
	$itemUpdated = false;

	if(strlen($item_code)>21){
		echo "Item Code must be under 21 Character";
	}
	else{
		
		$sql = "UPDATE INVENTORY SET item_code= '".$item_code."', description = '".$description."',min='".$min."',max='".$max."' ,last_update_by = '".$user_check."'  ,last_update_date = '".$last_update_date."' , category = '".$category."' where ID = '".$id."'";
		
		if (mysqli_query($conn, $sql)) {
			$itemUpdated = true;
	        $_SESSION['itemUpdated'] = $itemUpdated;
		    echo "New record created successfully";
		} else {
		    echo "error";
		}

		mysqli_close($conn);
	}

?>