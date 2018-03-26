<?php
session_start();
include("controller/session.php");
?>

<!DOCTYPE html>

<style>
/*select { color: #999999 }
option { color: #555555 }
option[selected]  { color: #999999; background: white }*/
form select.not_chosen {
  color: #999999;
}

form select option {
    color: #555555;
}
form select option:first-child {
    color: #999999;
}

</style>

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
    <!-- bootstrap-wysiwyg -->
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
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
                <h3>Form Elements</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form Employee</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left input_mask " action="controller/doregister.php" method="POST">

                      <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="employee_name" name="username" placeholder="Employee Name" required="required">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true" required ="required"></span>
                      </div>

                      <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
                        <!-- <input type="text" class="form-control" id="role" name="role" placeholder="Role" required ="required"> -->
                        <select class="form-control not_chosen" name="role" required ="required" >
                          <option value="" disabled selected>Select Role</option>
                          <option class="options" value="Admin">Admin</option>
                          <option class="options" value="Staff">Staff</option>
                        </select>
                        <!-- <span class="fa fa-user form-control-feedback right" aria-hidden="true" required ="required"></span> -->
                      </div>

                      <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
                        <input type="email" class="form-control has-feedback-left" id="email" name="email" placeholder="Email" required ="required">
                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true" required ="required"></span>
                      </div>

                      <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
<!--                         <input type="text" class="form-control" id="outlet" placeholder="Outlet" required ="required" name="outlet">
                        <span class="fa fa-phone form-control-feedback right" aria-hidden="true" required ="required"></span> -->
                          <select class="form-control" name="outlet">
                              <option value="" disabled selected>Select Outlet</option>
                          
                            <?php
                            $sql = "SELECT * 
                            FROM outlet";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {
                          ?>
                              <option value="<?php echo $row["name"] ?>"> <?php echo $row["name"] ?></option>
                          <?php
                            }
                          ?>
                          
                            </select> 
                      </div>

                      <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
                        <input type="password" class="form-control has-feedback-left" id="password" placeholder="Password" required ="required" name="password">
                        <span class="fa fa-key form-control-feedback left" aria-hidden="true" required ="required"></span>
                      </div>

                      <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
                        <input type="password" class="form-control" id="cpassword" placeholder="Confirm Password" required ="required" name="cpassword">
                        <span class="fa fa-check form-control-feedback right" aria-hidden="true" required ="required"></span>
                      </div>


                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-4">
                          <button type="button" class="btn btn-primary"  onclick="window.location='../production/employees.php';">Cancel</button>
						              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success" name="reg_user">Submit</button>
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
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../vendors/starrr/dist/starrr.js"></script>
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
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

    <script type="text/javascript">

        if ($('select').length) {
        // Traverse through all dropdowns
        $.each($('select'), function (i, val) {
            var $el = $(val);
             
            // If there's any dropdown with default option selected
            // give them `not_chosen` class to style appropriately
            // We assume default option to have a value of '' (empty string)
            if (!$el.val()) {
                $el.addClass("not_chosen");
            }
             
            // Add change event handler to do the same thing,
            // i.e., adding/removing classes for proper
            // styling. Basically we are emulating placeholder
            // behaviour on select dropdowns.
            $el.on("change", function () {
                if (!$el.val())
                    $el.addClass("not_chosen");
                else
                    $el.removeClass("not_chosen");
            });
             
            // end of each callback
      });
    }
    </script>

  </body>
</html>
