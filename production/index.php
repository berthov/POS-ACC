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

    <!-- Toastr -->
    <link rel="stylesheet" href="../vendors/toastr/toastr.min.css">
    <script src="../vendors/toastr/jquery-1.9.1.min.js"></script>
    <script src="../vendors/toastr/toastr.min.js"></script>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome-2/css/all.css" rel="stylesheet"> 
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-datepicker -->
    <link href="../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:500" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.css" rel="stylesheet">
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
          <!-- top tiles -->
          <div class="row tile_count">
          <form class="form-horizontal" action="index.php" method="post">

            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Gross Sales</span>
              <div class="count">Rp.
                <?php include("query/gross_sales.php") ?>
              </div>
              <span class="count_bottom"><a href="ar_list_summary.php?start_date=<?=$start_date?>&end_date=<?=$end_date?>&outlet_id=<?=$p_outlet?>">
                <?php                
                    if (isset($_REQUEST['reservation'])){
                       echo $start_date; echo " - "; echo $end_date;
                    }
                    else{
                      echo "Detail";
                    }
                ?> 
                </a>
                </span>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Net Sales</span>
               <div class="count">Rp.
                <?php include("query/net_sales.php"); ?>
              </div>
              <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span> -->
              <span class="count_bottom"><a href="net_sales_summary.php?start_date=<?=$start_date?>&end_date=<?=$end_date?>&outlet_id=<?=$p_outlet?>">
                <?php 
                if (isset($_REQUEST['reservation'])){
                       echo $start_date; echo " - "; echo $end_date;
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
                  $sql1 = "SELECT count(ih.invoice_id) as count
                  FROM invoice_header ih
                  where
                  date_format(ih.invoice_date,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'
                  and ih.ledger_id = '".$ledger_new."'
                  and (ih.outlet_id = '".$p_outlet."' or  ('".$p_outlet."' = '' ) ) 
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
              <span class="count_bottom"><a href="ar_list_summary.php?start_date=<?=$start_date?>&end_date=<?=$end_date?>&outlet_id=<?=$p_outlet?>">
                <?php 
                if (isset($_REQUEST['reservation'])){
                       echo $start_date; echo " - "; echo $end_date;
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
                  where
                  ledger_id = '".$ledger_new."'
                  and status = 'Active'
                  and (outlet_id = '".$p_outlet."' or  ('".$p_outlet."' = '' ) ) 
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

            <!-- SELECT OUTLET  -->
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
                  invoice_header ih,
                  inventory i
                  where i.id = inv.inventory_item_id
                  and ih.invoice_id = inv.invoice_id
                  and ih.ledger_id = inv.ledger_id
                  and i.ledger_id = inv.ledger_id
                  and i.ledger_id = '".$ledger_new."'
                  and ih.refund_status not in ('Yes')
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
    <script src="../vendors/jquery/dist/jquery.js"></script>
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

    var ctxL = document.getElementById("lineChart1").getContext('2d');
    var myLineChart1 = new Chart(ctxL, {
    type: 'line',
    data: {
        labels: [

        <?php

        $query = "SELECT distinct date_format(ih.invoice_date,'%M') as month
                  FROM invoice_header ih 
                  where 
                  ih.ledger_id = '".$ledger_new."'
                  and date_format(ih.invoice_date,'%Y%m') >= DATE_FORMAT(date_add(sysdate(), INTERVAL - 5 MONTH),'%Y%m')
                  order by date_format(ih.invoice_date,'%m') asc
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

                  $query = "SELECT sum(i.qty*i.unit_price)  as amount , date_format(ih.invoice_date,'%m%Y')
                  FROM invoice i,
                  invoice_header ih
                  where i.month IS NOT NULL
                  and ih.invoice_id = i.invoice_id
                  and ih.ledger_id = i.ledger_id
                  and ih.ledger_id = '".$ledger_new."'
                  and date_format(ih.invoice_date,'%Y%m') >= DATE_FORMAT(date_add(sysdate(), INTERVAL - 5 MONTH),'%Y%m')
                  group by date_format(ih.invoice_date,'%m%Y')
                  order by date_format(ih.invoice_date,'%m%Y')
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
        $_SESSION['firstLogin'] = false;
      }
    ?>
  </body>
</html>
