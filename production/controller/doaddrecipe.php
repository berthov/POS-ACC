<?php

	include("doconnect.php");
	session_start();
	$user_check = $_SESSION['login_user'];

	include("../query/find_ledger.php");

	if($_SERVER["REQUEST_METHOD"]=="POST"){

		$recipe_name = $_REQUEST['recipe_name'];
		$item_code = $_REQUEST['item_code'];
		$description = $_REQUEST['description'];
		$qty = $_REQUEST['qty'];
		$created = date("Y-m-d");
		$recipe_id = "R". "" .date("mdhs");        

		$check_recipe = "SELECT * FROM fmd_recipe_header WHERE ledger_id = '".$ledger_new."' and recipe_name = '".$recipe_name."' ";
		$result_recipe = mysqli_query($conn,$check_recipe);
		$existing_recipe = mysqli_fetch_assoc($result_recipe);


			if ($existing_recipe) { 
			     if ($existing_recipe['recipe_name'] === $recipe_name) {
			      echo 'Recipe already exist';
			    }
			}
			else {
					// RECIPE HEADER
					$sql = "INSERT INTO fmd_recipe_header (recipe_id, recipe_name, ledger_id, created_by, last_update_by, created_date, last_update_date) VALUES ('$recipe_id', '$recipe_name', '$ledger_new', '$user_check', '$user_check', '$created', '$created')";
	  				$result = mysqli_query($conn, $sql);

	  				// RECIPE LINE

  				    for($y = 0; $y < count($item_code); $y++ ){
				    $sql_line = "INSERT INTO fmd_recipe_line (recipe_id,item_code,description,qty,created_by, created_date,last_update_by,last_update_date)
				    VALUES ('".$recipe_id."','".$item_code[$y]."' , '".$description[$y]."' , '".$qty[$y]."' ,'".$user_check."','".$created."','".$user_check."','".$created."')";
				    mysqli_query($conn, $sql_line);
				      }

				   header("location: ../recipe.php");
			}
	}
?>
