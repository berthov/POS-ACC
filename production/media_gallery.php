<?php
session_start();
include("controller/session.php");
?>

<!DOCTYPE html>
<?php
include("controller/doconnect.php");
include("query/find_ledger.php");
?>

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

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
    
    <!-- Custom styling plus plugins -->
    <link href="../build/css/custom.css" rel="stylesheet">
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
        <?php include("view/sidebar.php"); ?>
        <!-- End Of Sidebar  -->
        
        <!-- Top Navigation -->
        <?php include("view/top_navigation.php"); ?>
        <!-- End Of Top Navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> <b>Receivable</b> <small> </small> </h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <div class="row">
                      <form id="formInvoice" action="controller/doaddnewinvoice.php" method="POST" >
                        <?php

                            $sql = "SELECT i.id, i.description , c.sales_price ,i.qty
                            FROM inventory i,
                            cogs c
                            where
                            c.inventory_item_id = i.id
                              and c.ledger_id = i.ledger_id
                              and c.ledger_id = '".$ledger_new."'
                              and c.item_cost_id = (select 
                                max(c_1.item_cost_id)
                                From
                                cogs c_1
                                where
                                c_1.inventory_item_id = c.inventory_item_id
                                and c_1.ledger_id = c.ledger_id)
                                ";
                            $result = $conn->query($sql);
                            $a = 0;
                            while($row = $result->fetch_assoc()) {
                        ?>

                        <div class="col-md-4 col-xs-6 col-lg-2">
                          <div class="thumbnail" align="center">
                            <p><input type="hidden" name="arr[]" value="<?php echo $row["id"]?>"><?php echo $row["description"]?></p>
                            <p><input type="hidden" name="arr1[]" value="<?php echo $row["sales_price"]?>"><?php echo number_format($row["sales_price"]) ?></p>
                            <div class="caption">
                              <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[<?php echo $a ?>]">
                                          <span class="glyphicon glyphicon-minus"></span>
                                        </button>
                                    </span>
                                    <input type="text" name="quant[<?php echo $a ?>]" data-description="<?php echo $row["description"]?>" data-price=<?php echo ($row["sales_price"]) ?> class="form-control input-number" value="0" min="0" max="<?php echo $row["qty"] ?>">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[<?php echo $a ?>]">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </span>
                              </div>
                            </div>
                            <?php
                            if ($row["qty"] == 0){
                              echo '<i style="color:red";>Insufficient Quantity</i>';
                            } else {
                              echo '<i style="color:green";> ' . $row["qty"] . ' item(s) available</i>';
                            }
                            ?>
                          </div>
                        </div>
                        <?php
                        $a ++;
                        }
                        ?>
                        <div class="col-md-12 col-xs-12">
                          <br>
                        </div>
                        <div class="clearfix"></div>
                        <!-- <button type="submit" name="submit" value="Insert" class="btn btn-round btn-primary" style="position: absolute; right: 0; bottom: 0;"><span class="glyphicon glyphicon-ok"></span></button> -->

                        <button type="button" class="btn btn-round btn-primary" data-target=".bs-example-modal-sm" data-toggle="modal" onclick="validateValue();" style="position: absolute; right: 0; bottom: 0;"><span class="glyphicon glyphicon-ok"></span></button>
                        
                        <!--Modal -->
                          <div id="modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                              <div class="modal-content">

                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">Your Order</h4>
                                  </div>
                                  
                                  <div class="modal-body" style="display:flex;">
                                    <div class="form-group description" style="flex:4;"></div>
                                    <div class="form-group quantity" style="width:10px; flex:1; text-align:center;"></div>
                                    <div class="form-group itemprice" style="width:10px; flex:1; text-align:right;"></div>
                                  </div>
                                  
                                  <div class="modal-body" style="display:flex;">
                                    <div class="form-group" style="flex:5; align:right">Total before Discount & Tax</div>
                                    <div class="form-group total" style="width:10px; flex:1; text-align:right;"></div>
                                  </div>


                                  <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel2">Discount & Tax</h4>
                                  </div>

                                  <div class="modal-body">
                                    <div class="form-group">
                                      <div>
                                        <label class="col-sm-4">Discount</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="discount" name="discount" required/>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <div>
                                        <label class="col-sm-4">Tax</label>
                                        <div class="col-sm-6">
                                          <td>
                                              <input type="checkbox" class="tax" checked data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" >                          

                                          </td>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <p></p>

                                  <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel2">Payment Method</h4>
                                  </div>

                                  <div class="modal-body">
                                    <div class="form-group">
                                      <select class="form-control" name="payment_method" id="payment_method">
                                        <option value="Cash">Cash</option>
                                        <option value="Debit/Credit">Debit/Credit</option>
                                        <option value="Voucher">Voucher</option>
                                        <option>Option Three</option>
                                      </select>
                                    </div>
                                  </div>
                                  
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                  </div>

                              </div>
                            </div>
                          </div>
                        <!--Modal -->
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

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <script src="../production/controller/media_gallery.js"></script>

    
  </body>
</html>
