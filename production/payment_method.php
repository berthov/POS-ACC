<?php
session_start();
include("controller/session.php");
?>

<!DOCTYPE html>
<html lang="en">
<?php
include("controller/doconnect.php");
$p_start_date = date('Y-m-d');
$p_end_date = date('Y-m-d');
if(isset($_REQUEST['reservation'])){
  $p_start_date = date('Y-m-d',strtotime(substr($_REQUEST['reservation'], 1,10))) ;
}

if(isset($_REQUEST['reservation'])){
  $p_end_date = date('Y-m-d',strtotime(substr($_REQUEST['reservation'], 14,10))) ;
}
?>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bonne Journée </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
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
            <div class="row">
              <div class="col-md-10 col-sm-10 col-xs-12">
                <div class="x_panel">
                 <div class="row x_title"> 
                   <div class="col-md-4">
                      <h2>Payment Method</h2>
                      <div class="clearfix"></div>
                    </div>
                   <div class="col-md-6">
                          <form class="form-horizontal">
                            <fieldset>
                              <div class="control-group" >
                                <div class="controls" >
                                  <div class="input-prepend input-group">
                                    <input type="text" style="width: 200px" name="reservation" id="reservation" class="form-control pull-right"/>
                                    <span class="add-on input-group-addon">
                                      <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                  </div>
                                </div>
                              </div>
                            </fieldset>
                    </div>
                                                            <div class="col-md-2">
                      <input type="submit" name="submit"  class="btn btn-round btn-primary pull-right"/>
                    </div>
                  </div>
 
                  <div class="x_content">
                    <table class="table ">
                      <tbody>
                        <tr>
                          <td align="left">Payment method</td>
                          <td align="center">Number Of Transaction</td>
                          <td align="right">Total Collected</td>
                        </tr>
                        <tr>
                          <td align="left">Cash</td>
                          <td align="center">
                            <?php

                             $cash = "Cash";

                            $sql1 = "SELECT count(a.invoice_id) as count
                            FROM invoice a
                            where
                            a.invoice_line_id = (select max(b.invoice_line_id)
                            from invoice b
                            where b.invoice_id = a.invoice_id)
                            and a.payment_method = '".$cash."'
                            and date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                            ";
                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {                                                               
                              echo $row1['count'];
                          }
                          ?>
                          </td>
                          <td align="right">Rp.
                                                      <?php

                            $cash = "Cash";

                            $sql1 = "SELECT sum(a.qty*a.unit_price) as count
                            FROM invoice a
                            where
                            a.payment_method = '".$cash."'
                            and date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                            ";
                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {                                                               
                              echo number_format($row1['count']);
                          }
                          ?>
                            
                          </td>
                        </tr>
                        <tr>
                          <td align="left">Debit / Credit</td>
                          <td align="center">
                            <?php
                            $Credit_Debit = "Debit/Credit";

                            $sql1 = "SELECT count(a.invoice_id) as count
                            FROM invoice a
                            where
                            a.invoice_line_id = (select max(b.invoice_line_id)
                            from invoice b
                            where b.invoice_id = a.invoice_id)
                            and a.payment_method = '".$Credit_Debit."'
                            and date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                            ";
                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {                                                               
                              echo $row1['count'];
                          }
                            ?>
                          </td>
                          <td align="right">Rp.
                                                                                <?php

                            $Credit_Debit = "Debit/Credit";

                            $sql1 = "SELECT sum(a.qty*a.unit_price) as count
                            FROM invoice a
                            where
                            a.payment_method = '".$Credit_Debit."'
                            and date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                            ";
                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {                                                               
                              echo number_format($row1['count']);
                          }
                          ?></td>
                        </tr>
                        <tr>
                          <td align="left"><b>Total</b></td>
                          <td align="center"><b>
                            <?php
                            $sql1 = "SELECT count(a.invoice_id) as count
                            FROM invoice a
                            where
                            a.invoice_line_id = (select max(b.invoice_line_id)
                            from invoice b
                            where b.invoice_id = a.invoice_id)
                            and date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                            ";
                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {                                                               
                              echo $row1['count'];
                          }
                          ?>
                          </b></td>
                          <td align="right"><b>Rp.
                            <?php
                            $sql1 = "SELECT sum(a.qty*a.unit_price) as count
                            FROM invoice a
                            where
                            date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                            ";
                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {                                                               
                              echo number_format($row1['count']);
                          }
                          ?></b></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Bonne Journée! - Admin DashBoard by Bernard Thoven
          </div>
          <div class="clearfix"></div>
        </footer>
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
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
  </body>
</html>