<?php
session_start();
include("doconnect.php");
include("session.php");
include("../query/find_ledger.php");

if(isset($_REQUEST['start_date'])){
  $start_date= $_REQUEST['start_date']; 
}

if(isset($_REQUEST['end_date'])){
  $end_date= $_REQUEST['end_date']; 
}

$created_date =  date("Y-m-d");
$last_update_date =  date("Y-m-d");

// IMPORT
// form_validation.php
 if(isset($_POST["Import_inventory"])){
    
    $filename=$_FILES["file"]["tmp_name"];    


     if($_FILES["file"]["size"] > 0)
     {
        $file = fopen($filename, "r");
          while (($getData = fgetcsv($file, 10000, ";")) !== FALSE)
           {


             $sql = "INSERT into inventory (item_code, description,qty,sales_price,min,max,cogs,status,category,created_by,last_update_by,created_date,last_update_date,ledger_id) 
                   values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','".$getData[6]."','".$getData[7]."','".$getData[8]."','".$user_check."','".$user_check."','".$created_date."','".$last_update_date."','".$ledger_new."')";
                   $result = mysqli_query($conn, $sql);
        if(!isset($result))
        {
          echo "<script type=\"text/javascript\">
              alert(\"Invalid File:Please Upload CSV File.\");
              window.history.back();
              </script>";   
        }
        else {
            header("Location:../tables_dynamic.php");
        }
           }
      
           fclose($file); 
     }
  } 

// form_supplier.php
   if(isset($_POST["Import_supplier"])){
    
    $filename=$_FILES["file"]["tmp_name"];    


     if($_FILES["file"]["size"] > 0)
     {
        $file = fopen($filename, "r");
          while (($getData = fgetcsv($file, 10000, ";")) !== FALSE)
           {


             $sql = "INSERT into ap_supplier_all (supplier_name, supplier_site,supplier_type,status,tax) 
                   values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."')";
                   $result = mysqli_query($conn, $sql);
        if(!isset($result))
        {
          echo "<script type=\"text/javascript\">
              alert(\"Invalid File:Please Upload CSV File.\");
              window.history.back();
              </script>";   
        }
        else {
            header("Location:../form_supplier.php");
        }
           }
      
           fclose($file); 
     }
  } 

// EXPORT
  // ar_list_summary.php
if(isset($_POST["ar_list_summary"])){
		 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Gross Sales List Detail.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Invoice Number', 'Invoice Date', 'Due Date', 'Customer Name','Payment Method','Invoice Amount','Refund'));  
      $query = "SELECT quote(ih.invoice_number),
                            ih.invoice_date,
                            ih.due_date,
                            ih.customer_name,
                            ih.payment_method,
                            invoice_line.total,
                            ih.refund_status
                            FROM invoice_header ih
                            ,(
                            SELECT sum(i.unit_price*i.qty) as total, sum(i.tax_amount) as tax , i.invoice_id
                            From invoice i
                            WHERE
                            date_format(i.date,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'
                            and i.ledger_id = '".$ledger_new."'
                            group by
                            i.invoice_id
                            ) invoice_line
                            WHERE
                            ih.ledger_id = '".$ledger_new."'
                            and ih.invoice_id = invoice_line.invoice_id
                            and date_format(ih.invoice_date,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'
                            ";  
      $result = mysqli_query($conn, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 } 

// net_sales_summary.php
 if(isset($_POST["net_sales_detail"])){
		 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Net Sales Detail.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Invoice Number', 'Invoice Date', 'Customer Name', 'Payment Method','Discount','Invoice Amount','Net Sales','Refund'));  
      $query =  "SELECT quote(ih.invoice_number),
                            ih.invoice_date,
                            ih.customer_name,
                            ih.payment_method,
                            ih.discount_amount,
                            invoice_line.total,
                            invoice_line.total - ih.discount_amount, 
                            ih.refund_status
                            FROM invoice_header ih
                            ,(
                            SELECT sum(i.unit_price*i.qty) as total, sum(i.tax_amount) as tax , i.invoice_id
                            From invoice i
                            WHERE
                            date_format(i.date,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'
                            and i.ledger_id = '".$ledger_new."'
                            group by
                            i.invoice_id
                            ) invoice_line
                            WHERE
                            ih.ledger_id = '".$ledger_new."'
                            and ih.invoice_id = invoice_line.invoice_id
                            and date_format(ih.invoice_date,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'
                            ";
      $result = mysqli_query($conn, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }

// table_invoice.php
  if(isset($_POST["export_table_invoice"])){
       
        header('Content-Type: text/csv; charset=utf-8');  
        header('Content-Disposition: attachment; filename=All Invoice.csv');  
        $output = fopen("php://output", "w");  
        fputcsv($output, array('Invoice Number','Invoice Date', 'Due Date','Customer Name', 'Discount','Payment Method', 'Refund','Tax','Outstanding Status'));  
        $query = "SELECT 
                  invoice_number,
                  invoice_date,
                  due_date,
                  customer_name,
                  discount_amount,
                  payment_method,
                  refund_status,
                  tax_code,
                  outstanding_status
                  FROM invoice_header
                  WHERE
                  ledger_id = '".$ledger_new."'
                  order by invoice_date asc";
        $result = mysqli_query($conn, $query);  
        while($row = mysqli_fetch_assoc($result))  
        {  
             fputcsv($output, $row);  
        }  
        fclose($output);  
   } 

// table_dynamic.php
if(isset($_POST["inventory"])){
     
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Inventory.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Item Code', 'Description', 'Quantity', 'COGS','Sales Price','MIN','MAX','Status','Category'));  
      $query = "SELECT 
                item_code,
                description,
                qty,
                cogs,
                sales_price,
                min,
                max,
                status,
                category
                FROM 
                inventory i
                where 
                ledger_id = '".$ledger_new."'  
                order by 
                description                            
                ";
      $result = mysqli_query($conn, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
  }

// table_cogs.php
if(isset($_POST["export_table_cogs"])){
     
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Table COGS.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Item Name', 'COGS', 'Sales Price', 'Transaction Date'));  
      $query = "SELECT 
                i.description , 
                c.item_cost,
                c.sales_price,
                c.periode 
                FROM cogs c, 
                inventory i
                where 
                c.inventory_item_id = i.id
                and c.ledger_id = i.ledger_id
                and c.ledger_id = '".$ledger_new."'
                and c.item_cost_id = (select 
                  max(c_1.item_cost_id)
                  From
                  cogs c_1
                  where
                  c_1.inventory_item_id = c.inventory_item_id
                  and c_1.ledger_id = c.ledger_id)
                order by i.description
                ";
      $result = mysqli_query($conn, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
  }

// table_supplier.php
if(isset($_POST["export_table_supplier"])){
     
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Supplier.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Supplier Name', 'Supplier Site', 'Supplier Type', 'Tax'));  
      $query = "SELECT supplier_name,
                supplier_site,
                supplier_type,
                tax
                FROM ap_supplier_all
                where
                ledger_id = '".$ledger_new."'";
      $result = mysqli_query($conn, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
  }


// outstanding_sales.php
if(isset($_POST["outstanding_sales"])){
     
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Monthly Oustanding Sales.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Period', 'Invoice Amount', 'Real', 'Outstanding'));  
      $query = "SELECT date_format(ih.invoice_date,'%M-%y') as period,
                        (
                          select sum(i2.qty*i2.unit_price)
                          from
                          invoice i2,
                          invoice_header ih2
                          where 
                          i2.invoice_id = ih2.invoice_id
                          and ih2.ledger_id = ih.ledger_id
                          and ih2.refund_status not in ('Yes')
                          and date_format(ih.invoice_date,'%M-%y') = date_format(ih2.invoice_date,'%M-%y')
                        )as invoice_amount,
                        (
                          select sum(aca.payment_amount)
                          from
                          ar_check_all aca,
                          invoice_header ih1
                          where 
                          aca.invoice_id = ih1.invoice_id
                          and ih.ledger_id = ih1.ledger_id
                          and ih1.refund_status not in ('Yes')
                          and date_format(ih.invoice_date,'%M-%y') = date_format(ih1.invoice_date,'%M-%y')
                        )as amount,
                        (
                          select sum(ih3.amount_due_remaining)
                          from
                          invoice_header ih3
                          where 
                          ih3.ledger_id = ih.ledger_id
                          and ih3.refund_status not in ('Yes')
                          and date_format(ih.invoice_date,'%M-%y') = date_format(ih3.invoice_date,'%M-%y')
                        )as outstanding
                          FROM 
                          invoice_header ih 
                          where
                          ih.ledger_id = '".$ledger_new."'
                          and ih.refund_status not in ('Yes')
                          group by 
                          date_format(ih.invoice_date,'%M-%y')
                          order by 
                          date_format(ih.invoice_date,'%m%Y') asc
                          limit 12
                            ";  
      $result = mysqli_query($conn, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 } 

 ?>