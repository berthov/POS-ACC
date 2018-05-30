<?php
	
	
    $user_check_ledger = "SELECT a.ledger_id as ledger FROM employee a WHERE a.name = '".$user_check."'"; 
    $result_ledger = mysqli_query($conn,$user_check_ledger);
    $existing_ledger = mysqli_fetch_assoc($result_ledger);

    $ledger_new =  $existing_ledger['ledger'];

    // $user_check_outlet = "SELECT b.outlet_id as outlet FROM employee a , outlet b	
    // WHERE a.name = '".$user_check."' 
    // and a.ledger_id = b.ledger_id	
    // and a.outlet_id = b.outlet_id"; 
    // $result_outlet = mysqli_query($conn,$user_check_outlet);
    // $existing_outlet = mysqli_fetch_assoc($result_outlet);

    // $outlet_new =  $existing_outlet['outlet'];

?>