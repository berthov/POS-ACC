<!DOCTYPE html>

<?php
session_start();
include("controller/doconnect.php");
include("controller/session.php");
include("query/find_ledger.php");

$start_date = date('Y-m-d');
$end_date = date('Y-m-d');
if(isset($_REQUEST['reservation'])){
  $start_date = date('Y-m-d',strtotime(substr($_REQUEST['reservation'], 1,10))) ;
}

if(isset($_REQUEST['reservation'])){
  $end_date = date('Y-m-d',strtotime(substr($_REQUEST['reservation'], 14,10))) ;
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
        <?php include("view/sidebar.php"); ?>
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
                   <div class="col-md-4 col-xs-12">
                      <h2>Outstanding Sales Each Month</h2>
                      <div class="clearfix"></div>
                    </div>
                  </div>
 
                  <div class="x_content">
                    <table class="table ">
                      <tbody>
                        <tr>
                          <th>Period</th>
                          <th>Invoice Amount</th>
                          <th>Real</th>
                          <th>Outstanding</th>
                        </tr>

                        <?php
                          $sql = "SELECT date_format(ih.invoice_date,'%M-%y') as period,
                        (
                          select sum(aca.payment_amount)
                          from
                          ar_check_all aca,
                          invoice_header ih1
                          where 
                          aca.invoice_id = ih1.invoice_id
                          and ih.ledger_id = ih1.ledger_id
                          and ih1.refund_status not in ('Yes')
                          and date_format(ih.invoice_date,'%M-%y') = date_format(ih1.invoice_date,'%M-%y')
                        )as amount,
                        (
                          select sum(i2.qty*i2.unit_price)
                          from
                          invoice i2,
                          invoice_header ih2
                          where 
                          i2.invoice_id = ih2.invoice_id
                          and ih2.ledger_id = ih.ledger_id
                          and ih2.refund_status not in ('Yes')
                          and date_format(ih.invoice_date,'%M-%y') = date_format(ih2.invoice_date,'%M-%y')
                        )as invoice_amount,
                        (
                          select sum(ih3.amount_due_remaining)
                          from
                          invoice_header ih3
                          where 
                          ih3.ledger_id = ih.ledger_id
                          and ih3.refund_status not in ('Yes')
                          and date_format(ih.invoice_date,'%M-%y') = date_format(ih3.invoice_date,'%M-%y')
                        )as outstanding
                          FROM 
                          invoice_header ih 
                          where
                          ih.ledger_id = '".$ledger_new."'
                          and ih.refund_status not in ('Yes')
                          group by 
                          date_format(ih.invoice_date,'%M-%y')
                          order by 
                          date_format(ih.invoice_date,'%m%Y') asc
                          limit 12
                          ";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {                                                               

                        ?>

                        <tr>
                          <th scope="row"><?php echo $row['period']; ?></th>
                          <td><?php echo number_format($row['invoice_amount']); ?></td>
                          <td><?php echo number_format($row['amount']); ?></td>
                          <td><?php echo number_format($row['outstanding']); ?></td>
                        </tr>

                        <?php
                          }
                        ?>

                        
                      </tbody>
                    </table>
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
	

  </body>
</html>