<?php
	
session_start();
include("doconnect.php");
include("session.php");	
	
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



?>

<!--  <table>
	<tr>
		<td>Outlet</td>
		<td>PO Date</td>
		<td>Supplier</td>
		<td>Ship To</td>
		<td>due date</td>
	</tr>
	<tr>
		<td>
			<?php echo $outlets; ?>
		</td>
		<td>
			<?php echo $po_date; ?>
		</td>
		<td>
			<?php echo $supplier; ?>
		</td>
		<td>
			<?php echo $ship_to; ?>
		</td>
		<td>
			<?php echo $due_date; ?>
		</td>
	</tr>


</table> 

 <table>
	<tr>
		<td>Description</td>
		<td>Unit Price</td>
		<td>UOM</td>
		<td>Qty</td>
		<td>Price</td>
	</tr>
		<?php
	
			for($x = 0; $x < count($item_code); $x++ ){
			     	
		?>
	<tr>
		<td>
			<?php echo $item_code[$x]; ?>
		</td>
		<td>
			<?php echo $description[$x]; ?>
		</td>
		<td>
			<?php echo $uom[$x]; ?>
		</td>
		<td>
			<?php echo $qty[$x]; ?>
		</td>
		<td>
			<?php echo $price[$x]; ?>
		</td>
		<?php
		}
		?>
	</tr>

</table> 
 -->

<?php

if (isset($_REQUEST['po_date'])) {
  
    // PO HEADER
  $sql_header = "INSERT INTO PO_HEADER_ALL (po_header_id,po_date,supplier,ship_to,outlets,po_description,due_date,status,created_by , created_date,last_update_by,last_update_date)
  VALUES ('".$po_header_id."','".$po_date."' , '".$supplier."' , '".$ship_to."' , '".$outlets."','".$po_description."','".$due_date."','".$status."','".$user_check."','".$created_date."','".$user_check."','".$last_update_date."')";
  mysqli_query($conn, $sql_header);

// PO LINE
  for($y = 0; $y < count($counter); $y++ ){
    $sql_line = "INSERT INTO PO_LINE_ALL (po_header_id,item_code,uom ,qty,price,inventory_item_id,created_by , created_date,last_update_by,last_update_date)
    VALUES ('".$po_header_id."','".$item_code[$y]."' , '".$uom[$y]."' , '".$qty[$y]."' , '".$price[$y]."','".$inventory_item_id[$y]."','".$user_check."','".$created_date."','".$user_check."','".$last_update_date."')";
    mysqli_query($conn, $sql_line);
      }

      header("Location:../form_po.php");
}

?>