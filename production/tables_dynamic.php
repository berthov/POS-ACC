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

    <title>Bonne Journée!</title>

    <!-- Toastr -->
    <link rel="stylesheet" href="../vendors/toastr/toastr.min.css">
    <script src="../vendors/toastr/jquery-1.9.1.min.js"></script>
    <script src="../vendors/toastr/toastr.min.js"></script>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>

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

    <!-- jQuery custom content scroller -->
    <link href="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
    
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

    <!-- Change Status -->
    <script src="../production/controller/changeStatus.js"></script>

    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
  
    <link href="../vendors/switchery/bootstrap_toggle/2.2.2/bootstrap_toggle.min.css" rel="stylesheet">
    <script src="../vendors/switchery/bootstrap_toggle/2.2.2/bootstrap_toggle.min.js"></script>
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
            <div class="page-title">
              <div class="title_left">
                <h3>Users <small>Some examples to get you started</small></h3>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <!-- YANG DI PAKE -->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Table example<small>Sub-Title</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      
                    </p>
          
                    <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Item Code</th>
                          <th>Item Description</th>
                          <th>Quantity</th>
                          <th>COGS</th>
                          <th>Sales Price</th>
                          <th>Min</th>
                          <th>Max</th>
                          <th>Outlet</th>
                          <th>#Edit</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                            $sql = "SELECT i.* , o.name
                              FROM 
                              inventory i,
                              outlet o
                              where 
                              i.ledger_id = '".$ledger_new."'
                              and o.ledger_id = i.ledger_id                              
                              and o.outlet_id = i.outlet_id
                              ";

                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {
                        ?>
                      
                        <tr>
                          <td><?php echo $row["item_code"]?></td>
                          <td><?php echo $row["description"]?></td>
                          <td><?php echo $row["qty"]?></td>
                          <td><?php echo $row["cogs"]?></td>
                          <td><?php echo $row["sales_price"]?></td>
                          <td><?php echo $row["min"]?></td>
                          <td><?php echo $row["max"]?></td>
                          <td><?php echo $row["name"]?></td>
                          <td>
                            <a href="updateinventory.php?id=<?php echo $row["id"]?>" class="btn btn-info"><i class="fa fa-pencil"></i> Edit </a>
                            <!-- <a href="controller/deleteinventory.php?id=<?php echo $row["id"]?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>-->                          
                          </td>
                          <td>
                            <input type="checkbox" class="changeInventoryStatus" checked data-value=<?php echo $row['status'];?> data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-id=<?php echo $row['id']; ?>>
                          </td>
                          <script type="text/javascript">
                            $('.changeInventoryStatus').each(function(){
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



                   <form class="form-horizontal" action="controller/export_index_csv.php" method="post" name="inventory" enctype="multipart/form-data">
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="singlebutton">Excel Export</label>
                                <div class="col-md-4">
                                    <input type="submit" name="inventory" class="btn btn-success" value="Export to excel"/>
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
  </body>

  <?php
    if($_SESSION['itemUpdated'] == true){
    ?>
    <script>
      toastr.success('Item Updated');
    </script>
    <?php
      $_SESSION['itemUpdated'] = false;
    }
  ?>
  
</html>