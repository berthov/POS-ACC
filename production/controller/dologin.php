<?php

	include("doconnect.php");
	session_start();

	if($_SERVER["REQUEST_METHOD"]=="POST"){

		$usernamelogin = mysqli_escape_string($conn, $_POST['username']);
		$passwordlogin = md5(mysqli_escape_string($conn, $_POST['password']));

		$sql = "SELECT employee_id FROM employee WHERE name = '$usernamelogin' and password = '$passwordlogin'";
		$result = mysqli_query($conn,$sql);

		//check query
		/*if (!$result) {
		    printf("Error: %s\n", mysqli_error($conn));
		    exit();
		}*/

      	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      	$active = $row['active'];
      
      	$count = mysqli_num_rows($result);
      	
      	// If result matched $myusername and $mypassword, table row must be 1 row
		
      	if($count == 1) {
        	
        	$_SESSION['login_user'] = $usernamelogin;
        	header("location: ../index.php");
      	}else {
      		?>
			  <script type="text/javascript">
			    alert("Wrong Username or Password");
			  	window.location = "http://localhost:8085/POS-ACC/production/login.php";
			  </script>
			<?php
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
	    header("location: login.php");
	}

?>