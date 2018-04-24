<?php
  $sql = "SELECT sum(a.unit_price*a.qty) as amount  
  FROM invoice a,
  invoice_header ih 
  where
  ih.refund_status not in ('Yes')
  and date_format(a.date,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'
  and a.ledger_id = '".$ledger_new."'
  and a.invoice_id = ih.invoice_id
  and a.ledger_id = ih.ledger_id
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