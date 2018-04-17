<?php
session_start();
include("controller/session.php");
include("controller/doconnect.php");
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

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bonne Journée </title>

    <!-- Toastr -->
    <link rel="stylesheet" href="../vendors/toastr/toastr.min.css">
    <script src="../vendors/toastr/jquery-1.9.1.min.js"></script>
    <script src="../vendors/toastr/toastr.min.js"></script>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
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
    <link href="../build/css/custom.css" rel="stylesheet">
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
          <!-- top tiles -->
          <div class="row tile_count">
            <form class="form-horizontal" action="index.php" method="post">

            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Gross Sales</span>
              <div class="count">Rp.<?php
                  $sql = "SELECT sum(a.unit_price*a.qty) as amount  
                  FROM invoice a 
                  where
                  (date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."')
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
              ?>
              </div>
              <span class="count_bottom"><a href="ar_list_summary.php?p_start_date=<?=$p_start_date?>&p_end_date=<?=$p_end_date?>">
                <?php 
                
                if (isset($_REQUEST['reservation'])){
                       echo $p_start_date; echo " - "; echo $p_end_date;
                    }
                    else{
                      echo "Detail";
                    }
                ?> </a>
                </span>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Net Sales</span>
               <div class="count">Rp.<?php
                  $sql1 = "SELECT sum(unit_price*qty) as amount 
                  FROM invoice a
                  where
                  (date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."')
                  ";
                  $result1 = $conn->query($sql1);
                  while($row1 = $result1->fetch_assoc()) {
                                    
                  if($row1['amount'] > 0 ) {
                    // echo $row1['amount'];
                    echo number_format($row1['amount']);
                  }
                  else{
                    echo "0";
                  }
                }
              ?>
              </div>
              <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span> -->
              <span class="count_bottom"><a href="net_sales_summary.php?p_start_date=<?=$p_start_date?>&p_end_date=<?=$p_end_date?>">
                <?php 
                if (isset($_REQUEST['reservation'])){
                       echo $p_start_date; echo " - "; echo $p_end_date;
                    }
                    else{
                      echo "Detail";
                    }
                ?>
                </span></a>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Number Of Transactions</span>
              <div class="count">
              <?php
                  $sql1 = "SELECT count(a.invoice_id) as count
                  FROM invoice a
                  where
                  (date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."')
                  and a.invoice_line_id = (select max(b.invoice_line_id)
                  from invoice b
                  where b.invoice_id = a.invoice_id)
                  ";
                  $result1 = $conn->query($sql1);
                  while($row1 = $result1->fetch_assoc()) {
                                    
                  if($row1['count'] > 0 ) {
                    echo $row1['count'];
                  }
                  else{
                    echo "0";
                  }
                }
              ?>
              </div>
              <span class="count_bottom"><a href="ar_list_summary.php?p_start_date=<?=$p_start_date?>&p_end_date=<?=$p_end_date?>">
                <?php 
                if (isset($_REQUEST['reservation'])){
                       echo $p_start_date; echo " - "; echo $p_end_date;
                    }
                    else{
                      echo "Detail";
                    }
                ?>
              </span></a>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total All Stock</span>
              <div class="count">

                <?php
                  $sql1 = "SELECT sum(qty) as count
                  FROM inventory 
                  ";
                  $result1 = $conn->query($sql1);
                  while($row1 = $result1->fetch_assoc()) {
                                    
                  if($row1['count'] > 0 ) {
                    echo $row1['count'];
                  }
                  else{
                    echo "0";
                  }
                }
              ?>

              </div>
              <!-- <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span> -->
              <span class="count_bottom">As Of Today</span>
            </div>
          
          <!-- DATE PICKER -->
             <div class="col-md-10">
              <fieldset>
                <div class="control-group" >
                  <div class="controls" >
                    <div class="input-prepend input-group">
                      <input type="text" style="width: 200px" name="reservation" id="reservation" class="form-control pull-right"         value="<?php if ($p_start_date = "" and $p_end_date =""){
                        echo date('m-d-Y'); echo" - "; date('m-d-Y');
                      } ?>" />
                      <span class="add-on input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    </div>
                  </div>
                </div>
              </fieldset>
             </div>
             <div class="col-md-2">
              <input type="submit" name="submit"  class="btn btn-round btn-primary "/>
            </div>
          
          </form>
          </div>

          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Monthly Gross Sales <small>Graph title sub-title</small></h3>
                  </div>
                  <div class="col-md-6">
                    
<!--                     <form class="form-horizontal">
                          <fieldset>
                            <div class="control-group" >
                              <div class="controls" >
                                <div class="input-prepend input-group">
                                  <input type="text" style="width: 200px" name="reservation" id="reservation" class="form-control pull-right" value="01/01/2016 - 01/25/2016" />
                                  <span class="add-on input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </fieldset>
                          <input type="submit" name="submit"  class="btn btn-round btn-primary pull-right"/>
                        </form>
                  </div> -->
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <canvas id="lineChart1"></canvas>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                  <div class="x_title">
                    <h2>Top Items Sales</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <?php
                  $sql1 = "SELECT sum(inv.qty) as qty , i.description
                  FROM invoice inv,
                  inventory i
                  where i.id = inv.inventory_item_id
                  and i.ledger_id = '".$ledger_new."'
                  group by i.description
                  order by qty desc
                  limit 4
                  ";
                  $result1 = $conn->query($sql1);
                  while($row1 = $result1->fetch_assoc()) {  
                  ?>
              
                    <div>
                      <p></p><?php echo $row1['description']; echo " "; echo $row1['qty']; ?></p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $row1['qty']; ?>"></div>
                        </div>
                      </div>
                    </div>
                    <?php
                      }
              ?>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />

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

    var ctxL = document.getElementById("lineChart1").getContext('2d');
    var myLineChart1 = new Chart(ctxL, {
    type: 'line',
    data: {
        labels: [

        <?php

        $query = "SELECT distinct date_format(date,'%M') as month
                  FROM invoice 
                  where month IS NOT NULL
                  and date_format(date,'%Y%m') >= DATE_FORMAT(date_add(sysdate(), INTERVAL - 5 MONTH),'%Y%m')
                  order by date asc
                  /*where
                  date_format(date,'%d-%m-%Y') = date_format(sysdate(),'%d-%m-%Y')*/
                  ";
                $data=mysqli_query($conn,$query);   
                while($row=mysqli_fetch_array($data)){                   
                    echo "\"";echo $row['month'] ; echo "\"" ;echo ",";
                    
                }

        ?>

        ],
        datasets: [
            {
                label: "Gross Sales",
                backgroundColor: "rgba(83, 160, 172, 0.5)",
                borderColor:"rgba(83, 160, 172, 1)",
                pointBackgroundColor:"rgba(83, 160, 172, 1)",
                data: [

                <?php

                  $query = "SELECT sum(qty*unit_price) as amount , month
                  FROM invoice 
                  where month IS NOT NULL
                  and date_format(date,'%Y%m') >= DATE_FORMAT(date_add(sysdate(), INTERVAL - 5 MONTH),'%Y%m')
                  group by month
                  order by date 
                  /*where
                  date_format(date,'%d-%m-%Y') = date_format(sysdate(),'%d-%m-%Y')*/
                  ";
                $data=mysqli_query($conn,$query);   
                while($row=mysqli_fetch_array($data)){                   
                    echo $row['amount']  ;echo ",";                    
                }

                ?>
                
                ]
            }
            /*,
            {
                label: "Keuntungan",
                backgroundColor: "rgba(82, 173, 135, 0.5)",
                borderColor:"rgba(82, 173, 135, 1)",
                pointBackgroundColor:"rgba(82, 173, 135, 1)",
                data: [28, 48, 40, 19, 86, 27, 20]
            }*/
        ]
    },
    options: {
        responsive: true
    }    
});


    </script>
    <?php
      if($_SESSION['firstLogin'] == true){
      ?>
      <script>
        toastr.success('You are logged in');
      </script>
      <?php
        unset($_SESSION['firstLogin']);
      }
    ?>
  </body>
</html>
