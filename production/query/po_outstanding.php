<?php


$po_outstanding = "SELECT sum(pol.qty * pol.price) - SUM(COALESCE(payment_amount,0))  as outstanding
FROM po_line_all pol
LEFT JOIN ap_check_all aca ON aca.po_header_id = pol.po_header_id
where
pol.po_header_id = '".$po_header_id."'
";

$result_outstanding = $conn->query($po_outstanding);
while($row_outstanding = $result_outstanding->fetch_assoc()) {
echo $row_outstanding["outstanding"];
}

?>
