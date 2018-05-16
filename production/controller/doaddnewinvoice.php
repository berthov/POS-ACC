<?php
	
  session_start();
  date_default_timezone_set('Asia/Jakarta');      
  include("doconnect.php");

  $user_check = $_SESSION['login_user'];
  include("../query/find_ledger.php");

	$arr = $_REQUEST['arr'];
	$arr1 = $_REQUEST['arr1'];	
	$quant = $_REQUEST['quant'];
	$invoice_id =  date("YmdHis");
	$today =  date("Y-m-d");
	$time = date("H:i:s");
  $month = date("F");
  // $payment_method = $_REQUEST['payment_method'];
  $payment_method = $_POST['payment_method'];
  $created_date =  date("Y-m-d");
  $last_update_date =  date("Y-m-d");
  $type = 'Penjualan';
  
  // ini variable tambahan buat nanti
  $discount = $_REQUEST['discount'];
  $outstanding_status = 'Open';
  $refund_status = 'No';
  $due_date = date('Y-m-d', strtotime($_REQUEST['due_date']));
  //ini sementara dulu. tunggu form tax yang dari page media_gallery.php 
  $tax_code = $_REQUEST['tax_code'];
  $customer_name = $_REQUEST['customer_name'];
   

	// $subtotal = 0;
	// for($x = 0; $x < count($arr); $x++ ){
	// 	if($quant[$x] > 0){	
	// 	$subtotal	+= $arr1[$x];						     	
	// 	}
 //    }
	                  
    $check_outlet = 
    "SELECT o.* FROM employee e, outlet o WHERE e.ledger_id = '".$ledger_new."' and e.name = '".$user_check."' 
    and e.outlet_id = o.name and o.status = 'Active'";
    $result_outlet = mysqli_query($conn,$check_outlet);
    $existing_outlet = mysqli_fetch_assoc($result_outlet);


	/*if ($subtotal <= 0 ){
	echo 	"<script>
		  			alert('Please Input Quantity');
    				window.history.back();
    		</script>";
    	}
    	else{*/
?>

<!--  <table>
	<tr>
		<td>Description</td>
		<td>Unit Price</td>
		<td>Qty</td>
	</tr>
		<?php
	
			for($x = 0; $x < count($arr); $x++ ){
			     	
		?>
	<tr>
		<td>
			<?php echo $arr[$x]; ?>
		</td>
		<td>
			<?php echo $arr1[$x]; ?>
		</td>
		<td>
			<?php echo $quant[$x]; ?>
		</td>
		<?php
		}
		?>
	</tr>

</table> --> 
<html>
    <style type="text/css" media="print">
      @media print {
      @page { margin: 0; }
      body { margin: 1cm; }
    }
    </style>

        <!-- Bootstrap -->
    <link href="../../vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
    
    <!-- Custom styling plus plugins -->
    <link href="../../build/css/custom.css" rel="stylesheet">

<div id="printableArea">
<div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_content">
                    <div class="row">
                      <div class="col-md-4 "></div>
                      <div class="col-md-4">
                        <p align="center"><?php echo $existing_outlet['name']; ?></p>
                        <p align="center"><?php echo $existing_outlet['address']; echo ","; echo $existing_outlet['city']; echo "<br>"; echo $existing_outlet['province']; ?></p>
                        <div class="row">
                          <div class="col-md-6 ">
                            <?php echo $today; ?><br>
                            Receipt Number<br>
                          </div>
                          <div class="col-md-6 pull-right" style="text-align: right;">
                            <?php echo $time; ?><BR>
                            D8WBB7<BR>
                          </div>
                          <div class="clearfix"></div>
                          <hr style="margin-top: 2px;">
                          <div class="col-md-4 " style="text-align: left;">
                          	
                        	<?php
            								for($x = 0; $x < count($arr); $x++ ){

                              $check_item = "SELECT * FROM inventory WHERE ledger_id = '".$ledger_new."' and id = '".$arr[$x]."' ";
                              $result_item = mysqli_query($conn,$check_item);
                              $existing_item = mysqli_fetch_assoc($result_item);

            									if($quant[$x] > 0){							     	
                                echo $existing_item['description'];  echo'<br>';
                              }
                      	   	}
                          ?>

                          </div>
                          <div class="col-md-4 " style="text-align: right;">

                          	<?php
              								for($x = 0; $x < count($arr); $x++ ){
              									if($quant[$x] > 0){							     	
                                  echo $quant[$x]; echo "x"; echo '<br>'; 
                            		}
    	                        }

	                        ?>
                          </div>
                          <div class="col-md-4 pull-right" style="text-align: left;">
                          	
                          	<?php
              								for($x = 0; $x < count($arr); $x++ ){
              									if($quant[$x] > 0){							     	
              							     echo "Rp."; echo number_format($arr1[$x] * $quant[$x]); echo '<br>'; 
                            		}
    	                        }
  	                        ?>

                          </div>
                          <div class="clearfix"></div>
                          <hr style="margin-top: 2px;">
                          <div class="col-md-6">
                          <p>
                            Discount<br>
                            Subtotal<br>
                            Tax</p>
                          </div>
                          <div class="col-md-6 pull-right" style="text-align: right;">

                          <?php
                        		$subtotal = 0;
            								for($x = 0; $x < count($arr); $x++ ){
            									if($quant[$x] > 0){	
            									$subtotal	+= $arr1[$x] * $quant[$x];						     	
              								}
  	                        }
                          
                          echo "Rp."; echo $discount; echo "<br>";
	                        echo "Rp."; echo number_format($subtotal - $discount); echo "<br>";
                          echo "Rp."; echo number_format($tax_code * ($subtotal - $discount)); echo "<br>";
	                        
                          ?>

                          </div>
                          <div class="clearfix"></div>
                          <hr style="margin-top: 2px;">
                          <div class="col-md-6 ">
                          <h4 style="margin-top: -10px;"><b>Total</b></h4>
                          </div>
                          <div class="col-md-6 pull-right" style="text-align: right;">
                          <h4 style="margin-top: -10px;"><b>
                          
                          <?php
                        		$subtotal = 0;
            								for($x = 0; $x < count($arr); $x++ ){
            									if($quant[$x] > 0){	
            									$subtotal	+= $arr1[$x] * $quant[$x];						     	
              								}
  	                        }
	                        echo "Rp."; echo number_format(($subtotal - $discount) + ($tax_code * ($subtotal - $discount))) ; echo "<br>";
	                        ?>

	                    </b></h4>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
</html>






<script type="text/javascript">

      function printDiv(printableArea) {
           var printContents = document.getElementById(printableArea).innerHTML;
           var originalContents = document.body.innerHTML;

           document.body.innerHTML = printContents;

           print();
           setTimeout("closePrintView()", 1000);
           document.body.innerHTML = originalContents;
      }
      function closePrintView() {
        document.location.href = '../media_gallery.php';
    }
      document.getElementById("demo").innerHTML = printDiv('printableArea'); 
</script>

<?php

// HEADER
    // insert header invoice transaction
    $sql_header = "INSERT INTO invoice_header (invoice_id,invoice_number,invoice_date ,due_date,ledger_id,discount_amount,refund_status,outstanding_status , created_by,created_date,last_update_by,last_update_date,payment_method,customer_name,tax_code)
    VALUES ('".$invoice_id."','".$invoice_id."' , '".$today."' , '".$due_date."' , '".$ledger_new."', '".$discount."','".$refund_status."','".$outstanding_status."','".$user_check."','".$created_date."','".$user_check."','".$last_update_date."','".$payment_method."','".$customer_name."','".$tax_code."')";
    mysqli_query($conn, $sql_header);

// LINE
	for($y = 0; $y < count($arr); $y++ ){
		if ($quant[$y] > 0) {    

	 
      	$sql2 = "SELECT * from inventory WHERE id = '".$arr[$y]."'";
	    	$result = mysqli_query($conn, $sql2);

	    	while($row = $result->fetch_assoc()) {
          $cogs[$y] = $row["cogs"];

	    		if ($row["qty"] - $quant[$y] < 0 ){
		    			header("Location:../media_gallery.php?err=2&item=$arr[$y]");
	    		}
	    		else{

            // insert line invoice transaction
	    				$sql = "INSERT INTO invoice (inventory_item_id,unit_price,qty ,date,invoice_id,month,created_by , created_date,last_update_by,last_update_date,ledger_id,tax_code , tax_amount , cogs)
						VALUES ('".$arr[$y]."','".$arr1[$y]."' , '".$quant[$y]."' , '".$today."' , '".$invoice_id."', '".$month."','".$user_check."','".$created_date."','".$user_check."','".$last_update_date."','".$ledger_new."','".$tax_code."','".$tax_code."' * '".$arr1[$y]."' * '".$quant[$y]."' , '".$cogs[$y]."' )";
						mysqli_query($conn, $sql);

            // insert mutasi 
              $sql = "INSERT INTO material_transaction (inventory_item_id, ledger_id,transaction_date,qty,description,created_by , created_date , last_update_by,last_update_date,type)
            VALUES ('".$arr[$y]."', '".$ledger_new."','".$created_date."',('".$quant[$y]."' * -1 ),NULL,'".$user_check."','".$created_date."','".$user_check."','".$created_date."','".$type."')";
            mysqli_query($conn, $sql);
             
					// update stock
		    			$sql1 = "UPDATE inventory SET qty= qty - '".$quant[$y]."' , last_update_date= '".$last_update_date."' ,last_update_by= '".$user_check."' WHERE id = '".$arr[$y]."'";

						mysqli_query($conn, $sql1);

		    		}	
	    	}
		}
		
	}

    
    // insert payment kalau due datenya gak di centang.
    if ($due_date === $today) {

      $sql = "INSERT INTO ar_check_all (invoice_id, payment_number,payment_date,payment_type,payment_amount,created_by , created_date,last_update_by,last_update_date)
      VALUES ('".$invoice_id."', 'Dari Toko' , '".$today."' , '".$payment_method."' , (SELECT (sum(a.qty*a.unit_price) - '".$discount."' ) + (sum(tax_amount) - ('".$discount."' * '".$tax_code."') ) FROM invoice a where a.invoice_id = '".$invoice_id."' and a.ledger_id = '".$ledger_new."'  ) ,'".$user_check."','".$created_date."','".$user_check."','".$last_update_date."')";
      mysqli_query($conn, $sql);

      // update amount_due_original
      $sql_header = "UPDATE invoice_header set amount_due_remaining =  0 , outstanding_status = 'Paid' where invoice_id = '".$invoice_id."'";
      mysqli_query($conn, $sql_header);

    }else{

    // update amount_due_remaining
    $sql_header = "UPDATE invoice_header ih set ih.amount_due_remaining = (select (sum(unit_price*qty) - '".$discount."') + (sum(tax_amount) - ('".$discount."' * '".$tax_code."')) from invoice i where i.invoice_id = ih.invoice_id) where ih.invoice_id = '".$invoice_id."'";
    mysqli_query($conn, $sql_header);
    
    }

	mysqli_close($conn);
?>
