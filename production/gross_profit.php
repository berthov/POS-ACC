<!DOCTYPE html>

<?php
session_start();
include("controller/doconnect.php");
include("controller/session.php");
include("query/find_ledger.php");

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
                  <div class="x_title">
                    <h2>Gross Profit</h2>
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
                    Gross Profit is your Net Sales minus Cost of Goods Sold (COGS). To report gross profit accurately, please make sure all items have a COGS.
                  </div>
                </div>
                <div class="x_panel">
                 <div class="row x_title"> 
                   <div class="col-md-4">
                      <h2>Sales Summary</h2>
                      <div class="clearfix"></div>
                    </div>
                   <div class="col-md-12">
                          <form class="form-horizontal" action="gross_profit.php" method="post">
                            <fieldset>
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
<!--                                         <div class="col-md-2">
                      <input type="submit" name="submit"  class="btn btn-round btn-primary pull-right"/>
                    </div> -->
                  </div>
 
                  <div class="x_content">
                    <table class="table ">
                      <tbody>
                        <tr>
                          <td scope="row">Gross Sales</td>
                          <td align="right">Rp.
                           <?php
                            $sql1 = "SELECT sum(a.qty*a.unit_price) as count
                            FROM invoice a
                            where
                            date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                            and ledger_id = '".$ledger_new."'
                            ";
                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {                                                               
                              // echo number_format($row1['count']);
                              if($row1['count'] > 0 ) {
                                // echo $row1['amount'];
                                echo number_format($row1['count']);

                              }
                              else{
                                echo "0";
                              }
                          }
                          ?></td>
                        </tr>
                        <tr>
                          <td scope="row">Discount</td>
                          <td align="right">Rp.
                           <?php
                           $Discount = "Discount";

                            $sql1 = "SELECT sum(a.qty*a.unit_price) as count
                            FROM invoice a
                            where
                            date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                            and a.payment_method = '".$Discount."'
                            and ledger_id = '".$ledger_new."'
                            ";
                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {                                                               
                              // echo number_format($row1['count']);
                              if($row1['count'] > 0 ) {
                                // echo $row1['amount'];
                                echo number_format($row1['count']);

                              }
                              else{
                                echo "0";
                              }
                          }
                          ?>
                            
                          </td>
                        </tr>
                        <tr>
                          <td scope="row">refund</td>
                          <td align="right">Rp.
                                                     <?php
                           $refund = "refund";

                            $sql1 = "SELECT sum(a.qty*a.unit_price) as count
                            FROM invoice a
                            where
                            date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                            and a.payment_method = '".$refund."'
                            and ledger_id = '".$ledger_new."'
                            ";
                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {                                                                
                              // echo number_format($row1['count']);
                            if($row1['count'] > 0 ) {
                                // echo $row1['amount'];
                                echo number_format($row1['count']);

                              }
                              else{
                                echo "0";
                              }
                          }
                          ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Net Sales</th>
                          <td align="right"><b>Rp.
                         <?php
                            $sql1 = "SELECT sum(a.qty*a.unit_price) as count
                            FROM invoice a
                            where
                            date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                            and ledger_id = '".$ledger_new."'
                            ";
                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {                                                               
                              // echo number_format($row1['count']);
                              if($row1['count'] > 0 ) {
                                // echo $row1['amount'];
                                echo number_format($row1['count']);

                              }
                              else{
                                echo "0";
                              }
                          }
                          ?></b></td>
                        </tr>
                        <tr>
                          <td scope="row">Cost of Goods Sold (COGS)</td>
                          <td align="right">Rp.
                          <?php
                            $sql1 = "SELECT sum(a.qty * b.cogs) as count
                            FROM invoice a,
                            inventory b
                            where a.inventory_item_id = b.id
                            and a.ledger_id = b.ledger_id
                            and a.ledger_id = '".$ledger_new."'
                            and date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                            ";

                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {                                                               
                              // echo number_format($row1['count']);
                              if($row1['count'] > 0 ) {
                                // echo $row1['amount'];
                                echo number_format($row1['count']);

                              }
                              else{
                                echo "0";
                              }
                          }
                          ?>
                            
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">Gross Profit</th>
                          <td align="right"><b>Rp.
                           <?php
                            $sql1 = "SELECT sum(a.qty* (a.unit_price-b.cogs)) as count
                            FROM invoice a,
                            inventory b
                            where a.inventory_item_id = b.id
                            and a.ledger_id = b.ledger_id
                            and a.ledger_id = '".$ledger_new."'
                            and date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                            ";

                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {                                                               
                              // echo number_format($row1['count']);
                              if($row1['count'] > 0 ) {
                                // echo $row1['amount'];
                                echo number_format($row1['count']);

                              }
                              else{
                                echo "0";
                              }
                          }
                          ?>
                            
                          </b></td>
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