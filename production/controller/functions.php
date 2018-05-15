<?php
// session_start();
include("doconnect.php");
// include("session.php");

// $created_date =  date("Y-m-d");
// $last_update_date =  date("Y-m-d");

 // if(isset($_POST["Import_inventory"])){
		
	// 	$filename=$_FILES["file"]["tmp_name"];		


	// 	 if($_FILES["file"]["size"] > 0)
	// 	 {
	// 	  	$file = fopen($filename, "r");
	//         while (($getData = fgetcsv($file, 10000, ";")) !== FALSE)
	//          {


	//            $sql = "INSERT into inventory (item_code, description,qty,sales_price,min,max,cogs,status,category) 
 //                   values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','".$getData[6]."','".$getData[7]."','".$getData[8]."')";
 //                   $result = mysqli_query($conn, $sql);
	// 			if(!isset($result))
	// 			{
	// 				echo "<script type=\"text/javascript\">
	// 						alert(\"Invalid File:Please Upload CSV File.\");
	// 						window.history.back();
	// 					  </script>";		
	// 			}
	// 			else {
	// 				  header("Location:../form_validation.php?");
	// 			}
	//          }
			
	//          fclose($file);	
	// 	 }
	// }	 

var_dump(isset($_POST["Import"])); 
echo "<br>";
var_dump(isset($_POST["file"])); 

 // if(isset($_POST["file"])){
		
	// 	$filename=$_FILES["file1"]["tmp_name"];		


	// 	 if($_FILES["file1"]["size"] > 0)
	// 	 {
	// 	  	$file = fopen($filename, "r");
	//         while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	//          {


	//            $sql = "INSERT into ap_supplier_all (supplier_name, supplier_site,supplier_type,status,tax) 
 //                   values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."')";
 //                   $result = mysqli_query($conn, $sql);
	// 			if(!isset($result))
	// 			{
	// 				echo "<script type=\"text/javascript\">
	// 						alert(\"Invalid File:Please Upload CSV File.\");
	// 						window.history.back();
	// 					  </script>";		
	// 			}
	// 			else {
	// 				  header("Location:../form_supplier.php");
	// 			}
	//          }
			
	//          fclose($file);	
	// 	 }
	// }	

 	// echo $_POST["file"];

	// if(isset($_POST["Import"])){	
	// 	$filename=$_FILES["file"]["tmp_name"];		
 
 
	// 	 if($_FILES["file"]["size"] > 0)
	// 	 {
	// 	  	$file = fopen($filename, "r");
	//         while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	//          {
 
 
	//            $sql = "INSERT into ap_supplier_all (supplier_name, supplier_site,supplier_type,status,tax) 
 //                   values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."')";
 //                   $result = mysqli_query($conn, $sql);
	// 			if(!isset($result))
	// 			{
	// 				echo "<script type=\"text/javascript\">
	// 						alert(\"Invalid File:Please Upload CSV File.\");
	// 					  </script>";		
	// 			}
	// 			else {
	// 				  header("Location:../form_supplier.php");
	// 			}
	//          }
			
	//          fclose($file);	
	// 	 }
	// 	}
	
// if(isset($_POST["Export"])){
		 
//       header('Content-Type: text/csv; charset=utf-8');  
//       header('Content-Disposition: attachment; filename=Inventory.csv');  
//       $output = fopen("php://output", "w");  
//       fputcsv($output, array('Item ID', 'Item Code', 'Description', 'Qty', 'Unit Price','Min Quantity','Max Quantity','COGS'));  
//       $query = "SELECT * from inventory ORDER BY 1 asc";  
//       $result = mysqli_query($conn, $query);  
//       while($row = mysqli_fetch_assoc($result))  
//       {  
//            fputcsv($output, $row);  
//       }  
//       fclose($output);  
//  } 





 ?>