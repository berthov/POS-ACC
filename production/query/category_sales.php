<?php
if ($p_outlet === '') {

       $sql1 = "SELECT 
       b.category,
       sum(a.qty*a.unit_price) as gross_sales , 
       sum(a.qty*a.unit_price) as net_sales , 
       sum(a.qty) as qty , 
       -- b.description , 
       sum(a.cogs * a.qty) as cogs , 
       sum(a.qty*a.unit_price)- sum(a.cogs * a.qty) as gross_profit 
       FROM invoice a,
       inventory b,
       invoice_header ih
       where a.inventory_item_id = b.id
       and date_format(ih.invoice_date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
       and a.ledger_id = '".$ledger_new."'
       and a.ledger_id = b.ledger_id
       and ih.invoice_id = a.invoice_id
       and ih.refund_status NOT IN ('Yes')
       and ih.ledger_id = a.ledger_id
       group by 
       b.category
       ";
}
else{

       $sql1 = "SELECT 
       b.category,
       sum(a.qty*a.unit_price) as gross_sales , 
       sum(a.qty*a.unit_price) as net_sales , 
       sum(a.qty) as qty , 
       -- b.description , 
       sum(a.cogs * a.qty) as cogs , 
       sum(a.qty*a.unit_price)- sum(a.cogs * a.qty) as gross_profit 
       FROM invoice a,
       inventory b,
       invoice_header ih
       where a.inventory_item_id = b.id
       and date_format(ih.invoice_date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
       and a.ledger_id = '".$ledger_new."'
       and a.ledger_id = b.ledger_id
       and ih.invoice_id = a.invoice_id
       and ih.refund_status NOT IN ('Yes')
       and ih.ledger_id = a.ledger_id
       and ih.outlet_id = '".$p_outlet."'
       group by 
       b.category
       ";

}
?>