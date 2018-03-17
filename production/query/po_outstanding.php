<?php

include("controller/session.php");
include("controller/doconnect.php");


$po_outstanding = "SELECT sum(qty * price) - sum(payment_amount)
FROM po_line_all pol,
ap_check_all aca
WHERE
aca.po_header_id = pol.po_header_id
and pol.po_header_id = '".$po_header_id."'
"


?>