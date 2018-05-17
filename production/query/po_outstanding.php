<?php


$po_outstanding = "SELECT sum(pol.qty * pol.price) amount
, 
(select SUM(COALESCE(payment_amount,0)) 
from ap_check_all aca
where
aca.po_header_id = pol.po_header_id) as payment
FROM po_line_all pol
where
pol.po_header_id = '".$po_header_id."'
";

$result_outstanding = $conn->query($po_outstanding);
while($row_outstanding = $result_outstanding->fetch_assoc()) {
echo $row_outstanding["amount"] - $row_outstanding["payment"];
}

?>

