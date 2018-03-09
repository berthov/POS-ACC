<?php
	
include("doconnect.php");
date_default_timezone_set('Asia/Jakarta');			
$item_code = $_REQUEST['item_code'];
$description = $_REQUEST['description'];	
$uom = $_REQUEST['uom'];
$qty = $_REQUEST['qty'];
$price = $_REQUEST['price'];
$outlets = $_REQUEST['outlets'];
$po_date = $_REQUEST['po_date'];
$supplier = $_REQUEST['supplier'];
$ship_to = $_REQUEST['ship_to'];  
$created_date = $_REQUEST['created_date'];
$po_header_id =  date("YmdHis");
$today =  date("y-m-d H:i:s");


?>


 <table>
	<tr>
		<td>Outlet</td>
		<td>Purchase Order Date</td>
		<td>Supplier</td>
		<td>Ship To</td>
	</tr>
		<?php
	
			for($y = 0; $y < count($outlets); $y++ ){
			     	
		?>
	<tr>
		<td>
			<?php echo $outlets[$y]; ?>
		</td>
		<td>
			<?php echo $po_date[$y]; ?>
		</td>
		<td>
			<?php echo $supplier[$y]; ?>
		</td>
		<td>
			<?php echo $ship_to[$y]; ?>
		</td>
		<?php
		}
		?>
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
