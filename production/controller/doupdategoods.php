<?php
	
	include("doconnect.php");
	$id = $_REQUEST['id'];
	$item_code = $_REQUEST['item_code'];	
	$description = $_REQUEST['description'];
	$qty = $_REQUEST['qty'];
	$unit_price = $_REQUEST['unit_price'];
	$min = $_REQUEST['min'];
	$max = $_REQUEST['max'];

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
		
		$sql = "UPDATE INVENTORY SET item_code= '".$item_code."', description = '".$description."',qty = '".$qty."',unit_price = '".$unit_price."',min='".$min."',max='".$max."' where ID = '".$id."'";
		
		if (mysqli_query($conn, $sql)) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);

		header("Location:../tables_dynamic.php");
	}

?>