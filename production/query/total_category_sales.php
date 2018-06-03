<?php
if ($p_outlet === '') {

	$sql1 = "SELECT sum(a.qty*a.unit_price) as gross_sales , 
	sum(a.qty) as qty , 
	sum(a.qty * a.cogs) as cogs , 
	sum(a.qty*a.unit_price)- sum(a.cogs * a.qty) as gross_profit
	FROM invoice a,
	inventory b,
	invoice_header ih
	where a.inventory_item_id = b.id
	and date_format(ih.invoice_date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
	and a.ledger_id = '".$ledger_new."'
	and a.ledger_id = b.ledger_id
	and ih.invoice_id = a.invoice_id
	and ih.ledger_id = a.ledger_id
	and ih.refund_status not in  ('Yes')
	";
}
else
{

	$sql1 = "SELECT sum(a.qty*a.unit_price) as gross_sales , 
	sum(a.qty) as qty , 
	sum(a.qty * a.cogs) as cogs , 
	sum(a.qty*a.unit_price)- sum(a.cogs * a.qty) as gross_profit
	FROM invoice a,
	inventory b,
	invoice_header ih
	where a.inventory_item_id = b.id
	and date_format(ih.invoice_date,'%Y-%m-%d') between '".$p_start_date."' and '".$p_end_date."'
	and a.ledger_id = '".$ledger_new."'
	and a.ledger_id = b.ledger_id
	and ih.invoice_id = a.invoice_id
	and ih.ledger_id = a.ledger_id
	and ih.outlet_id = '".$p_outlet."' 
	and ih.refund_status not in  ('Yes')
	";

}
?>