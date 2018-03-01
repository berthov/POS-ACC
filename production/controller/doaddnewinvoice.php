<?php
	
	include("doconnect.php");
	date_default_timezone_set('Asia/Jakarta');			
	$arr = $_REQUEST['arr'];
	$arr1 = $_REQUEST['arr1'];	
	$quant = $_REQUEST['quant'];
	$invoice_id =  date("YmdHis");
	$today =  date("y-m-d H:i:s");
	$time = date("H:i:s");
  $month = date("F");
  // $payment_method = $_REQUEST['payment_method'];
  $payment_method = $_POST['payment_method'];

	$subtotal = 0;
	for($x = 0; $x < count($arr); $x++ ){
		if($quant[$x] > 0){	
		$subtotal	+= $arr1[$x];						     	
		}
    }
	                  
	if ($subtotal <= 0 ){
	echo 	"<script>
		  			alert('Please Input Quantity');
    				window.history.back();
    		</script>";
    	}
    	else{
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
                        <p align="center">CaseNation.Indo</p>
                        <p align="center">Jln. Marina Raya Ruko Exclusive</p>
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
									if($quant[$x] > 0){							     	
							?>

                            <?php echo $arr[$x]; ?><br>
                            <?php
                        		}
	                        }
	                        ?>

                          </div>
                          <div class="col-md-4 " style="text-align: right;">

                          	<?php
								for($x = 0; $x < count($arr); $x++ ){
									if($quant[$x] > 0){							     	
							?>

                            <?php echo $quant[$x]; ?>x<br>
                            <?php
                        		}
	                        }
	                        ?>
                          </div>
                          <div class="col-md-4 pull-right" style="text-align: left;">
                          	
                          	<?php
								for($x = 0; $x < count($arr); $x++ ){
									if($quant[$x] > 0){							     	
							?>

                            Rp.<?php echo $arr1[$x] * $quant[$x] ; ?><br>
                            <?php
                        		}
	                        }
	                        ?>

                          </div>
                          <div class="clearfix"></div>
                          <hr style="margin-top: 2px;">
                          <div class="col-md-6">
                          <p>Subtotal</p>
                          </div>
                          <div class="col-md-6 pull-right" style="text-align: right;">

                          <?php
                          		$subtotal = 0;
								for($x = 0; $x < count($arr); $x++ ){
									if($quant[$x] > 0){	
									$subtotal	+= $arr1[$x] * $quant[$x];						     	
								}
	                        }
	                        echo "Rp."; echo $subtotal; echo "<br>";
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
	                        echo "Rp."; echo $subtotal; echo "<br>";
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


            <?php
        }
        ?>




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
	for($y = 0; $y < count($arr); $y++ ){
		if ($quant[$y] > 0) {    

	    	$sql2 = "SELECT * from inventory WHERE description = '".$arr[$y]."'";
	    	$result = mysqli_query($conn, $sql2);
	    	while($row = $result->fetch_assoc()) {
	    		if ($row["qty"] - $quant[$y] < 0 ){
		    			header("Location:../media_gallery.php?err=2&item=$arr[$y]");
	    		}
	    		else{
	    				$sql = "INSERT INTO invoice (description,unit_price,qty ,date,invoice_id,month,payment_method)
						VALUES ('".$arr[$y]."','".$arr1[$y]."' , '".$quant[$y]."' , '".$today."' , '".$invoice_id."', '".$month."','".$payment_method."')";
						mysqli_query($conn, $sql);
					
		    			$sql1 = "UPDATE inventory SET qty= qty - '".$quant[$y]."' WHERE description = '".$arr[$y]."'";
							if (mysqli_query($conn, $sql1)) {
							   /* echo $y , "New row has been insert successfully <br>";*/
							    /*header("Location:../media_gallery.php");*/
							} 
							else {
				 			   echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
							}
		    		}	
	    	}
		}
		
	}

		mysqli_close($conn);
?>