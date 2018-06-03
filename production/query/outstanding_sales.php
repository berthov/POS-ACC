<?php

if ($p_outlet === '') {

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
}
else{

      $sql = "SELECT date_format(ih.invoice_date,'%M-%y') as period,
  (
    select sum(aca.payment_amount)
    from
    ar_check_all aca,
    invoice_header ih1
    where 
    aca.invoice_id = ih1.invoice_id
    and ih.ledger_id = ih1.ledger_id
    and ih1.outlet_id = ih.outlet_id
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
    and ih2.outlet_id = ih.outlet_id
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
    and ih3.outlet_id = ih.outlet_id
    and ih3.refund_status not in ('Yes')
    and date_format(ih.invoice_date,'%M-%y') = date_format(ih3.invoice_date,'%M-%y')
  )as outstanding
    FROM 
    invoice_header ih 
    where
    ih.ledger_id = '".$ledger_new."'
    and ih.outlet_id = '".$p_outlet."'
    and ih.refund_status not in ('Yes')
    group by 
    date_format(ih.invoice_date,'%M-%y')
    order by 
    date_format(ih.invoice_date,'%m%Y') asc
    limit 12
    ";
}

?>