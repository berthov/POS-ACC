<?php
include("controller/doconnect.php");
session_start();
include("controller/session.php");
include("query/find_ledger.php");
include("query/redirect_billing.php");
include("common/modal.html");
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

        <!-- Toastr -->
    <link rel="stylesheet" href="../vendors/toastr/toastr.min.css">
    <script src="../vendors/toastr/jquery-1.9.1.min.js"></script>
    <script src="../vendors/toastr/toastr.min.js"></script>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- jQuery custom content scroller -->
    <link href="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>

    <script src="../production/controller/refund.js"></script>
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
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>PO Listing</h3>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_title">
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <!-- start project list -->
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 20%">Invoice Number</th>
                          <th>Invoice Date</th>
                          <th>Due Date</th>
                          <th>Customer Name</th>
                          <th>Amount Discount</th>
                          <th>Refund Status</th>
                          <th>Outlet</th>
                          <th>Outstanding Status</th>
                          <th style="width: 20%">#Edit</th>
                        </tr>
                      </thead>
                      <tbody>

                         <?php
                            $sql = "SELECT ih.*,o.name
                            FROM invoice_header ih,
                            outlet o
                            WHERE
                            ih.ledger_id = '".$ledger_new."'
                            and o.ledger_id = ih.ledger_id                              
                            and o.outlet_id = ih.outlet_id";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {                      
                         ?>

                        <tr>
                          <td>#</td>
                          <td>
                            <a><?php echo $row['invoice_number']; ?></a>
                          </td>
                          <td>
                            <?php echo $row['invoice_date']; ?>
                          </td>
                          <td>
                            <?php echo $row['due_date']; ?>
                          </td>
                          <td>
                            <?php echo $row['customer_name']; ?>
                          </td>
                          <td>
                            <?php echo $row['discount_amount']; ?>
                          </td>
                          <td>
                            <?php echo $row['refund_status']; ?>
                          </td>
                          <td>
                            <?php echo $row['name']; ?>
                          </td>
                          <td>
                            <a href="payment_invoice.php?invoice_id=<?php echo $row["invoice_id"]?>"><button type="button" class="btn btn-success btn-xs"><?php echo $row['outstanding_status']; ?></button></a>
                          </td>
                          <td>
                            <a href="template_invoice.php?invoice_id=<?php echo $row["invoice_id"]?>" class="btn btn-primary btn-xs" ><i class="fa fa-folder"></i> View </a>


                            <!-- <a id="ahref1" href="controller/refund_invoice.php?invoice_id=<?php echo $row["invoice_id"]?>" class="btn btn-danger btn-xs btnrefund" data-id=<?php echo $row['invoice_id']; ?>><i class="fa fa-pencil"></i> Refund </a> -->


                            <button data-toggle="modal" type="button" data-target="#modalRefund" class="btn btn-danger btn-xs btnrefund" data-id=<?php echo $row['invoice_id']; ?>><i class="fa fa-pencil"></i> Refund 
                            </button> 
                          </td>
                        </tr> 


 
                        <?php
                          }        
                        ?>  

                      </tbody>

                    </table>
                    <!-- end project list -->

                  </div>
              </div>
                <div class="col-md-12 col-sm-12 col-xs-12"> 
                  <form class="form-horizontal" action="controller/export_index_csv.php" method="post" name="inventory" enctype="multipart/form-data">
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="singlebutton">Excel Export</label>
                      <div class="col-md-4">
                          <input type="submit" name="export_table_invoice" class="btn btn-success" value="Export to excel"/>
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

    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
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
    <script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
  
  </body>
</html>

