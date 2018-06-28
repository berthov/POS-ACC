<?php
include("controller/doconnect.php");
session_start();
include("controller/session.php");
include("query/find_ledger.php");
include("query/redirect_billing.php");

$recipe_name = "";

if(isset($_REQUEST['recipe_name'])){
  $recipe_name = $_REQUEST['recipe_name'] ;
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
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

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
                <h3>Formula</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Detail</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left input_mask" method="POST" action="calculate_cogs.php">
                      <div class="form-group">
                        <label class="col-md-1 col-sm-3 col-xs-3">Goods Name</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <select class="form-control" name="recipe_name" id="calculate_cogs">
                              <option value="" disabled selected>Select Goods</option>
                          
                            <?php
                            $sql = "SELECT  frh.recipe_name ,frh.recipe_id
                            FROM fmd_recipe_header frh
                            where frh.ledger_id = '".$ledger_new."'
                            ";
                            $result = $conn->query($sql);
                            while($row1 = $result->fetch_assoc()) {
                          ?>
                              <option value="<?php echo $row1["recipe_id"] ?>"> <?php echo $row1["recipe_name"] ?></option>
                          <?php
                        }
                      
                        ?>
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-1 col-sm-3 col-xs-3">Period</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input type="text" class="form-control" name="period" id="period"></input>
                        </div>
                      </div>
                      <div class="clearfix"><br></div>
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                          <div class="x_title">
                            <h2><i class="fa fa-align-left"></i>Ingredient</h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">

                            <!-- Ingredient LINE  -->
                            <div class="panel-body">
                              <div class="panel panel-default" style="padding-top: 20px;  border: 0px;">

                    <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Item Code</th>
                          <th>Item Description</th>
                          <th>Quantity Recipe</th>
                          <th>Available To Use</th>
                          <th>Item Cost</th>
                          <th>test</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                            $sql = "SELECT frl.item_code , frl.description , frl.qty , i.qty as quantity  , sum(pol.qty*pol.price) as po_price , round(sum(pol.qty*pol.price) /  sum(pol.qty),0) as tes
                            FROM fmd_recipe_header frh, 
                            fmd_recipe_line frl
                            right join inventory i
                            on frl.item_code = i.item_code
                            right join po_line_all pol
                            on frl.item_code = pol.item_code
                            where frh.recipe_id = frl.recipe_id
                            and frh.recipe_id = '".$recipe_name."'
                            and frh.ledger_id = '".$ledger_new."'
                            group by
                            frl.item_code, 
                            frl.description, 
                            frl.qty, 
                            i.qty";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {
                        ?>
                      
                        <tr>
                          <td><?php echo $row["item_code"]?></td>
                          <td><?php echo $row["description"]?></td>
                          <td><?php echo $row["qty"]?></td>
                          <td><?php echo $row["quantity"]?></td>
                          <td><?php echo $row["po_price"]?></td>
                          <td><?php echo $row["tes"]?></td>
                        </tr>
                        
                        <?php
                        }
                      
                        ?>
                      
                      </tbody>
                    </table>

                              <div class="clear"></div>    
                              </div>
                            </div>
                            <!-- END OF PO LINE -->
                          </div>
                        </div>
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
        <!-- /page content -->

        <!-- footer content -->
        <?php include("view/footer.php"); ?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
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

    <!-- jQuery custom content scroller -->
    <script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

    <script src="../production/common/error.js"></script>
    
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

              $("#calculate_cogs").on("change", function() {
                this.form.submit();
              });
    });
    </script>
	
  </body>
</html>


