<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include("controller/session.php");
include("controller/doconnect.php");
include("query/find_ledger.php");


$p_start_date = date('Y-m-d');
$p_end_date = date('Y-m-d');
if(isset($_REQUEST['reservation'])){
  $p_start_date = date('Y-m-d',strtotime(substr($_REQUEST['reservation'], 1,10))) ;
}

if(isset($_REQUEST['reservation'])){
  $p_end_date = date('Y-m-d',strtotime(substr($_REQUEST['reservation'], 14,10))) ;
}
?>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bonne Journée </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
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
              <div class="col-md-10 col-sm-10 col-xs-12">
                <div class="x_panel">
                 <div class="row x_title"> 
                   <div class="col-md-4">
                      <h2>Payment Method</h2>
                      <div class="clearfix"></div>
                    </div>
                   <div class="col-md-12">
                          <form class="form-horizontal">
                            <fieldset>
                              <div class="control-group" >
                                <div class="controls" >
                                  <div class="input-prepend input-group">
                                    <input type="text" style="width: 200px" name="reservation" id="reservation" class="form-control pull-right"/>
                                    <span class="add-on input-group-addon">
                                      <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                  </div>
                                </div>
                              </div>
                            </fieldset>
                    </div>
                  </div>
 
                  <div class="x_content">
                    <table class="table ">
                      <tbody>
                        <tr>
                          <td align="left">Payment method</td>
                          <td align="center">Number Of Transaction</td>
                          <td align="right">Total Collected</td>
                        </tr>
                        <tr>
                          <td align="left">Cash</td>
                          <td align="center">
                            <?php
                            $sql1 = "SELECT count(aca.payment_id) as count
                            FROM invoice_header a,
                            ar_check_all aca
                            where
                            a.ledger_id = '".$ledger_new."'
                            and aca.invoice_id = a.invoice_id
                            and aca.payment_type = 'Cash'
                            and a.refund_status not in  ('Yes')
                            and date_format(a.invoice_date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                            ";
                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {                                                               
                              echo $row1['count'];
                          }
                          ?>
                          </td>
                          <td align="right">Rp.
                           <?php
                              $sql1 = "SELECT sum(a.unit_price*a.qty) -   
                                (select sum(ih_1.discount_amount)
                                from invoice_header ih_1
                                where 
                                ih_1.ledger_id = ih.ledger_id
                                and ih_1.refund_status not in ('Yes')) + 
                                (
                                SELECT sum(a.tax_amount) -
                                (select sum(ih_1.discount_amount*ih_1.tax_code)
                                from invoice_header ih_1
                                where 
                                ih_1.ledger_id = ih.ledger_id
                                and ih_1.refund_status not in ('Yes')) as count  
                                FROM invoice a,
                                invoice_header ih
                                where
                                date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                                and ih.ledger_id = '".$ledger_new."'
                                and ih.ledger_id = a.ledger_id
                                and ih.invoice_id = a.invoice_id
                                and ih.refund_status not in ('Yes')
                                )as count
                                FROM invoice a ,
                                invoice_header ih
                                where
                                date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                                and ih.ledger_id = '".$ledger_new."'
                                and ih.ledger_id = a.ledger_id
                                and ih.invoice_id = a.invoice_id
                                and ih.payment_method = 'Cash'
                                and ih.refund_status not in ('Yes')
                                ";
                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {                                                               
                              echo number_format($row1['count']);
                          }
                          ?>
                            
                          </td>
                        </tr>
                        <tr>
                          <td align="left">Debit / Credit</td>
                          <td align="center">
                            <?php
                            $Credit_Debit = "Debit/Credit";

                            $sql1 = "SELECT count(aca.payment_id) as count
                            FROM invoice_header a,
                            ar_check_all aca
                            where
                            a.ledger_id = '".$ledger_new."'
                            and aca.invoice_id = a.invoice_id
                            and a.payment_method = 'Debit/Credit'
                            and a.refund_status not in  ('Yes')
                            and date_format(a.invoice_date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                            ";
                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {                                                               
                              echo $row1['count'];
                          }
                            ?>
                          </td>
                          <td align="right">Rp.
                                                                                <?php

                            $Credit_Debit = "Debit/Credit";

                              $sql1 = "SELECT sum(a.unit_price*a.qty) -   
                                (select sum(ih_1.discount_amount)
                                from invoice_header ih_1
                                where 
                                ih_1.ledger_id = ih.ledger_id
                                and ih_1.refund_status not in ('Yes')) + 
                                (
                                SELECT sum(a.tax_amount) -
                                (select sum(ih_1.discount_amount*ih_1.tax_code)
                                from invoice_header ih_1
                                where 
                                ih_1.ledger_id = ih.ledger_id
                                and ih_1.refund_status not in ('Yes')) as count  
                                FROM invoice a,
                                invoice_header ih
                                where
                                date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                                and ih.ledger_id = '".$ledger_new."'
                                and ih.ledger_id = a.ledger_id
                                and ih.invoice_id = a.invoice_id
                                and ih.refund_status not in ('Yes')
                                )as count
                                FROM invoice a ,
                                invoice_header ih
                                where
                                date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                                and ih.ledger_id = '".$ledger_new."'
                                and ih.ledger_id = a.ledger_id
                                and ih.invoice_id = a.invoice_id
                                and ih.payment_method = 'Debit/Credit'
                                and ih.refund_status not in ('Yes')
                                ";
                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {                                                               
                              echo number_format($row1['count']);
                          }
                          ?></td>
                        </tr>
                        <tr>
                          <td align="left"><b>Total</b></td>
                          <td align="center"><b>
                            <?php
                            $sql1 = "SELECT count(aca.payment_id) as count
                            FROM invoice_header a,
                            ar_check_all aca
                            where
                            a.ledger_id = '".$ledger_new."'
                            and aca.invoice_id = a.invoice_id
                            and a.refund_status not in  ('Yes')
                            and date_format(a.invoice_date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                            ";
                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {                                                               
                              echo $row1['count'];
                          }
                          ?>
                          </b></td>
                          <td align="right"><b>Rp.
                            <?php
                              $sql1 = "SELECT sum(a.unit_price*a.qty) -   
                                (select sum(ih_1.discount_amount)
                                from invoice_header ih_1
                                where 
                                ih_1.ledger_id = ih.ledger_id
                                and ih_1.refund_status not in ('Yes')) + 
                                (
                                SELECT sum(a.tax_amount) -
                                (select sum(ih_1.discount_amount*ih_1.tax_code)
                                from invoice_header ih_1
                                where 
                                ih_1.ledger_id = ih.ledger_id
                                and ih_1.refund_status not in ('Yes')) as count  
                                FROM invoice a,
                                invoice_header ih
                                where
                                date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                                and ih.ledger_id = '".$ledger_new."'
                                and ih.ledger_id = a.ledger_id
                                and ih.invoice_id = a.invoice_id
                                and ih.refund_status not in ('Yes')
                                )as count
                                FROM invoice a ,
                                invoice_header ih
                                where
                                date_format(a.date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
                                and ih.ledger_id = '".$ledger_new."'
                                and ih.ledger_id = a.ledger_id
                                and ih.invoice_id = a.invoice_id
                                and ih.refund_status not in ('Yes')
                                ";
                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {                                                               
                              echo number_format($row1['count']);
                          }
                          ?></b></td>
                        </tr>
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
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
    <script type="text/javascript">
  
    $(document).ready(function(){
              $("#reservation").on("change", function() {
                this.form.submit();
              });
    });
    </script>

  </body>
</html>