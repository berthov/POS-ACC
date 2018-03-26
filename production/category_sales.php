<?php
session_start();
include("controller/session.php");
?>

<!DOCTYPE html>
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
<html lang="en">
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
              <div class="col-md-12 col-sm-12 col-xs-12">
                
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Category Sales</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    Gross Profit
                    To report gross profit accurately per category, please make sure all items have a COGS.
                  </div>
                </div>
                <div class="x_panel">
                 <div class="row x_title"> 
                   <div class="col-md-4">
                      <h2>Category Sales</h2>
                      <div class="clearfix"></div>
                    </div>
                   <div class="col-md-12">
                          <form class="form-horizontal" action="category_sales.php" method="post">
                            <fieldset >
                              <div class="control-group" >
                                <div class="controls" >
                                  <div class="input-prepend input-group">
                                    <input type="text" style="width: 200px" name="reservation" id="reservation" class="form-control pull-right" />
                                    <span class="add-on input-group-addon">
                                      <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                  </div>
                                </div>
                              </div>
                            </fieldset>
                    </div>
                  </div>

                  <div class="x_content">
                    <table class="table ">
                      <tbody>
                        <tr>
                          <th>Category</th>
                          <th>Item Sold</th>
                          <th>Gross Sales</th>
                          <th>Discount</th>
                          <th>Refund</th>
                          <th>Net Sales</th>
                          <th>COGS</th>
                          <th>Gross Profit</th>
                          <th>Gross Margin</th>
                        </tr>

                        <?php
                            $sql1 = "SELECT sum(a.qty*a.unit_price) as gross_sales , sum(a.qty) as qty , a.description , sum(b.hpp * a.qty) as cogs , sum(a.qty*a.unit_price) - sum(b.hpp * a.qty) as gross_profit 
                            FROM invoice a,
                            inventory b
                            where a.description = b.description
                            and date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                            group by a.description
                            ";
                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {                                                               
                              ?>

                        <tr>
                          <td><?php echo $row1['description'];?></td>
                          <td><?php echo $row1['qty'];?></td>
                          <td>Rp.<?php echo number_format($row1['gross_sales']);?></td>
                          <td>0</td>
                          <td>0</td>
                          <td>Rp.<?php echo number_format($row1['gross_sales']);?></td>
                          <td>Rp.<?php echo number_format($row1['cogs']);?></td>
                          <td>Rp.<?php echo number_format($row1['gross_profit']);?></td>
                          <td>Rp.100.000</td>
                        </tr>

                        <?php
                             }
                          ?>
                          <?php
                            $sql1 = "SELECT sum(a.qty*a.unit_price) as gross_sales , sum(a.qty) as qty , sum(a.qty * b.hpp) as cogs , sum(a.qty*a.unit_price) - sum(b.hpp * a.qty) as gross_profit
                            FROM invoice a,
                            inventory b
                            where a.description = b.description
                            and date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                            ";
                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {                                                               
                              ?>

                        <tr>
                          <th>Casing</th>
                          <th><?php echo $row1['qty'];?></th>
                          <th>Rp.<?php echo number_format($row1['gross_sales']);?></th>
                          <th>0</th>
                          <th>0</th>
                          <th>Rp.<?php echo number_format($row1['gross_sales']);?></th>
                          <th>Rp.<?php echo number_format($row1['cogs']);?></th>
                          <th>Rp.<?php echo number_format($row1['gross_profit']);?></th>
                          <th>Rp.100.000</th>
                        </tr>

                        <?php
                             }
                          ?>
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

    <script type="text/javascript">
  
    $(document).ready(function(){
              $("#reservation").on("change", function() {
                this.form.submit();
              });
    });
    </script>
	
  </body>
</html>