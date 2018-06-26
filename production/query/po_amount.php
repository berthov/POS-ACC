<?php


$po_amount = "SELECT (sum(pol.qty * pol.price)) + (sum(pol.qty * pol.price) * asa.tax)   as amount
FROM po_line_all pol,
po_header_all poh,
ap_supplier_all asa
where
poh.po_header_id = pol.po_header_id
and asa.party_id = poh.supplier
and pol.po_header_id = '".$po_header_id."'
";

$result_amount = $conn->query($po_amount);
while($row_amount = $result_amount->fetch_assoc()) {
echo "Rp."; echo number_format($row_amount["amount"]);
}

?>