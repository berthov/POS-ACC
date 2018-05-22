<?php
  $sql = "SELECT sum(aca.payment_amount) as amount  
  FROM ar_check_all aca,
  invoice_header ih 
  where
  date_format(aca.payment_date,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'
  and ih.ledger_id = '".$ledger_new."'
  and aca.invoice_id = ih.invoice_id
  and ih.refund_status not in ('Yes')
  ";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {                                                               
     
      if($row['amount'] > 0 ) {
        // echo $row1['amount'];
        echo number_format($row['amount']);

      }
      else{
        echo "0";
      }
  }
?>