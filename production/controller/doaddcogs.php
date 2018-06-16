<?php
	session_start();
	include("doconnect.php");

	$user_check = $_SESSION['login_user'];
	include("../query/find_ledger.php");

	$inventory_item_id = $_REQUEST['inventory_item_id'];	
	$cogs = $_REQUEST['cogs'];
	$sales_price = $_REQUEST['sales_price'];
	$type = 'Manual';
	$single_cal2 = date('Y-m-d', strtotime($_REQUEST['single_cal2']));
	$created = date("Y-m-d");


	if($_SERVER["REQUEST_METHOD"]=="POST"){

		if ($cogs === '' and $sales_price === '') {
			echo "At least COGS or Sales Price must be filled";
		}
		elseif ($cogs === '') {

			$sql_1 = "SELECT c.item_cost                            
                    FROM cogs c
                    where 
                    c.ledger_id = '".$ledger_new."'
                    and c.inventory_item_id = '".$inventory_item_id."'
                    and c.outlet_id = '".$outlet_new."'
                    and c.item_cost_id = (select 
                    max(c_1.item_cost_id)
                    From
                    cogs c_1
                    where
                    c_1.inventory_item_id = c.inventory_item_id
                    and c_1.ledger_id = c.ledger_id
                    and c_1.outlet_id = c.outlet_id)";

		    		$result = mysqli_query($conn,$sql_1);
					$return = mysqli_fetch_assoc($result);
					$max_cogs = $return['item_cost'];

					// echo "cogs :"; echo $max_cogs;

					$sql = "INSERT INTO cogs (inventory_item_id, item_cost,periode,type,ledger_id,created_date , last_update_date , created_by , last_update_by,sales_price,outlet_id)
				VALUES ('".$inventory_item_id."', '".$max_cogs."','".$single_cal2."','".$type."','".$ledger_new."','".$created."','".$created."','".$user_check."','".$user_check."','".$sales_price."','".$outlet_new."')";
				 mysqli_query($conn, $sql);

			    
			    $update_cogs = "UPDATE inventory set cogs ='".$max_cogs."' , last_update_by = '".$user_check."' , last_update_date ='".$created."' where id = '".$inventory_item_id."' and outlet_id = '".$outlet_new."'";
			    mysqli_query($conn, $update_cogs);

			    
			    $update_sales_price = "UPDATE inventory set sales_price ='".$sales_price."' , last_update_by = '".$user_check."' , last_update_date ='".$created."' where id = '".$inventory_item_id."' and outlet_id = '".$outlet_new."' ";
			    mysqli_query($conn, $update_sales_price);


				mysqli_close($conn);

				header("Location:../cogs.php");

		}
			elseif ($sales_price === '') {
				
				$sql_2 = "SELECT c.sales_price                            
                    FROM cogs c
                    where 
                    c.ledger_id = '".$ledger_new."'
                    and c.inventory_item_id = '".$inventory_item_id."'
                    and c.outlet_id = '".$outlet_new."'
                    and c.item_cost_id = (select 
                    max(c_1.item_cost_id)
                    From
                    cogs c_1
                    where
                    c_1.inventory_item_id = c.inventory_item_id
                    and c_1.ledger_id = c.ledger_id
                    and c_1.outlet_id = c.outlet_id)";

		    		$result = mysqli_query($conn,$sql_2);
					$return = mysqli_fetch_assoc($result);
					$max_sales_price = $return['sales_price'];

					// echo "sales :"; echo $max_sales_price;

					$sql = "INSERT INTO cogs (inventory_item_id, item_cost,periode,type,ledger_id,created_date , last_update_date , created_by , last_update_by,sales_price,outlet_id)
				VALUES ('".$inventory_item_id."', '".$cogs."','".$single_cal2."','".$type."','".$ledger_new."','".$created."','".$created."','".$user_check."','".$user_check."','".$max_sales_price."','".$outlet_new."')";

				mysqli_query($conn, $sql);


			    $update_cogs = "UPDATE inventory set cogs ='".$cogs."' , last_update_by = '".$user_check."' , last_update_date ='".$created."' where id = '".$inventory_item_id."' and outlet_id = '".$outlet_new."' ";
			    mysqli_query($conn, $update_cogs);

			    
			    $update_sales_price = "UPDATE inventory set sales_price ='".$max_sales_price."' , last_update_by = '".$user_check."' , last_update_date ='".$created."' where id = '".$inventory_item_id."' and outlet_id = '".$outlet_new."' ";
			    mysqli_query($conn, $update_sales_price);

				mysqli_close($conn);

				header("Location:../cogs.php");

			}
			else{
		 $sql = "INSERT INTO cogs (inventory_item_id, item_cost,periode,type,ledger_id,created_date , last_update_date , created_by , last_update_by,sales_price,outlet_id)
		 VALUES ('".$inventory_item_id."', '".$cogs."','".$single_cal2."','".$type."','".$ledger_new."','".$created."','".$created."','".$user_check."','".$user_check."','".$sales_price."','".$outlet_new."')";

		 mysqli_query($conn, $sql);

	    $update_cogs = "UPDATE inventory set cogs ='".$cogs."' , last_update_by = '".$user_check."' , last_update_date ='".$created."' where id = '".$inventory_item_id."' and outlet_id = '".$outlet_new."' ";
	    mysqli_query($conn, $update_cogs);

	    
	    $update_sales_price = "UPDATE inventory set sales_price ='".$sales_price."' , last_update_by = '".$user_check."' , last_update_date ='".$created."' where id = '".$inventory_item_id."' and outlet_id = '".$outlet_new."' ";
	    mysqli_query($conn, $update_sales_price);
		     
		 mysqli_close($conn);

		 header("Location:../cogs.php");
	}
}
?>
