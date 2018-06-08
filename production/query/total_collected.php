<?php
 
  $sql="SELECT
  sum(a.unit_price*a.qty) -   
  (select sum(ih_1.discount_amount)
  from invoice_header ih_1
  where 
  ih_1.ledger_id = ih.ledger_id
  and (ih_1.outlet_id = '".$p_outlet."' or  ('".$p_outlet."' = '' ) ) 
  and ih_1.refund_status not in ('Yes')) + 
  (
  SELECT sum(a.tax_amount) -
  (select sum(ih_1.discount_amount*ih_1.tax_code)
  from invoice_header ih_1
  where 
  ih_1.ledger_id = ih.ledger_id
  and (ih_1.outlet_id = '".$p_outlet."' or  ('".$p_outlet."' = '' ) ) 
  and ih_1.refund_status not in ('Yes')) as amount  
  FROM invoice a,
  invoice_header ih
  where
  date_format(a.date,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'
  and ih.ledger_id = '".$ledger_new."'
  and (ih.outlet_id = '".$p_outlet."' or  ('".$p_outlet."' = '' ) ) 
  and ih.ledger_id = a.ledger_id
  and ih.invoice_id = a.invoice_id
  and ih.refund_status not in ('Yes')
  )as amount
  FROM invoice a ,
  invoice_header ih
  where
  date_format(a.date,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'
  and ih.ledger_id = '".$ledger_new."'
  and (ih.outlet_id = '".$p_outlet."' or  ('".$p_outlet."' = '' ) ) 
  and ih.ledger_id = a.ledger_id
  and ih.invoice_id = a.invoice_id
  and ih.refund_status not in ('Yes')";

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