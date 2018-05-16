<?php
session_start();
include("controller/session.php");
include("controller/doconnect.php");

$invoice_id = $_REQUEST['invoice_id'];
$user_check = $_SESSION['login_user'];

include ("query/find_ledger.php");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">


    <!-- jQuery custom content scroller -->
    <link href="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

    
    <!-- Custom styling plus plugins -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <style type="text/css" media="print">
      @media print {
      @page { margin: 0; }
      body { margin: 1cm; }
    }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">

        <!-- Sidebar Menu -->
        <?php include("view/sidebar.php"); ?>
        <!-- End Of Sidebar  -->
        
        <!-- Top Navigation -->
        <?php include("view/top_navigation.php"); ?>
        <!-- End Of Top Navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Sales Invoice </h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>SI Design</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <section class="content invoice" id="printableArea">
                      <!-- title row -->
                      <div class="row">
                        
                    <?php

                    $sql = "SELECT *  
                    FROM invoice_header ih,
                    employee e,
                    outlet o
                    where
                    e.name = ih.created_by
                    and e.outlet_id = o.name
                    and e.ledger_id = o.ledger_id
                    and ih.invoice_id = '".$invoice_id."'
                    ";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                    ?>

                        <div class="col-lg-12 col-md-12 col-xs-12 invoice-header">
                          <h1>
                                          <i class="fa fa-globe"></i> Sales Invoice.
                                          <small class="pull-right">Date: <?php  echo $row['invoice_date']; ?></small>
                                      </h1>
                        </div>                        
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-lg-1 col-md-1 col-sm-1 invoice-col">
                          From :
                          <address>
                                          <strong><?php  echo $row['name']; ?></strong>
                                          <br><?php  echo $row['address']; ?>
                                          <br><?php  echo $row['city']; ?>
                                          <br><?php  echo $row['province']; ?>
                                          <br><?php  echo $row['email']; ?>
                          </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-lg-1 col-md-1 col-sm-1 invoice-col">
                          To :
                          <address>
                                          <strong><?php  echo $row['customer_name']; ?></strong>
                                          <br><?php  echo $row['address']; ?>
                                          <br><?php  echo $row['city']; ?>
                                          <br><?php  echo $row['province']; ?>
                                          <br><?php  echo $row['email']; ?>
                          </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-lg-4 col-md-4 col-sm-4 invoice-col">
                          <br>
                          <b>Order ID:</b> <?php  echo $row['invoice_id']; ?>
                          <br>
                          <b>Payment Due:</b> <?php  echo $row['due_date']; ?>
                          <br>
                          <b>Invoice Number:</b> <?php  echo $row['invoice_number']; ?>
                        </div>
                        <!-- /.col -->
                      </div>

                    <?php

                     }
                  
                    ?>

                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Qty</th>
                                <th>Item Code</th>
                                <th style="width: 59%">Item Name</th>
                                <!-- <th style="width: 59%">Description</th> -->
                                <th>Price</th>
                                <th>Subtotal</th>
                              </tr>
                            </thead>
                            <tbody>
                              <!-- DETAIL ROW -->
                            <?php

                            $sql = "SELECT 
                            i.qty , 
                            inv.item_code , 
                            inv.description , 
                            i.unit_price   
                            FROM invoice i,
                            inventory inv
                            where  
                            i.invoice_id = '".$invoice_id."'
                            and i.inventory_item_id = inv.id
                            and i.ledger_id = inv.ledger_id
                            ";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {
                                                             
                            ?>

                              <tr>
                                <td><?php  echo $row['qty']; ?></td>
                                <td><?php  echo $row['item_code']; ?></td>
                                <td><?php  echo $row['description']; ?></td>
                                <!-- <td>El snort testosterone trophy driving gloves handsome gerry Richardson helvetica tousled street art master testosterone trophy driving gloves handsome gerry Richardson
                                </td> -->
                                <td><?php  echo $row['unit_price']; ?></td>
                                <td><?php  echo ($row['qty'] * $row['unit_price'] ); ?></td>
                              </tr>

                            <?php
                            
                            }

                            ?>
                            <!-- END OF DETAIL ROW -->
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-lg-6 col-md-6 col-xs-6">
<!--                           <p class="lead">Payment Methods:</p>
                          <img src="images/visa.png" alt="Visa">
                          <img src="images/mastercard.png" alt="Mastercard">
                          <img src="images/american-express.png" alt="American Express">
                          <img src="images/paypal.png" alt="Paypal">
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris
                          </p> -->
                        </div>
                        <!-- /.col -->
                        <div class="col-lg-6 col-md-6 col-xs-6">
                          <p class="lead"><div class="clearfix"></div></p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>

                                <?php

                                $sql = "SELECT 
                                sum(i.qty* i.unit_price) -
                                (
                                select sum(ih_1.discount_amount)
                                from invoice_header ih_1
                                where 
                                ih_1.invoice_id = i.invoice_id
                                and ih_1.refund_status not in ('Yes')) as sub_total , 
                                i.tax_code,
                                sum(i.tax_amount) -
                                (select sum(ih_1.discount_amount*ih_1.tax_code)
                                from invoice_header ih_1
                                where 
                                ih_1.invoice_id = i.invoice_id
                                and ih_1.refund_status not in ('Yes')) as tax_amount,
                                (
                                select sum(ih_1.discount_amount)
                                from invoice_header ih_1
                                where 
                                ih_1.invoice_id = i.invoice_id
                                and ih_1.refund_status not in ('Yes')) discount_amount
                                FROM invoice i,
                                inventory inv
                                where  
                                i.invoice_id = '".$invoice_id."'
                                and i.inventory_item_id = inv.id
                                and i.ledger_id = inv.ledger_id
                                group by
                                i.tax_code
                                ";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc()) {
                                                                 
                                ?>

                                <tr>
                                  <th>Discount :</th>
                                  <td>Rp <?php  echo number_format($row['discount_amount']); ?></td>
                                </tr>
                                <tr>
                                  <th style="width:50%">Subtotal :</th>
                                  <td>Rp.<?php  echo number_format($row['sub_total']); ?></td>
                                </tr>
                                <tr>
                                  <th>Tax (<?php  echo ($row['tax_code'])*100; ?>%) :</th>
                                  <td>Rp <?php  echo number_format($row['tax_amount']); ?></td>
                                </tr>
                                <tr>
                                  <th>Total :</th>
                                  <td>Rp <?php  echo number_format($row['sub_total'] + $row['tax_amount']); ?></td>
                                </tr>

                                <?php
                                
                                }

                                ?>

                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </section>
                      <!-- this row will not appear when printing -->
                       <div class="row no-print">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                         <button class="btn btn-success pull-right" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button></a>
                          <button class="btn btn-primary pull-right" style="margin-right: 5px;" onclick="savePdf('printableArea')"><i class="fa fa-download"></i> Generate PDF</button>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php include("view/footer.php"); ?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <!-- PDFMaker --> 
    <script src="../vendors/pdfmake/build/pdfFromHTML.js"></script>
    <script src="../vendors/pdfmake/build/jspdf.js"></script> 



    <!-- jQuery custom content scroller -->
    <script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

<!--     <script type="../vendors/pdfmake/build/jquery-2.1.3.js"></script> -->

    <!-- JavaScript -->
        <script type="text/javascript">

      function printDiv(divName) {
           var printContents = document.getElementById(divName).innerHTML;
           var originalContents = document.body.innerHTML;

           document.body.innerHTML = printContents;

           window.print();
           document.body.innerHTML = originalContents;
          
           document.location.href = 'tables_invoice.php';


      }
    </script>

  </body>
</html>



