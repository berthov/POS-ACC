<?php


$invoice_outstanding = "SELECT sum(i.qty * i.unit_price) - SUM(COALESCE(payment_amount,0))  as outstanding
FROM invoice i
LEFT JOIN ar_check_all aca ON i.invoice_id = aca.invoice_id
WHERE
I.invoice_id = '".$invoice_id."'
";

$result_outstanding = $conn->query($invoice_outstanding);
while($row_outstanding = $result_outstanding->fetch_assoc()) {
echo $row_outstanding["outstanding"];
}

?>
