<?php
	
	session_start();
	include("doconnect.php");
	include("session.php");

	$item_code = $_REQUEST['item_code'];	
	$description = $_REQUEST['description'];
	$qty = $_REQUEST['qty'];
	$unit_price = $_REQUEST['unit_price'];
	$min = $_REQUEST['min'];
	$max = $_REQUEST['max'];
	$cogs = $_REQUEST['cogs'];
	$created_date =  date("Y-m-d");	
	$last_update_date =  date("Y-m-d");


	if($item_code=="" || $description=="" || $qty=="" || $unit_price=="" || $min=="" || $max==""){
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
	else if (is_numeric($qty) == 0) {
		echo "
			<script>
		  			alert('Quantity must be a number');
    				window.history.back();
    		</script>";
	}
	else if (is_numeric($cogs) == 0) {
		echo "
			<script>
		  			alert('COGS must be a number');
    				window.history.back();
    		</script>";
	}
	else if (is_numeric($unit_price == 0)) {
		echo "
			<script>
		  			alert('Unit price must be a number');
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
		
		$sql = "INSERT INTO inventory (item_code, description,qty,unit_price,min,max,hpp,created_by , created_date,last_update_by,last_update_date)
		VALUES ('".$item_code."', '".$description."','".$qty."' , '".$unit_price."' , '".$min."' , '".$max."','".$cogs."','".$user_check."','".$created_date."','".$user_check."','".$last_update_date."')";

		if (mysqli_query($conn, $sql)) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);

		header("Location:../form_validation.php");
	}

?>