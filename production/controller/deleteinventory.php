<?php
	
	include("doconnect.php");
	/*$id = $_REQUEST['id'];

		$sql = "DELETE from INVENTORY where ID = '".$id."'";
		
		if (mysqli_query($conn, $sql)) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);

		header("Location:../tables_dynamic.php");*/

	$mode=$_POST['mode'];

	if($mode == 'true'){
			$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	    if ($id > 0) {
	        $query = "UPDATE inventory SET status='Active' WHERE id=" .$id."";
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
	        $query = "UPDATE inventory SET status='Inactive' WHERE id=" .$id."";
	        $result = mysqli_query($conn, $query);
	        echo 'ok';
	    } else {
	    	printf("Error: %s\n", mysqli_error($conn));
	        echo 'err';
	    }
	    exit;
	}
	

?>