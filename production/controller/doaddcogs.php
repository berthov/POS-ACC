<?php
	
	include("doconnect.php");

	$description = $_REQUEST['description'];	
	$cogs = $_REQUEST['cogs'];
	$period = $_REQUEST['period'];

//UNTUK PERIOD MASIH BINGGUNG 

	if($description=="" || $cogs=="" || $period==""){
		echo "
			<script>
		  			alert('All fields must be filled');
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
	else{
		
		$sql = "INSERT INTO cogs (description, cogs,period)
		VALUES ('".$description."', '".$cogs."','".$period."')";

		if (mysqli_query($conn, $sql)) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);

		header("Location:../cogs.php");
	}

?>