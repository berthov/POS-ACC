<?php
date_default_timezone_set('Asia/Jakarta');	

    
 // if (1===1) {

    $servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "acc_test";

//  }

//  else{
//     $servername = "iix27.rumahweb.com";
// 	$username = "fris6556";
// 	$password = "cZZTmVpn2tXW44";
// 	$dbname = "fris6556_acc_test";
// }
	$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>