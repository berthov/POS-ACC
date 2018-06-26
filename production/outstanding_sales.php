<!DOCTYPE html>

<?php
session_start();
include("controller/doconnect.php");
include("controller/session.php");
include("query/find_ledger.php");
include("query/redirect_billing.php");

$start_date = date('Y-m-d');
$end_date = date('Y-m-d');
if(isset($_REQUEST['reservation'])){
  $start_date = date('Y-m-d',strtotime(substr($_REQUEST['reservation'], 0,10))) ;
}

if(isset($_REQUEST['reservation'])){
  $end_date = date('Y-m-d',strtotime(substr($_REQUEST['reservation'], 13,10))) ;
}

if(isset($_REQUEST['outlet_id']) && $_REQUEST['outlet_id'] !='all' ){
  $p_outlet = $_REQUEST['outlet_id'];
}
else{
 $p_outlet = ''; 
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
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                 <div class="row x_title"> 
                   <div class="col-lg-12 col-md-12 col-xs-12">
                      <h2>Outstanding Sales Each Month</h2>
                      <div class="clearfix"></div>
                    </div>
                    <form class="form-horizontal" action="outstanding_sales.php" method="post">

                    <div class="col-lg-3 col-md-3 col-xs-4">
                        
                        <select name="outlet_id" id="category" class="form-control col-lg-3 col-md-3 col-xs-4 category">
                          <option value="" disabled selected >Select Outlet</option>
                          <option value="all">All Outlet</option>
                          
                           <?php
                            $sql = "SELECT distinct outlet_id,name 
                            FROM outlet
                            where ledger_id = '".$ledger_new."' 
                            ";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {
                          ?>
                              <option value="<?php echo $row["outlet_id"] ?>"> <?php echo $row["name"] ?></option>
                          <?php
                            }
                          ?>

                          </select>
                      </div>
                  </div>
 
                  <div class="x_content">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>Period</th>
                          <th>Invoice Amount</th>
                          <th>Real</th>
                          <th>Outstanding</th>
                        </tr>

                        <?php
                            include("query/outstanding_sales.php");
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {                                                               

                        ?>

                        <tr>
                          <th scope="row"><?php echo $row['period']; ?></th>
                          <td><?php echo "Rp."; echo number_format($row['invoice_amount']); ?></td>
                          <td><?php echo "Rp."; echo number_format($row['amount']); ?></td>
                          <td><?php echo "Rp."; echo number_format($row['outstanding']); ?></td>
                        </tr>

                        <?php
                          }
                        ?>

                        
                      </tbody>
                    </table>
                  </div>
                  </form>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12"> 
                  <form class="form-horizontal" action="controller/export_index_csv.php" method="post" name="outstanding_sales" enctype="multipart/form-data">
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="singlebutton">Excel Export</label>
                      <div class="col-md-4">
                          <input type="submit" name="outstanding_sales" class="btn btn-success" value="Export to excel"/>
                      </div>
                    </div>                    
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
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
    <script type="text/javascript">
  
    $(document).ready(function(){
              $("#category").on("change", function() {
                this.form.submit();
              });
    });
    </script>

  </body>
</html>