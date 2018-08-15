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

  $check_cogs = "SELECT cogs FROM inventory WHERE ledger_id = '".$ledger_new."' and id = '".$recipe_name."' ";
  $result = mysqli_query($conn,$check_cogs);
  $existing = mysqli_fetch_assoc($result);

  if ($existing) { 
     $cogs = $existing['cogs'];
   }
   else{
    $cogs = 0;
   }

$start_date = date('Y-m-d');
$period = date('Y-F');

if(isset($_REQUEST['reservation2'])){
  $start_date = date_format(date_create_from_format('m-d-Y', $_REQUEST['reservation2']), 'Y-m-d');
  $reservation = $_REQUEST['reservation2'];
  $period = date_format(date_create_from_format('m-d-Y', $_REQUEST['reservation2']), 'Y-F');
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
    <!-- bootstrap-datepicker -->
    <link href="../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

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
                        <label class="col-md-1 col-sm-3 col-xs-3">Recipe Name</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <select class="form-control" name="recipe_name" id="calculate_cogs">
                              <option value="" disabled selected>Select Goods</option>
                          
                            <?php
                            $sql = "SELECT  frh.recipe_name ,frh.recipe_id , i.description
                            FROM fmd_recipe_header frh,
                            inventory i
                            where 
                            frh.recipe_name = i.id
                            and frh.ledger_id = '".$ledger_new."'
                            ";
                            $result = $conn->query($sql);
                            while($row1 = $result->fetch_assoc()) {
                          ?>
                              <option value="<?php echo $row1["recipe_name"] ?>"> <?php echo $row1["description"] ?></option>
                          <?php                         
                        }
                        ?>
                            </select>
                        </div>

                        <label class="col-md-1 col-sm-3 col-xs-3">COGS</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input type="text" class="form-control" name="cogs" id="cogs" readonly="" placeholder="<?php echo number_format($cogs) ?>"></input>
                        </div>

                      </div>
                      <div class="form-group">
                        <label class="col-md-1 col-sm-3 col-xs-3">Period</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                         <div class="form-group">
                          <div class='input-group date'>
                              <input type='text' class="form-control" autocomplete="off" name="reservation2" id="reservation2" 
                              value="<?php
                                  if (isset($reservation) && !empty($reservation)){
                                    echo $reservation;
                                  }
                                  else {
                                    echo date('m-d-Y');
                                  }
                                ?>"
                              />
                              <span class="add-on input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
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
                          <th>Avg Purchase</th>
                          <th>Avg Purchase * Quantity Recipe</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                            $sql = "SELECT 
                            frl.inventory_item_id , 
                            i.item_code,
                            i.description , 
                            frl.qty , 
                            i.qty as quantity ,
                            po.avg                         
                            FROM 
                            (
                            select pol.inventory_item_id , round(sum(pol.qty)/count(pol.inventory_item_id),0) as avg
                            from po_header_all poh,
                            po_line_all pol
                            where 
                            poh.po_header_id = pol.po_header_id
                            and poh.ledger_id = '".$ledger_new."'
                            and poh.outlet_id = '".$outlet_new."'
                            and date_format(poh.po_date,'%Y-%M') = '".$period."' 
                            group by
                            pol.inventory_item_id) PO,
                            fmd_recipe_header frh, 
                            fmd_recipe_line frl
                            right join inventory i
                            on frl.inventory_item_id = i.id                         
                            where frh.recipe_id = frl.recipe_id
                            and frh.recipe_name = '".$recipe_name."'
                            and frh.ledger_id = '".$ledger_new."'
                            and i.id = po.inventory_item_id
                            group by
                            frl.inventory_item_id, 
                            i.description, 
                            frl.qty, 
                            i.qty,
                            i.item_code";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {
                        ?>
                      
                        <tr>
                          <td><?php echo $row["item_code"]?></td>
                          <td><?php echo $row["description"]?></td>
                          <td><?php echo $row["qty"]?></td>
                          <td><?php echo $row["quantity"]?></td>
                          <td><?php echo number_format($row["avg"])?></td>
                          <td><?php echo number_format($row["avg"]*$row["qty"]) ?></td>
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
                    <form method="POST" action="controller/docalculate_recipe.php">
                      <input type="hidden" name="recipe_name" value="<?php echo $recipe_name ?>">
                      <input type="hidden" name="reservation2" value="<?php echo $reservation ?>">
                      <button type="submit" class="btn btn-success">Calculate COGS</button>
                    </form>
                    <form method="POST" action="do_production.php">
                      <button type="submit" class="btn btn-primary">Production</button>
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
    <!-- bootstrap-datepicker -->
    <script src="../vendors/moment/moment.js"></script>
    <script src="../vendors/bootstrap/js/collapse.js"></script>
    <script src="../vendors/bootstrap/js/transition.js"></script>
    <script src="../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

    <script src="../production/common/error.js"></script>
    
    <script type="text/javascript">
  
    // $(document).ready(function(){
    //   $("#calculate_cogs").on("change", function() {
    //     this.form.submit();
    //   });
    // });

    $(document).ready(function(){

        $("#reservation2").on("dp.keydown keypress keyup", false);

        $(function () {
          $('#reservation2').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            format: 'MM-DD-YYYY'
          });

          $("#reservation2").on("dp.hide", function(e) {
            $(this).removeAttr('readonly').select();
            this.form.submit();
          });


          $( "#reservation2" ).click(function(event){
            $(this).attr('readonly', 'readonly');
          });

        });
      });

    </script>
	
  </body>
</html>


