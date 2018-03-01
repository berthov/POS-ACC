<?php

include("doconnect.php");
$p_start_date= $_REQUEST['p_start_date']; 
$p_end_date= $_REQUEST['p_end_date']; 


if(isset($_POST["ar_list_summary"])){
		 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Gross Profit List Detail.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Invoice Number', 'Description', 'Qty', 'Unit Price','Invoice Date','Payment Method'));  
      $query = "SELECT quote(invoice_id) , description,qty,unit_price,date,payment_method FROM invoice
        		where
                (date_format(date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."')
                order by invoice_id";  
      $result = mysqli_query($conn, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 } 

 if(isset($_POST["net_sales_detail"])){
		 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Net Sales Detail.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Invoice Number', 'Invoice Amount', 'Discount', 'Refund','Total'));  
      $query = "SELECT quote(invoice_id) , sum(qty*unit_price),'0','0',sum(qty*unit_price) FROM invoice
        		where
                (date_format(date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."')
                group by invoice_id
                order by invoice_id";  
      $result = mysqli_query($conn, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }

if(isset($_POST["export_table_invoice"])){
     
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