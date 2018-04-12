<?php

	include("doconnect.php");
	include("session.php");
	include("query/find_ledger.php");
	session_start();

	if($_SERVER["REQUEST_METHOD"]=="POST"){

		$recipe_name = $_REQUEST['recipe_name'];	
		$item_code = $_REQUEST['item_code'];	
		$description = $_REQUEST['description'];	
		$qty = $_REQUEST['qty'];
		$created = date("Y-m-d H:i:s");
		$ledger = date("mdhs");
		$recipe_id = "R". "" .date("mdhs");

		$check_recipe = "SELECT * FROM fmd_recipe WHERE ledger_id = '".$ledger_new."";
		$result = mysqli_query($conn,$check_recipe);
		$existing_recipe = mysqli_fetch_assoc($result);


			if ($existing_recipe) { 
			     if ($existing_recipe['recipe_name'] === $recipe_name) {
			      echo 'Recipe already exist';
			    }
			}
			else {

					// RECIPE HEADER
					$sql = "INSERT INTO fmd_recipe_header (name, role, email, outlet_id, employee_id, created_by, last_update_by, created_date, last_update_date, password,ledger_id) VALUES ('$usernameregister', '$roleregister', '$emailregister', '$outletregister', NULL, NULL, NULL, '$created', NULL, '$passwordregister','$ledger_new')";
	  				$result = mysqli_query($conn, $sql);

	  				// RECIPE LINE
  				    for($y = 0; $y < count($item_code); $y++ ){
				    $sql_line = "INSERT INTO fmd_recipe_line (po_header_id,item_code,uom ,qty,price,description,created_by , created_date,last_update_by,last_update_date)
				    VALUES ('".$po_header_id."','".$item_code[$y]."' , '".$uom[$y]."' , '".$qty[$y]."' , '".$price[$y]."','".$description[$y]."','".$user_check."','".$created_date."','".$user_check."','".$last_update_date."')";
				    mysqli_query($conn, $sql_line);
				      }

					header("location: ../recipe.php");
			}
		
	}
?>