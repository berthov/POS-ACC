<?php
  $sql1 = "SELECT sum(a.qty * a.cogs) as count
  FROM invoice a,
  invoice_header ih
  where 
  ih.invoice_id = a.invoice_id
  and ih.ledger_id = a.ledger_id
  and ih.ledger_id = '".$ledger_new."'
  and ih.refund_status not in  ('Yes')
  and date_format(ih.invoice_date,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'
  ";

  $result1 = $conn->query($sql1);
  while($row1 = $result1->fetch_assoc()) {                                                               
    if($row1['count'] > 0 ) {
      echo number_format($row1['count']);

    }
    else{
      echo "0";
    }
  }
?>
