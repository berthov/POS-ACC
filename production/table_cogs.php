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

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
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
                <h3>Cost Of Goods Sold</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>History</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Item Name</th>
                          <th>COGS</th>
                          <th>Sales Price</th>
                          <th>Outlet</th>
                          <th>Transaction Date</th>
                        </tr>
                      </thead>
                      <tbody>           
  
                            <?php
                              $sql = "SELECT i.cogs, 
                              i.description, 
                              i.sales_price,
                              c.periode,
                              o.name
                              FROM cogs c, 
                              inventory i,
                              outlet o 
                              where 
                              c.inventory_item_id = i.id
                              and c.ledger_id = i.ledger_id
                              and c.ledger_id = '".$ledger_new."'
                              and o.ledger_id = i.ledger_id
                              and o.outlet_id = i.outlet_id
                              and c.item_cost_id = (select 
                                max(c_1.item_cost_id)
                                From
                                cogs c_1
                                where
                                c_1.inventory_item_id = c.inventory_item_id
                                and c_1.ledger_id = c.ledger_id)
                              ";

                              $result = $conn->query($sql);
                              while($row = $result->fetch_assoc()) {
                            ?>

                        <tr>
                          <td><?php echo $row["description"] ?></td>
                          <td><?php echo number_format($row["cogs"]) ?></td>
                          <td><?php echo number_format($row["sales_price"]) ?></td>
                          <td><?php echo $row["name"]?></td>
                          <td><?php echo date('d-m-Y', strtotime($row["periode"]));?></td>
                        </tr>

                            <?php
                              }
                            ?>
                            
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
                <div class="col-md-12 col-sm-12 col-xs-12"> 
                  <form class="form-horizontal" action="controller/export_index_csv.php" method="post" name="inventory" enctype="multipart/form-data">
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="singlebutton">Excel Export</label>
                      <div class="col-md-4">
                          <input type="submit" name="export_table_cogs" class="btn btn-success" value="Export to excel"/>
                      </div>
                    </div>                    
                  </form>
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
    <script src="../vendors/jquery/dist/jquery.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
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
     

  </body>
</html>