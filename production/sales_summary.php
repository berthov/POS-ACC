<?php
session_start();
include("controller/session.php");
?>

<!DOCTYPE html>
<?php
include("controller/doconnect.php");
$start_date = date('Y-m-d');
$end_date = date('Y-m-d');

if(isset($_REQUEST['reservation'])){
  $start_date = date('Y-m-d',strtotime(substr($_REQUEST['reservation'], 1,10))) ;
}

if(isset($_REQUEST['reservation'])){
  $end_date = date('Y-m-d',strtotime(substr($_REQUEST['reservation'], 14,10))) ;
}

// echo $start_date1 =  '<p id=demo></p>';
// echo '<br>';
// echo $end_date1 = '<p id=demo1></p>' ;

// testing
echo  '<p id=demo></p>';
echo  '<p id=demo1></p>';

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
              <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="x_panel">
                 <div class="row x_title"> 
                                            
                   <div class="col-md-4">
                      <h2>Sales Summary</h2>
                      <div class="clearfix"></div>
                    </div>
                    <!-- Date Picker -->
                   <div class="col-md-6">
                    <!--INI GK JELAS PARAMETERNYA  -->
                    <!-- kalo gw pake onchange kgak mau di click pas udah milih tanggal -->
                      <form class="form-horizontal" action="sales_summary.php" method="post">
                        <fieldset>
                          <div class="control-group" >
                            <div class="controls" >
                              <div class="input-prepend input-group">
                                <input type="text" style="width: 200px" name="reservation" id="reservation" class="form-control pull-right"  />
                                <span class="add-on input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                              </div>
                            </div>
                          </div>
                        </fieldset>
                    </div>

                    <!-- kalo button nya gw ilangin loop trus dia -->
                   <!--  <div class="col-md-2">
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
                          $sql = "SELECT sum(a.unit_price*a.qty) as amount  
                          FROM invoice a 
                          where
                          date_format(a.date,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'
                          ";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {                                                               
                             
                              if($row['amount'] > 0 ) {
                                // echo $row1['amount'];
                                echo number_format($row['amount']);

                              }
                              else{
                                echo "0";
                              }
                          }
                          ?></td>
                        </tr>
                        <tr>
                          <td scope="row">Discount</td>
                          <td align="right">Rp.0</td>
                        </tr>
                        <tr>
                          <td scope="row">refund</td>
                          <td align="right">Rp.0</td>
                        </tr>
                        <tr>
                          <th scope="row">Net Sales</th>
                          <td align="right"><b>Rp.
                          <?php
                          $sql = "SELECT sum(a.unit_price*a.qty) as amount  
                          FROM invoice a 
                          where
                          date_format(a.date,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'
                          ";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {                                                               
                             
                              if($row['amount'] > 0 ) {
                                // echo $row1['amount'];
                                echo number_format($row['amount']);

                              }
                              else{
                                echo "0";
                              }
                          }
                          ?></b></td>
                        </tr>
                        <tr>
                          <td scope="row">Tax</td>
                          <td align="right">Rp.0</td>
                        </tr>
                        <tr>
                          <th scope="row">Total Collected</th>
                          <td align="right"><b>Rp.
                          <?php
                          $sql = "SELECT sum(a.unit_price*a.qty) as amount  
                          FROM invoice a 
                          where
                          date_format(a.date,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'
                          ";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {                                                               
                             
                              if($row['amount'] > 0 ) {
                                // echo $row1['amount'];
                                echo number_format($row['amount']);

                              }
                              else{
                                echo "0";
                              }
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
      /*$("#reservation").on("change paste keyup", function() {
             var x = document.getElementById("reservation").value;
             var y = document.getElementById("reservation").value;
             var start_date = x.substr(1,10) ;
             var end_date = x.substr(14,10) ;

            document.getElementById("demo").innerHTML = start_date;
            document.getElementById("demo1").innerHTML = end_date;

            });*/

              $("#reservation").on("change", function() {
                this.form.submit();
              });
    });
    </script>
  </body>
</html>