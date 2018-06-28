<?php

if($outlet_billing_status === 'Trial' || $outlet_expiration_date < date('Y-m-d') ){
   header("Location:billing.php");
}

?>