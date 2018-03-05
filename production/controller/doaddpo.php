<?php
	
	include("doconnect.php");
	date_default_timezone_set('Asia/Jakarta');			
	$item_code = $_REQUEST['item_code'];
	$description = $_REQUEST['description'];	
	$qty = $_REQUEST['qty'];
  $price = $_REQUEST['price'];
	$po_id =  date("YmdHis");
  $outlets = $_REQUEST['outlets'];
  $supplier = $_REQUEST['supplier'];
  $ship_to = $_REQUEST['ship_to'];
  $created_date = $_REQUEST['created_date'];

	$today =  date("y-m-d H:i:s");
	$time = date("H:i:s");
  $month = date("F");
                    

	for($y = 0; $y < count($item_code); $y++ ){
		// if ($quant[$y] > 0) {    

	 //    	$sql2 = "SELECT * from inventory WHERE description = '".$arr[$y]."'";
	 //    	$result = mysqli_query($conn, $sql2);
	 //    	while($row = $result->fetch_assoc()) {
	 //    		if ($row["qty"] - $quant[$y] < 0 ){
		//     			header("Location:../media_gallery.php?err=2&item=$arr[$y]");
	 //    		}
	 //    		else{
	 //    				$sql = "INSERT INTO invoice (description,unit_price,qty ,date,invoice_id,month,payment_method)
		// 				VALUES ('".$arr[$y]."','".$arr1[$y]."' , '".$quant[$y]."' , '".$today."' , '".$invoice_id."', '".$month."','".$payment_method."')";
		// 				mysqli_query($conn, $sql);
					
		//     			$sql1 = "UPDATE inventory SET qty= qty - '".$quant[$y]."' WHERE description = '".$arr[$y]."'";
		// 					if (mysqli_query($conn, $sql1)) {
		// 					   /* echo $y , "New row has been insert successfully <br>";*/
		// 					    /*header("Location:../media_gallery.php");*/
		// 					} 
		// 					else {
		// 		 			   echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
		// 					}
		//     		}	
	 //    	}
		// }

    
		
	}

		mysqli_close($conn);
?>