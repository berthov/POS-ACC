<?php
session_start();
include("controller/session.php");
include("controller/doconnect.php");
include("query/find_ledger.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    
    <!-- Custom styling plus plugins -->
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
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> <b>Receivable</b> <small> </small> </h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_content">
                    <div class="row">
                      <form action="controller/doaddnewinvoice.php" method="POST" >
                        <?php

                            $sql = "SELECT i.description , c.sales_price ,i.qty
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
                        <div class="col-md-3">
                          <div class="thumbnail" align="center">
                            <p><input type="hidden" name="arr[]" value="<?php echo $row["description"]?>"><?php echo $row["description"]?></p>
                            <p><input type="hidden" name="arr1[]" value="<?php echo $row["unit_price"]?>"><?php echo number_format($row["sales_price"]) ?></p>
                            <div class="caption">
                              <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[<?php echo $a ?>]">
                                          <span class="glyphicon glyphicon-minus"></span>
                                        </button>
                                    </span>
                                    <input type="text" name="quant[<?php echo $a ?>]" class="form-control input-number" value="0" min="0" max="<?php echo $row["qty"] ?>">
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
                            }
                            ?>
                          </div>
                        </div>
                        <?php
                        $a ++;
                        }
                        ?>
                        <div class="col-md-12">
                          <br>
                        </div>
                        <div class="clearfix"></div>
                        <!-- <button type="submit" name="submit" value="Insert" class="btn btn-round btn-primary" style="position: absolute; right: 0; bottom: 0;"><span class="glyphicon glyphicon-ok"></span></button> -->

                        <button type="button" class="btn btn-round btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm" style="position: absolute; right: 0; bottom: 0;"><span class="glyphicon glyphicon-ok"></span></button>
                        <!--Modal -->
                        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">

                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel2">Payment Method</h4>
                              </div>
                              <div class="modal-body">
                               
                        <div class="form-group">
                          <select class="form-control" name="payment_method">
                            <option value="Cash">Cash</option>
                            <option value="Debit/Credit">Debit/Credit</option>
                            <option value="Voucher">Voucher</option>
                            <option>Option Three</option>
                          </select>
                        </div>
                                <!-- <div class="md-form form-sm">
                                    <input type="text" id="payment_method" class="form-control" name="payment_method">
                              
                                </div> -->
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

    <script type="text/javascript">
      //plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    </script>
  </body>
</html>