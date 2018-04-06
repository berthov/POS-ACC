<?php
	include("doconnect.php");
	session_start();

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

	if(isset($_POST['action']) && $_POST['action'] == 'deleteOutlet'){
			$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	    if ($id > 0) {
	        //$query = "DELETE FROM outlet WHERE outlet_id=" .$id." LIMIT 1";
	        $query = "UPDATE outlet SET status='Inactive' WHERE id=" .$id."";
	        $result = mysqli_query($conn, $query);
	        echo 'ok';
	    } else {
	    	var_dump($id);
	    	printf("Error: %s\n", mysqli_error($conn));
	        echo 'err';
	    }
	    exit;
	}
?>