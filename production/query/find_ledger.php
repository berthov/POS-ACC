<?php

    $user_check_ledger = "SELECT a.ledger_id as ledger FROM employee a WHERE a.name = '".$user_check."'"; 
    $result_ledger = mysqli_query($conn,$user_check_ledger);
    $existing_ledger = mysqli_fetch_assoc($result_ledger);

    $ledger_new =  $existing_ledger['ledger'];           

?>