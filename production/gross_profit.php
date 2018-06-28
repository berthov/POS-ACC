<?php
include("controller/doconnect.php");
session_start();
include("controller/session.php");
include("query/find_ledger.php");
include("query/redirect_billing.php");

$start_date = date('Y-m-d');
$end_date = date('Y-m-d');

if(isset($_REQUEST['reservation2'])){
  $start_date = date_format(date_create_from_format('m-d-Y', $_REQUEST['reservation']), 'Y-m-d');
  $end_date = date_format(date_create_from_format('m-d-Y', $_REQUEST['reservation2']), 'Y-m-d');
  $reservation = $_REQUEST['reservation'];
  $reservation2 = $_REQUEST['reservation2'];
}

if(isset($_REQUEST['outlet_id']) && $_REQUEST['outlet_id'] !='all' ){
  $p_outlet = $_REQUEST['outlet_id'];
}
else{
 $p_outlet = ''; 
}

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
  
    <!-- bootstrap-datepicker -->
    <link href="../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
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
            <div class="row">
              <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
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
                   <div class="col-lg-12 col-md-12 col-xs-12">
                      <h2>Gross Summary</h2>
                      <div class="clearfix"></div>
                    <br>
                    </div>
                      <form class="form-horizontal" action="gross_profit.php" method="post">
                      
                      <div class="col-lg-3 col-md-3 col-xs-12">  
                        <select name="outlet_id" id="category" class="form-control col-lg-3 col-md-3 col-xs-4 category" style="margin-top:10px">
                          <option value="all">All Outlet</option>
                          
                           <?php
                            $sql = "SELECT distinct outlet_id,name 
                            FROM outlet
                            where ledger_id = '".$ledger_new."'
                            ";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {
                          ?>
                          
                              <option value="<?php echo $row["outlet_id"] ?>"> <?php echo $row["name"] ?></option>
                          
                          <?php
                            }
                          ?>

                          </select>
                      </div>

                      <!-- Datepicker -->
                      <div class="col-lg-9 col-md-9 col-xs-12" style="margin-top: 10px;">
                        <?php include("view/datepicker.php"); ?>
                      </div>
                      <!-- End Of Datepicker  -->

                  </div>
                  <div class="x_content">
                    <table class="table ">
                      <tbody>
                        <tr>
                          <td scope="row">Gross Sales</td>
                          <td align="right">Rp.
                          <?php include("query/gross_sales.php");?></td>
                        </tr>
                        <tr>
                          <td scope="row">Discount</td>
                          <td align="right">Rp.
                          <?php include("query/discount.php"); ?></td>
                        </tr>
                        <tr>
                          <td scope="row">refund</td>
                          <td align="right">Rp.
                          <?php include("query/refund.php"); ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Net Sales</th>
                          <td align="right"><b>Rp.
                          <?php include("query/net_sales.php"); ?></b></td>
                        </tr>
                        <tr>
                          <td scope="row">Cost of Goods Sold (COGS)</td>
                          <td align="right">Rp.
                          <?php include("query/cogs.php"); ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Gross Profit</th>
                          <td align="right"><b>Rp.
                          <?php include("query/gross_profit.php"); ?></b></td> 
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
    <!-- bootstrap-datepicker -->
    <script src="../vendors/moment/moment.js"></script>
    <script src="../vendors/bootstrap/js/collapse.js"></script>
    <script src="../vendors/bootstrap/js/transition.js"></script>
    <script src="../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
    <script type="text/javascript">
  
      $(document).ready(function(){

        $("#reservation").on("dp.keydown keypress keyup", false);
        $("#reservation2").on("dp.keydown keypress keyup", false);

        $(function () {
          $('#reservation').datetimepicker({
            format: 'MM-DD-YYYY'
          });
          $('#reservation2').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            format: 'MM-DD-YYYY'
          });

          $("#reservation2").on("dp.hide", function(e) {
            $(this).removeAttr('readonly').select();
            $('#reservation').data("DateTimePicker").maxDate(e.date);
            this.form.submit();
          });

          $( "#reservation" ).click(function(event){
            $(this).attr('readonly', 'readonly');
          });

          $( "#reservation2" ).click(function(event){
            $(this).attr('readonly', 'readonly');
          });

          $("#reservation").on("dp.hide", function(e) {
            $('#reservation2').data("DateTimePicker").minDate(e.date);
            $(this).removeAttr('readonly').select();
          });
        });
      });

    </script>

  </body>
</html>