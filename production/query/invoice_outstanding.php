<?php

$invoice_outstanding = "SELECT sum(i.qty * i.unit_price) - (SELECT SUM(PAYMENT_AMOUNT) FROM ar_check_all aca
WHERE aca.invoice_id = i.invoice_id) as outstanding
FROM
invoice I
WHERE
i.invoice_id = '".$invoice_id."'
";

$result_outstanding = $conn->query($invoice_outstanding);
while($row_outstanding = $result_outstanding->fetch_assoc()) {
echo $row_outstanding["outstanding"];
}

?>
