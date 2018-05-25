    <link href="../vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    
    <!-- Custom styling plus plugins -->
    <link href="../build/css/custom.css" rel="stylesheet">
<?php
include("controller/doconnect.php");
echo "string";
echo "string";
echo "string";
?>
<div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_content">
                    <div class="row">
                      <div class="col-md-4"></div>
                      <div class="col-md-4">
                        <p align="center">CaseNation.Indo</p>
                        <p align="center">Jln. Marina Raya Ruko Exclusive</p>
                        <div class="row">
                          <div class="col-md-6">
                            19 Nov 2017<br>
                            Receipt Number<br>
                            Collected by
                          </div>
                          <div class="col-md-6 pull-right" style="text-align: right;">
                            14:14<BR>
                            D8WBB7<BR>
                            Novi Sumarto
                          </div>
                          <div class="clearfix"></div>
                          <hr style="margin-top: 2px;">
                          <div class="col-md-4">
                            Mario Case<br>
                            Supreme Case<br>
                          </div>
                          <div class="col-md-4" style="text-align: right;">
                            1x<br>
                            2x<br>
                          </div>
                          <div class="col-md-4" style="text-align: right;">
                            Rp. 100000<br>
                            Rp. 200000<br>
                          </div>
                          <div class="clearfix"></div>
                          <hr style="margin-top: 2px;">
                          <div class="col-md-6">
                          <p>Subtotal</p>
                          </div>
                          <div class="col-md-6 pull-right" style="text-align: right;">
                          <p>Rp.300000</p>
                          </div>
                          <div class="clearfix"></div>
                          <hr style="margin-top: 2px;">
                          <div class="col-md-6">
                          <h4 style="margin-top: -10px;"><b>Total</b></h4>
                          </div>
                          <div class="col-md-6 pull-right" style="text-align: right;">
                          <h4 style="margin-top: -10px;"><b>Rp.300000</b></h4>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <button type="submit" name="submit" value="Insert" class="btn btn-round btn-primary" onclick="window.print()"></button>

<br>
              <?php
                $sql1 = "SELECT sum(unit_price * qty) as amount , date_format(date,'%d-%m-%y') as date1
                FROM invoice 
                where
                date_format(date,'%d-%m-%Y') = date_format(sysdate(),'%d-%m-%Y')
                group by date_format(date,'%d-%m-%Y')";
                $result1 = $conn->query($sql1);
                while($row1 = $result1->fetch_assoc()) {
                                  
                if( $row1['amount'] >0 ) {
                  echo $row1['amount'];
                }
                else{
                  echo "0";
                }
              }

              echo "<br>";

          /*    $total = 0;
              $sql2 = "SELECT invoice_id ,count(*) as count , max(invoice_line_id)
                  FROM invoice 
                  where
                  date_format(date,'%d-%m-%Y') = date_format(sysdate(),'%d-%m-%Y')
                  group by invoice_id";
                  $result2 = $conn->query($sql2);
                  while($row2 = $result2->fetch_assoc()) {
                    echo $row2['invoice_id']; echo ",";
                    echo $row2['count'];   
                    echo "<br>";

                }*/

                // $query = "SELECT distinct date_format(date,'%M') as month , date_format(date,'%m') as a , date_format(sysdate(),'%m')  as b , DATE_FORMAT(date_add(sysdate(), INTERVAL - 5 MONTH),'%Y%m') as c
                //   FROM invoice 
                //   where month IS NOT NULL
                //   and date_format(date,'%Y%m') >= DATE_FORMAT(date_add(sysdate(), INTERVAL - 5 MONTH),'%Y%m')
                //   order by date 
                //   /*where
                //   date_format(date,'%d-%m-%Y') = date_format(sysdate(),'%d-%m-%Y')*/
                //   ";
                // $data=mysqli_query($conn,$query);   
                // while($row=mysqli_fetch_array($data)){                   
                //     echo "\"";echo $row['month'] ; echo "\"" ;echo ",";
                //     // echo "\"";echo $row['a'] ; echo "\"" ;echo ",";
                //     // echo "\"";echo $row['c'] ; echo "\"" ;echo ",";
                    
                // }

                // echo "<br>";

                // $query = "SELECT sum(qty*unit_price) as amount , month
                //   FROM invoice 
                //   where month IS NOT NULL
                //   group by month
                //   order by date 
                //   limit 6
                //   /*where
                //   date_format(date,'%d-%m-%Y') = date_format(sysdate(),'%d-%m-%Y')*/
                //   ";
                // $data=mysqli_query($conn,$query);   
                // while($row=mysqli_fetch_array($data)){                   
                //     echo $row['amount']  ;echo ",";                    
                // }

                // echo "<br>";

                //             $sql1 = "select datediff(date_format(sysdate(),'%Y-%m-%d'),'2018-05-01') as dess
                //             from dual
                //             ";
                //             $result1 = $conn->query($sql1);
                //             while($row1 = $result1->fetch_assoc()) {                                                               
                //               echo $row1['dess'];
                //           }


                  $query = "
                  SELECT sum(i.qty*i.unit_price)  as amount , 
                  date_format(ih.invoice_date,'%Y%m')
                  FROM invoice i,
                  invoice_header ih
                  where i.month IS NOT NULL
                  and ih.invoice_id = i.invoice_id
                  and ih.ledger_id = i.ledger_id
                  -- and date_format(ih.invoice_date,'%Y%m') >= DATE_FORMAT(date_add(sysdate(), INTERVAL - 5 MONTH),'%Y%m')
                  group by date_format(ih.invoice_date,'%Y%m')
                  order by date_format(ih.invoice_date,'%Y%m') 
                  ";
                $data=mysqli_query($conn,$query);   
                while($row=mysqli_fetch_array($data)){                   
                    echo $row['amount']  ;echo ",";                    
                }


?>


<form class="form-horizontal" action="controller/functions.php" method="POST" enctype="multipart/form-data">
                     <fieldset>
                              <!-- Form Name -->
                              <legend>MASS ADD CSV </legend>
       
                              <!-- File Button -->
                              <div class="form-group">
                                  <label class="col-md-4 control-label" for="filebutton">Select File</label>
                                  <div class="col-md-4">
                                      <input type="file" name="file" class="input-large">
                                  </div>
                              </div>
       
                              <!-- Button -->
                              <div class="form-group">
                                  <label class="col-md-4 control-label" for="singlebutton">Import data</label>
                                  <div class="col-md-4">
                                      <button type="submit" name="Import" value="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                                  </div>
                              </div>      
                       </fieldset>
                 </form>