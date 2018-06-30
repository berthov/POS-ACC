<?php
	include("doconnect.php");
	session_start();	
	include("session.php");
	include("../query/find_ledger.php");

	if(isset($_POST['action']) && $_POST['action'] == 'deleteStaff'){
			$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	    if ($id > 0) {
	        $query = "DELETE FROM employee WHERE employee_id=" .$id." LIMIT 1";
	        $result = mysqli_query($conn, $query);
	        echo 'ok';
	    } else {
	    	var_dump($id);
	    	printf("Error: %s\n", mysqli_error($conn));
	        echo 'err';
	    }
	    exit;
	}

	$mode=$_POST['mode'];

	if($mode == 'true'){
			$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	    if ($id > 0) {
	        $query = "UPDATE outlet SET status='Active' WHERE outlet_id=" .$id."";
	        $result = mysqli_query($conn, $query);
	        echo 'ok';
	    } else {
	    	printf("Error: %s\n", mysqli_error($conn));
	        echo 'err';
	    }
	    exit;
	}

	if($mode == 'false'){
			$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	    if ($id > 0) {
	        $query = "UPDATE outlet SET status='Inactive' WHERE outlet_id=" .$id."";
	        $result = mysqli_query($conn, $query);
	        echo 'ok';
	    } else {
	    	printf("Error: %s\n", mysqli_error($conn));
	        echo 'err';
	    }
	    exit;
	}
?>