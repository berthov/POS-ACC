<?php
session_start();
include("controller/session.php");
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
                <!-- <h3>Form Supplier</h3> -->
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form validation <small>sub title</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form id="formsupplier" class="form-horizontal form-label-left" method="post" action="controller/doaddsupplier.php" novalidate>

                      <span class="section">Supplier Info</span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supplier_name">Suplier Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="supplier_name" class="form-control col-md-7 col-xs-12" data-suggestions="White, Green, Blue, Black, Brown" name="supplier_name" placeholder="Ex. PT.Integrasi Solution" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supplier_site">Supplier Site <span class="required"> </span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="supplier_site" name="supplier_site" class="form-control col-md-7 col-xs-12" placeholder="Jakarta" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supplier_type">Supplier Type <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12" name="supplier_site" id="supplier_site">
                            <option value="Cash">Lokal</option>
                            <option value="Debit/Credit">Impor</option>
                          </select>
                        </div>
                      </div>
                      <!-- MASIH PERTANYAAN TOP MAU DI PAKE ATO GAK -->
<!--                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="top">TOP <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="top" name="top" required="required" min="0" max="20" class="form-control col-md-7 col-xs-12" placeholder="0-20%">
                        </div>
                      </div> -->
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tax">Tax <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="tax" name="tax" required="required" min="0" max="20" class="form-control col-md-7 col-xs-12" placeholder="0-20%">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Cancel</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="x_panel">
                  <form class="form-horizontal" action="controller/export_index_csv.php" method="post" name="upload_excel" enctype="multipart/form-data">
                     <fieldset>
                              <!-- Form Name -->
                              <legend>MASS ADD CSV </legend>
       
                              <!-- File Button -->
                              <div class="form-group">
                                  <label class="col-md-4 control-label " for="filebutton">Select File</label>
                                  <div class="col-md-4">
                                      <input type="file" name="file" id="file" class="input-large">
                                  </div>
                              </div>
       
                              <!-- Button -->
                              <div class="form-group">
                                  <label class="col-md-4 control-label" for="singlebutton">Import data</label>
                                  <div class="col-md-4">
                                      <button type="submit" name="Import_supplier" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                                  </div>
                              </div>      
                       </fieldset>
                 </form>
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
    <script src="../vendors/jquery/dist/jquery.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
	   
    <script src="../production/common/error.js"></script>


  </body>
</html>