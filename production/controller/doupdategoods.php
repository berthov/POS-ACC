<?php
	session_start();
	include("doconnect.php");
	include("session.php");
	
	$id = $_REQUEST['id'];
	$item_code = $_REQUEST['item_code'];	
	$description = $_REQUEST['description'];
	$min = $_REQUEST['min'];
	$max = $_REQUEST['max'];
	$category = $_REQUEST['category'];
	$last_update_date =  date("Y-m-d");

	if($item_code=="" || $description=="" || $min=="" || $max==""){
		echo "
			<script>
		  			alert('All fields must be filled');
    				window.history.back();
    		</script>";
	}
	else if(strlen($item_code)>21){
		echo "
			<script>
		  			alert('Item Code must be under 21 Character');
    				window.history.back();
    		</script>";
	}
	else if (is_numeric($min == 0)) {
		echo "
			<script>
		  			alert('Unit price must be a number');
    				window.history.back();
    		</script>";
	}
	else if (is_numeric($max == 0)) {
		echo "
			<script>
		  			alert('Unit price must be a number');
    				window.history.back();
    		</script>";
	}
	else{
		
		$sql = "UPDATE INVENTORY SET item_code= '".$item_code."', description = '".$description."',min='".$min."',max='".$max."' ,last_update_by = '".$user_check."'  ,last_update_date = '".$last_update_date."' , category = '".$category."' where ID = '".$id."'";
		
		if (mysqli_query($conn, $sql)) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);

		header("Location:../tables_dynamic.php");
	}

?>