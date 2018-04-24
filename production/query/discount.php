<?php
  $sql = "SELECT sum(discount_amount) as amount  
  FROM invoice_header a 
  where
  date_format(a.invoice_date,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'
  and ledger_id = '".$ledger_new."'
  and a.refund_status not in ('Yes')
  ";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {                                                               
     
      if($row['amount'] > 0 ) {
        echo number_format($row['amount']);
      }
      else{
        echo "0";
      }
  }
?>