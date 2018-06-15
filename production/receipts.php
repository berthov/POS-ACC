<?php
session_start();
include("controller/session.php");
include("query/find_ledger.php");
?>

<!DOCTYPE html>
<?php

if(isset($_REQUEST['name'])){
  $name = $_REQUEST['name'] ;
}
  else{
  $name = 'CaseNation.Indo';
}

if(isset($_REQUEST['phone'])){
  $phone = $_REQUEST['phone'] ;
}
else{
  $phone = '+82 89636053432';
}

if(isset($_REQUEST['province'])){
  $province = $_REQUEST['province'] ;
}
else{
  $province = 'Tangerang';
}

if(isset($_REQUEST['city'])){
  $city = $_REQUEST['city'] ;
}
else{
  $city = 'Tangerang';
}

?>
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
              <div class="col-md-12 col-sm-12 col-xs-12">
                
                <div class="x_panel">
                 <div class="row x_title"> 
                   <div class="col-md-12">
                      <h2>Receipt</h2>
                      <div class="clearfix"></div>
                    </div>
                  </div>

                  <div class="x_content">
                    <div class="row">
                      <form action="receipts.php" method="post">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        RECEIPT INFO
                        <div class="x_panel">
                          Outlet Info

                          <div class="col-md-12"><br></div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-suggestions="White, Green, Blue, Black, Brown" name="name" placeholder="CaseNation.Indo" type="text">
                        </div>
                        <div class="col-md-12"><br></div>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                          <input id="phone" class="form-control col-md-7 col-xs-12" data-suggestions="White, Green, Blue, Black, Brown" name="phone" placeholder="+82 89636053432" type="text">
                        </div>
                        <div class="col-md-12"><br></div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <input id="province" class="form-control col-md-7 col-xs-12" data-suggestions="White, Green, Blue, Black, Brown" name="province" placeholder="Tangerang" type="text">
                        </div>
                        <div class="col-md-12"><br></div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <input id="city" class="form-control col-md-7 col-xs-12" data-suggestions="White, Green, Blue, Black, Brown" name="city" placeholder="Tangerang" type="text">
                        </div>
                        <div class="col-md-12">
                          <br>
                          <br>
                          <br>
                          <button id="send" type="submit" class="btn btn-success">Update</button>       
                        </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        RECEIPT PREVIEW
                        <div class="x_panel">
                          <div class="row">
                            <div class="col-md-2"></div>
                              <div class="col-md-8">
                                <div class="x_panel">
                                  <div class="x_content">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <p align="center"><b><?php echo $name; ?></b></p>
                                        <p align="center">Jln. Marina Raya Ruko Exclusive , <?php echo $province; echo "."; echo $city; ?> <br><i class="fa fa-phone"></i> <?php echo $phone; ?></p>
                                        <div class="row">
                                          <div class="col-md-6 ">
                                            <?php echo date("d-m-Y"); ?>
                                          </div>
                                          <div class="col-md-6 pull-right" style="text-align: right;">
                                            <?php echo date("H:i:s"); ?>
                                          </div>
                                          <div class="col-md-6 ">
                                            Receipt Number
                                          </div>
                                          <div class="col-md-6 pull-right" style="text-align: right;">
                                            D8WBB7
                                          </div>
                                          <div class="clearfix"></div>
                                          <hr style="margin-top: 2px;">
                                          <div class="col-md-4 " style="text-align: left;">
                                          Mario Bros
                                          </div>
                                          <div class="col-md-4 " style="text-align: right;">
                                            1x
                                          </div>
                                          <div class="col-md-4 " style="text-align: right;">
                                            Rp.100.000
                                          </div>
                                          <div class="col-md-4 " style="text-align: left;">
                                            Starwars
                                          </div>
                                          <div class="col-md-4 " style="text-align: right;">
                                            1x
                                          </div>
                                          <div class="col-md-4 " style="text-align: right;">
                                           Rp.100.000
                                          </div>
                                          <div class="clearfix"></div>
                                          <hr style="margin-top: 2px;">
                                          <div class="col-md-6">
                                          <p>Subtotal</p>
                                          </div>
                                          <div class="col-md-6 pull-right" style="text-align: right;">
                                            Rp.200.000
                                          </div>
                                          <div class="clearfix"></div>
                                          <hr style="margin-top: 2px;">
                                          <div class="col-md-6 ">
                                          <h4 style="margin-top: -10px;"><b>Total</b></h4>
                                          </div>
                                          <div class="col-md-6 pull-right" style="text-align: right;">
                                          <h4 style="margin-top: -10px;"><b>
                                          Rp.200.000
                                      </b></h4>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            <div class="col-md-2"></div>
                           </div>
                        </div>
                      </div>
                    </form>
                    </div>
                  </div>
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
	
  </body>
</html>