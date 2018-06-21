<?php
session_start();
include("controller/session.php");
include("controller/doconnect.php");
include("query/find_ledger.php");
include("query/redirect_billing.php");

$po_header_id = $_REQUEST['po_header_id'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bonne Journée! </title>

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
        <?php
          if ($_SESSION['userRole'] == "Staff"){
            session_destroy(); 

            session_start();
            $logout = true;
            $_SESSION['logout'] = $logout;
            
            header("location: login.php"); 
          } else if ($_SESSION['userRole'] == "Admin") {
            include("view/sidebar.php");
          }
        ?>
        <!-- End Of Sidebar  -->
        
        <!-- Top Navigation -->
        <?php include("view/top_navigation.php"); ?>
        <!-- End Of Top Navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Purchase Invoice </h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Template Design</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <section class="content invoice" id="printableArea">
                      <!-- title row -->
                      <div class="row">
                        
                    <?php

                    $sql = "SELECT *  
                    FROM po_header_all poh,
                    outlet o,
                    ap_supplier_all asa
                    where
                    poh.outlet_id = o.outlet_id  
                    and asa.party_id = poh.supplier
                    and poh.po_header_id = '".$po_header_id."'
                    ";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                    $po_due = $row['due_date'];       
                    ?>

                        <div class="col-lg-12 col-md-12 col-xs-12 invoice-header">
                          <h1>
                                          <i class="fa fa-globe"></i> Purchase Invoice.
                                          <small class="pull-right">Date: <?php  echo $row['po_date']; ?></small>
                                      </h1>
                        </div>                        
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-lg-2 col-md-2 col-sm-2 invoice-col">
                          From
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
                          To
                          <address>
                                          <strong><?php  echo $row['supplier_name']; ?></strong>
                                          <br><?php  echo $row['supplier_site']; ?>
                          </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <br>
                          <b>Invoice Number:</b> <?php  echo $row['po_header_id']; ?>
                          <br>
                          <b>Invoice Due:</b> <?php  echo $row['due_date']; ?>
                        </div>
                        <!-- /.col -->
                      </div>

                    <?php

                     }
                  
                    ?>

                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Qty</th>
                                <th>Item Code</th>
                                <th style="width: 59%">Item Name</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                              </tr>
                            </thead>
                            <tbody>
                              <!-- DETAIL ROW -->
                            <?php

                            $sql = "SELECT pol.qty , i.item_code , i.description , pol.price   
                            FROM po_line_all pol,
                            inventory i
                            where  
                            pol.po_header_id = '".$po_header_id."'
                            and i.ledger_id = '".$ledger_new."'
                            and i.id = pol.inventory_item_id
                            ";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {
                                                             
                            ?>

                              <tr>
                                <td><?php  echo $row['qty']; ?></td>
                                <td><?php  echo $row['item_code']; ?></td>
                                <td><?php  echo $row['description']; ?></td>
                                <td><?php  echo number_format($row['price']); ?></td>
                                <td><?php  echo number_format(($row['qty'] * $row['price'] )); ?></td>
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
                        <div class="col-xs-6">
                          <p class="lead">Additional Info:</p>
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            <?php

                            $user_check_ledger = "SELECT po_description  FROM po_header_all WHERE po_header_id = '".$po_header_id."'"; 
                            $result_ledger = mysqli_query($conn,$user_check_ledger);
                            $existing_ledger = mysqli_fetch_assoc($result_ledger);

                            echo $existing_ledger['po_description'];

                            ?>
                          </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <p class="lead"></p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>

                                <?php
                                $sql = "SELECT sum(pol.qty*pol.price) as subtotal,
                                asa.tax
                                from po_header_all poh,
                                po_line_all pol,
                                ap_supplier_all asa
                                where
                                pol.po_header_id = poh.po_header_id
                                and poh.supplier = asa.party_id
                                and poh.ledger_id = asa.ledger_id
                                and poh.ledger_id = '".$ledger_new."'
                                and poh.po_header_id =  '".$po_header_id."'
                                group by 
                                asa.tax";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc()) {


                                ?>
                                <tr>
                                  <th style="width:50%">Subtotal:</th>
                                  <td>Rp <?php  echo number_format($row['subtotal']); ?></td>
                                </tr>
                                <tr>
                                  <th>Tax (<?php  echo $row['tax']*100; ?> %)</th>
                                  <td>Rp <?php  echo number_format(($row['subtotal']*$row['tax'])); ?></td>
                                </tr>
                                <tr>
                                  <th>Grand Total:</th>
                                  <td>Rp <?php  echo number_format($row['subtotal'] + ($row['subtotal']*$row['tax'])); ?></td>
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
      }
    </script>
  </body>
</html>



