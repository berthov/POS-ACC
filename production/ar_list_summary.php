<?php
include("controller/doconnect.php");
session_start();
include("controller/session.php");
include("query/find_ledger.php");
include("query/redirect_billing.php");

$start_date= $_REQUEST['start_date']; 
$end_date= $_REQUEST['end_date'];
$p_outlet = $_REQUEST['outlet_id'];


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bonne Journée!</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome-2/css/all.css" rel="stylesheet"> 
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

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
                <h3>AR List Summary</h3>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <!-- YANG DI PAKE -->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>Filtered From <?php echo date('d-M-Y', strtotime($start_date));?> To <?php echo date('d-M-Y', strtotime($end_date));?></h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      
                    </p>
          
                    <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Invoice Number</th>
                          <th>Invoice Date</th>
                          <th>Due Date</th>
                          <th>Customer Name</th>
                          <th>Payment Method</th>
                          <!-- <th>Discount</th> -->
                          <th>Invoice Amount</th>
                          <!-- <th>Tax</th> -->
                          <th>Refund</th>
                          <th>Status</th>
                          <th>Outlet</th>
                        </tr>
                      </thead>
                      <tbody>

                         <?php                 

                            $sql = "SELECT 
                            ih.invoice_number,
                            ih.invoice_date,
                            ih.due_date, 
                            ih.customer_name as customer_name,
                            ih.discount_amount, 
                            ih.payment_method,
                            ih.refund_status,
                            sum(i.unit_price*i.qty) as total,
                            sum(i.tax_amount) as tax,
                            ih.outstanding_status,
                            o.name
                            FROM invoice_header ih,
                            invoice i,
                            outlet o 
                            WHERE
                            ih.ledger_id = '".$ledger_new."'
                            and (ih.outlet_id = '".$p_outlet."' or  ('".$p_outlet."' = '' ) ) 
                            and ih.invoice_id = i.invoice_id
                            and date_format(ih.invoice_date,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'
                            and o.outlet_id = ih.outlet_id
                            group by 
                            ih.invoice_number,
                            ih.invoice_date,
                            ih.due_date,
                            ih.customer_name,
                            ih.discount_amount, 
                            ih.payment_method,
                            ih.refund_status,
                            ih.outstanding_status,
                            o.name
                            ";

                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {                      
                         ?>

                        <tr>
                          <td>
                            <?php echo $row['invoice_number']; ?>
                          </td>
                          <td>
                            <?php echo date('d-M-Y', strtotime($row['invoice_date'])) ?>
                          </td>
                          <td>
                            <?php echo date('d-M-Y', strtotime($row['due_date'])) ?>
                          </td>
                          <td>
                            <?php echo $row['customer_name']; ?>
                          </td>
                          <td>
                            <?php echo $row['payment_method']; ?>
                          </td>
<!--                           <td>
                            <?php echo $row['discount_amount']; ?>
                          </td> -->
                          <td>
                            <?php echo number_format($row['total']); ?>
                          </td>
                          <!-- <td>
                            <?php echo number_format($row['tax']); ?>
                          </td> -->
                          <td>
                            <?php echo $row['refund_status']; ?>
                          </td>
                          <td>
                            <?php echo $row['outstanding_status']; ?>
                          </td>
                          <td>
                            <?php echo $row['name']; ?>
                          </td>
                        </tr> 

                        <?php
                          }        
                        ?>  

                      </tbody>
                    </table>
                 
                  </div>
                </div>



                 <form class="form-horizontal" action="controller/export_index_csv.php?start_date=<?=$start_date?>&end_date=<?=$end_date?>&p_outlet=<?=$p_outlet?>" method="post" name="ar_list_summary" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="singlebutton">Excel Export</label>
                    <div class="col-md-4">
                        <input type="submit" name="ar_list_summary" class="btn btn-success" value="Export to excel"/>
                    </div>
                  </div>                    
                </form>
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
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

  </body>
</html>