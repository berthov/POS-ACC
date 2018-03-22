<?php
session_start();
include("doconnect.php");
include("session.php");

$created_date =  date("Y-m-d");
$last_update_date =  date("Y-m-d");

 if(isset($_POST["Import"])){
		
		$filename=$_FILES["file"]["tmp_name"];		


		 if($_FILES["file"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
	        while (($getData = fgetcsv($file, 10000, ";")) !== FALSE)
	         {


	           $sql = "INSERT into inventory (item_code, description,qty,unit_price,min,max, created_by , created_date,last_update_by,last_update_date) 
                   values ('".$getData[1]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','".$user_check."','".$created_date."','".$user_check."','".$last_update_date."')";
                   $result = mysqli_query($conn, $sql);
				if(!isset($result))
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.history.back();
						  </script>";		
				}
				else {
					  header("Location:../upload_csv.php?");
				}
	         }
			
	         fclose($file);	
		 }
	}	 


 if(isset($_POST["Import_supplier"])){
		
		$filename=$_FILES["file"]["tmp_name"];		


		 if($_FILES["file"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
	        while (($getData = fgetcsv($file, 10000, ";")) !== FALSE)
	         {


	           $sql = "INSERT into ap_supplier_all (supplier_name, supplier_site,supplier_type,status,tax , created_by , created_date,last_update_by,last_update_date) 
                   values ('".$getData[1]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','".$user_check."','".$created_date."','".$user_check."','".$last_update_date."')";
                   $result = mysqli_query($conn, $sql);
				if(!isset($result))
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.history.back();
						  </script>";		
				}
				else {
					  header("Location:../upload_csv.php?");
				}
	         }
			
	         fclose($file);	
		 }
	}	


if(isset($_POST["Export"])){
		 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Inventory.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Item ID', 'Item Code', 'Description', 'Qty', 'Unit Price','Min Quantity','Max Quantity','COGS'));  
      $query = "SELECT * from inventory ORDER BY 1 asc";  
      $result = mysqli_query($conn, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 } 





 ?>