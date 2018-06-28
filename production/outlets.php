<?php
include("controller/doconnect.php");
session_start();
include("controller/session.php");
include("query/find_ledger.php");
include("query/redirect_billing.php");
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

    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
        
    <div class="main_container">
    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Custom Theme Scripts -->
    <!-- <script src="../build/js/custom.min.js"></script> -->
     <!-- Change Status -->
    <script src="../production/controller/changeStatus.js"></script>

    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
  
    <link href="../vendors/switchery/bootstrap_toggle/2.2.2/bootstrap_toggle.min.css" rel="stylesheet">
    <script src="../vendors/switchery/bootstrap_toggle/2.2.2/bootstrap_toggle.min.js"></script>


    <div class="container body">
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
                   <div class="col-md-6">
                      <h2><strong>Outlets Summary</strong></h2>
                      <div class="clearfix"></div>
                    </div>
                   <!-- <div class="col-md-6">
                          <form class="form-horizontal">
                            <fieldset >
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
                          </form>
                    </div> -->
                    <div class="col-md-6">
                      <form action="addoutlet.php">
                          <input type="submit" value="Add Outlet" class="btn btn-round btn-primary pull-right"/>
                      </form>

                    </div>
                  </div>

                  <div class="x_content">
                    <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="datatable">
                      <thead>  
                        <tr>
                          <th>Outlet Name</th>
                          <th>Address</th>
                          <th>Phone</th>
                          <th>City</th>
                          <th>Province</th>
                          <th>Staff</th>
                          <th>Edit Outlet</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
            
                            $sql1 = "SELECT a.name , a.address , a.phone , a.city ,a.province , count(b.outlet_id) as staff , a.status, a.outlet_id as outlet_id
                            FROM outlet a
                            left join employee b
                            on a.name = b.outlet_id
                            WHERE
                            a.ledger_id = '".$ledger_new."' 
                            group by
                            a.name , a.address , a.phone , a.city ,a.province , a.status
                            ";
                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {                                                               
                              ?>
                        <tr>

                          <td><?php echo $row1['name'];?></td>
                          <td><?php echo $row1['address'];?></td>
                          <td><?php echo $row1['phone'];?></td>
                          <td><?php echo $row1['city'];?></td>
                          <td><?php echo $row1['province'];?></td>
                          <td><?php echo $row1['staff'];?></td>
                          <td>
                            <a href="updateoutlet.php?id=<?php echo $row1["outlet_id"]?>" class="btn btn-info"><i class="fa fa-pencil"></i> Edit </a>                          
                          </td>
                          <td>
                              <input type="checkbox" class="changeOutletStatus" checked data-value=<?php echo $row1['status'];?> data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-id=<?php echo $row1['outlet_id']; ?>>                          
                          </td>
                           <script type="text/javascript">
                            $('.changeOutletStatus').each(function(){
                              var dataStatus = $(this).data('value');
                              if(dataStatus == "Inactive"){
                                $(this).removeAttr("checked");
                              }
                            })
                          </script>    
                        </tr>                      
                        <?php
                             }
                          ?>
                      </tbody>
                    </table>
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

    <!-- jQuery custom content scroller -->
    <script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
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

    <?php
      if($_SESSION['outletUpdated'] == true){
      ?>
      <script>
        toastr.success('Outlet Updated');
      </script>
      <?php
        $_SESSION['outletUpdated'] = false;
      }
    ?>

  </body>
</html>