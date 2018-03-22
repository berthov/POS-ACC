<?php
   include("doconnect.php");
   
   $user_check = $_SESSION['login_user'];
   if($user_check == null){
      header("location: login.php");
   }
   
   $sqlsession = mysqli_query($conn,"select name from employee where name = '$user_check' ");
   
   $row = mysqli_fetch_array($sqlsession,MYSQLI_ASSOC);
   if (!$row) {
		    printf("Error: %s\n", mysqli_error($conn));
		    exit();
		}
   
   $login_session = $row['name'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>