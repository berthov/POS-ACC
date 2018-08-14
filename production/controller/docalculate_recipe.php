<?php
	session_start();
	include("doconnect.php");

	$user_check = $_SESSION['login_user'];
	include("../query/find_ledger.php");

	$recipe_name = $_REQUEST['recipe_name'];
	$periode = date("Y-m-d");

	if($_SERVER["REQUEST_METHOD"]=="POST"){

// PERHITUNGAN RATA" 
		$sql = "SELECT 
	        sum(po.avg) as item_cost                         
	        FROM 
	        (
	        select pol.inventory_item_id , sum(pol.qty*pol.price)/count(pol.inventory_item_id) as avg
	        from po_header_all poh,
	        po_line_all pol
	        where 
	        poh.po_header_id = pol.po_header_id
	        and poh.ledger_id = '".$ledger_new."'
	        group by
	        pol.inventory_item_id) PO,
	        fmd_recipe_header frh, 
	        fmd_recipe_line frl
	        right join inventory i
	        on frl.inventory_item_id = i.id                         
	        where frh.recipe_id = frl.recipe_id
	        and frh.recipe_name = '".$recipe_name."'
	        and frh.ledger_id = '".$ledger_new."'
	        and i.id = po.inventory_item_id
	        ";

			$result_avg = mysqli_query($conn,$sql);
			$item_avg = mysqli_fetch_assoc($result_avg);      
			                                  
			$cogs =  $item_avg['item_cost'];

// HARGA SALES PRICE TERAKHIR
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


			$sql = "INSERT INTO cogs (inventory_item_id, item_cost,periode,type,ledger_id,created_date , last_update_date , created_by , last_update_by,sales_price,outlet_id)
			VALUES ('".$recipe_name."', '".$cogs."','".$periode."','Calculation','".$ledger_new."','".$created."','".$created."','".$user_check."','".$user_check."','".$max_sales_price."','".$outlet_new."')";
			 mysqli_query($conn, $sql);

		    
		    $update_cogs = "UPDATE inventory set cogs ='".$cogs."' ,sales_price ='".$max_sales_price."', last_update_by = '".$user_check."' , last_update_date ='".$created."' where id = '".$recipe_name."' and outlet_id = '".$outlet_new."'";
		    mysqli_query($conn, $update_cogs);		   		
			
			mysqli_close($conn);

			header("Location:../calculate_cogs.php");
	}

?>