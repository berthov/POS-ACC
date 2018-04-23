<?php
session_start();
include("controller/session.php");
include("controller/doconnect.php");

$invoice_id = $_REQUEST['invoice_id'];

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
    <link href="../vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- jQuery custom content scroller -->
    <link href="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
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
                <h3>Invoice Status</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Invoice Header</h2> 
                    <div class="clearfix"></div>
                  </div>
                  <form class="form-horizontal form-label-left input_mask" method="POST" action="controller/doaddpayment_invoice.php">      
                  <div class="x_content">
                    <br />                      
                  <?php

                    $sql = "SELECT ih.invoice_number, ih.invoice_date , ih.customer_name , ih.due_date , ih.discount_amount ,ih.amount_due_remaining, sum(i.qty*i.unit_price) as total
                    FROM invoice_header ih,
                    invoice i
                    where
                    ih.invoice_id = '".$invoice_id."'
                    and ih.invoice_id = i.invoice_id
                    group by 
                    ih.invoice_number, ih.invoice_date , ih.customer_name , ih.due_date , ih.discount_amount
                    ";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                  ?>
                      <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12">Invoice Number</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" class="form-control" name="invoice_number" placeholder="<?php echo $row["invoice_number"] ?>" disabled="disabled">
                        </div>

                        <label class="col-md-2 col-sm-2 col-xs-12">Invoice Date</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" class="form-control" name="invoice_date" placeholder="<?php echo $row["invoice_date"] ?>" disabled="disabled">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12">Customer Name</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" class="form-control" name="customer_name" placeholder="<?php echo $row["customer_name"] ?>" disabled="disabled">
                        </div>

                        <label class="col-md-2 col-sm-2 col-xs-12">Due Date</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" class="form-control" placeholder="<?php echo $row["due_date"] ?>" name="due_date" disabled="disabled">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12">Invoice Amount</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" class="form-control" name="total" placeholder="<?php echo $row["total"] ?>" disabled="disabled">
                        </div>

                        <label class="col-md-2 col-sm-2 col-xs-12">Discount</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" class="form-control" placeholder="<?php echo $row["discount_amount"] ?>" name="discount_amount" disabled="disabled">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12">Outsanding</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" class="form-control" placeholder="<?php echo $row["amount_due_remaining"] ?>"    name="outstanding" disabled="disabled">
                        </div>
                      </div>

                      <?php 
                      
                      }
                      
                      ?>

                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                          <div class="x_title">
                            <h2><i class="fa fa-align-left"></i> Payment History <small>Sub-Title</small></h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">

                            <!-- PO LINE  -->
                            <div class="panel-body">
                              <div class="panel panel-default" style="padding-top: 20px;  border: 0px;">                                                 
                              <div class="table-responsive" >
                                <table class="table table-striped jambo_table bulk_action">
                                  <thead>
                                    <tr class="headings">
                                      <th class="column-title">#</th>
                                      <th class="column-title">Payment Number </th>
                                      <th class="column-title">Payment Date </th>
                                      <th class="column-title">Payment Type </th>
                                      <th class="column-title">Amount </th>
                                    </tr>
                                  </thead>

                                  <tbody>
                                  <!-- QUERY UNTUK PAYMENT DETAIL BERDASARKAN Invoice ID  -->
                                    <?php
                                    $sql_payment = 
                                    "SELECT * 
                                    FROM
                                    AR_CHECK_ALL ACA
                                    where
                                    ACA.INVOICE_ID = '".$invoice_id."'
                                    ";

                                    $result_payment = $conn->query($sql_payment);
                                    while($row_payment = $result_payment->fetch_assoc()) {

                                    ?>
                                  
                                    <tr">
                                      <td>#</td>
                                      <td><?php echo $row_payment["payment_number"] ?></td>
                                      <td><?php echo date('d-M-Y', strtotime($row_payment["payment_date"])); ?></td>
                                      <td><?php echo $row_payment["payment_type"] ?></td>
                                      <td><?php echo $row_payment["payment_amount"] ?></td>
                                    </tr>
                                  
                                  <?php
                                  
                                  }
                                  
                                  ?>
                                  <!-- END OF QUERY -->
                                  </tbody>
                                </table>
                              </div>

                              <div class="clear"></div>    
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                          <div class="x_title">
                            <h2><i class="fa fa-align-left"></i> Payment <small>Sub-Title</small></h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">

                            <!-- PO LINE  -->
                            <div class="panel-body">
                              <div class="panel panel-default" style="padding-top: 20px;  border: 0px;">            
                              <div class="table-responsive" >
                                <table class="table" id="myTable">
                                  <tr>
                                    <th>Payment Number</th>
                                    <th>Payment Date</th>
                                    <th>Payment Type</th>
                                    <th>Amount</th>
                                    <th></th>
                                  </tr>
                                  <tr>
                                    <td><input type="text" class="form-control" name="payment_number"></td>
                                    <!-- <td><input type="text" class="form-control" name="payment_date"></td> -->
                                    <td>
                                      <fieldset>
                                        <div class="control-group">
                                          <div class="controls">
                                            <div class="col-md-12 xdisplay_inputx form-group has-feedback">
                                              <input type="text" class="form-control has-feedback-left" id="single_cal3" placeholder="Date" aria-describedby="inputSuccess2Status3" name="payment_date">
                                              <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                              <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                                            </div>
                                          </div>
                                        </div>
                                      </fieldset>
                                    </td>
                                    <td>
                                     <div class="form-group">
                                        <select class="form-control" name="payment_type">
                                          <option value="Cash">Cash</option>
                                          <option value="Giro/Check">Giro/Check</option>
                                        </select>
                                      </div>
                                    </td>
                                    <td><input type="text" class="form-control" name="payment_amount"></td>
                                    <td><input type="hidden" name="invoice_id" value="<?php echo $invoice_id; ?>"></td>
                                  </tr>
                                </table>
                              </div>

                              <div class="clear"></div>    
                              </div>
                            </div>
                            <!-- END OF PO LINE -->
                          </div>
                        </div>
                      </div>
                    </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12" align="center">
						              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
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
    <script src="../vendors/bootstrap/dist/js/bootstrap.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

        <!-- jQuery custom content scroller -->
    <script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

  </body>
</html>


