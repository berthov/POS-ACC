<?php

include("doconnect.php");

$concat = "'";

if(isset($_POST["Export"])){
		 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Table_invoice.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Invoice Number','Description', 'Unit Price','Qty', 'Date','Month','Payment Method', 'Last Update By','Last Update Date','Created By','Created Date'));  
      $query = "SELECT QUOTE(invoice_id),description,unit_price,qty,date,month,payment_method,last_update_by,last_update_date,created_by,created_date from invoice ORDER BY date desc";  
      $result = mysqli_query($conn, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 } 


 ?>