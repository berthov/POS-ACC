<?php

	include("doconnect.php");
	session_start();

	if($_SERVER["REQUEST_METHOD"]=="POST"){

		$usernamelogin = mysqli_escape_string($conn1, $_POST['username']);
		$passwordlogin = md5(mysqli_escape_string($conn1, $_POST['password']));
		$firstLogin = false;

		$sql = "SELECT employee_id, role FROM employee WHERE BINARY name = '$usernamelogin' and password = '$passwordlogin'";
		$result = mysqli_query($conn1,$sql);

		//check query
		/*if (!$result) {
		    printf("Error: %s\n", mysqli_error($conn));
		    exit();
		}*/

      	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      	//$active = $row['active'];
      
      	$count = mysqli_num_rows($result);
      	
      	if($count == 1) {
        	$_SESSION['login_user'] = $usernamelogin;
        	$userRole = $row['role'];
        	$_SESSION['userRole'] = $userRole;
        	$firstLogin = true;
        	$_SESSION['firstLogin'] = $firstLogin;
        	if ($_SESSION['userRole'] == "Admin"){
        		echo 'success';
        	} else if ($_SESSION['userRole'] == "Staff") {
        		echo 'successStaff';
        	}
      	} else {
      		echo 'error';
     	}
	}

	if (isset($_REQUEST['logstate'])) {
		if (ini_get("session.use_cookies")) {
		    $params = session_get_cookie_params();
		    setcookie(session_name(), '', time() - 42000,
		        $params["path"], $params["domain"],
		        $params["secure"], $params["httponly"]
		    );
		}  
      	session_destroy(); 

		session_start();
      	$logout = true;
		$_SESSION['logout'] = $logout;

	    header("location: login.php");
	}

?>