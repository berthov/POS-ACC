<?php
	
session_start();
include("doconnect.php");
include("session.php");	
include("../query/find_ledger.php");
	
$counter = $_REQUEST['counter'];
$inventory_item_id = $_REQUEST['inventory_item_id'];	
$uom = $_REQUEST['uom'];
$qty = $_REQUEST['qty'];
$price = $_REQUEST['price'];
$outlets = $_REQUEST['outlets'];
$po_date = date('Y-m-d', strtotime($_REQUEST['po_date']));
$supplier = $_REQUEST['supplier'];
$due_date = date('Y-m-d', strtotime($_REQUEST['due_date']));
$ship_to = $_REQUEST['ship_to'];  
$po_description = $_REQUEST['po_description'];  
$created_date = date("y-m-d H:i:s");
$po_header_id =  date("YmdHis");
$today =  date("y-m-d H:i:s");
$status = "Open";
$created_date =  date("Y-m-d");
$last_update_date =  date("Y-m-d");	


if (isset($_REQUEST['po_date'])) {
  
// PO HEADER
  $sql_header = "INSERT INTO PO_HEADER_ALL (po_header_id,po_date,supplier,ship_to,outlets,po_description,due_date,status,created_by , created_date,last_update_by,last_update_date,ledger_id,outlet_id)
  VALUES ('".$po_header_id."','".$po_date."' , '".$supplier."' , '".$ship_to."' , '".$outlets."','".$po_description."','".$due_date."','".$status."','".$user_check."','".$created_date."','".$user_check."','".$last_update_date."','".$ledger_new."','".$outlet_new."')";
  mysqli_query($conn, $sql_header);

// PO LINE
  for($y = 0; $y < count($inventory_item_id); $y++ ){
    $sql_line = "INSERT INTO PO_LINE_ALL (po_header_id,uom ,qty,price,inventory_item_id,created_by , created_date,last_update_by,last_update_date)
    VALUES ('".$po_header_id."','".$uom[$y]."' , '".$qty[$y]."' , '".$price[$y]."','".$inventory_item_id[$y]."','".$user_check."','".$created_date."','".$user_check."','".$last_update_date."')";
    mysqli_query($conn, $sql_line);
      }

// update amount_due_remaining
  $sql_header = "UPDATE PO_HEADER_ALL poh set poh.amount_due_remaining = (select sum(price*qty) from PO_LINE_ALL POL where poh.po_header_id = pol.po_header_id) where poh.po_header_id = '".$po_header_id."'";
  mysqli_query($conn, $sql_header);


  header("Location:../form_po.php");
}

?>