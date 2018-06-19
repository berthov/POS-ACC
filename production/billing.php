<!DOCTYPE html>
<?php
include("controller/doconnect.php");
session_start();
include("controller/session.php");
include("query/find_ledger.php");
?>
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
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>


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
                <h3>BILLING</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Outlet</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  
                  <?php
                    $sql = "SELECT *
                    from outlet
                    where
                    ledger_id = '".$ledger_new."'
                    ";

                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                  ?>

                  <p class="lead">Additional Info :</p>
                  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                  <strong><?php echo $row['name']; ?></strong><br>
                  Valid Until : <strong><?php echo $row['expiration_date']; ?></strong><br>
                  Status : <strong><?php echo $row['status']; ?></strong><br>
                  Billing Status : <strong><?php echo $row['billing_status']; ?></strong>
                  </p>

                  <?php
                  
                  }

                  ?>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Status</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  
                  <p class="lead">Outlets :</p>
                  
                  <?php
                    $sql = "SELECT *
                    from outlet
                    where
                    ledger_id = '".$ledger_new."'
                    and billing_status = 'Trial'
                    and status = 'Active'
                    ";

                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                  ?>
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                    <h4><strong><?php echo $row['name']; ?></strong></h4>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                    <h4><strong>Rp. 200.000 / Mon</strong></h4>
                    </div>
                  </div>
                  <?php
                  
                  }

                  ?>

                  </p>
                  <div class="x_title">
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <h4><strong>12 Month Subscription Total</strong></h4>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6" align="right">

                      <?php
                      $sql = "SELECT count(outlet_id) as outlet
                      from outlet
                      where
                      ledger_id = '".$ledger_new."'
                      and status = 'Active'
                      and billing_status = 'Trial'
                      ";

                      $result = $conn->query($sql);
                      while($row = $result->fetch_assoc()) {
                      ?>

                        <h4><strong>Rp. <?php echo number_format($row['outlet'] * 200000 *12) ; ?>/ Mon</strong></h4>

                      <?php

                      }

                      ?>

                      </div>
                      Your activation will be extended when your payment already verified
                      <div class="col-md-12 col-xl-12 col-xs-12" align="center">
                        <button style="margin-top: 20px; width: 100%" class="btn btn-round btn-primary">Pay</button>
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
       
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
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
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
	 
       <script src="../production/common/error.js"></script>


  </body>
</html>