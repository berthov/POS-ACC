<?php

	include("doconnect.php");
	session_start();

	if(isset($_POST['reg_user'])){

		$usernameregister = mysqli_escape_string($conn, $_POST['username']);
		$passwordregister = md5(mysqli_escape_string($conn, $_POST['password']));
		$cpasswordregister = md5(mysqli_escape_string($conn, $_POST['cpassword']));
		$emailregister = mysqli_escape_string($conn, $_POST['email']);
		//$roleregister = mysqli_escape_string($conn, $_POST['role']);
		$outletregister = mysqli_escape_string($conn, $_POST['outlet']);
		$created = date("Y-m-d H:i:s");

		$user_check_sql = "SELECT * FROM employee WHERE name = '$usernameregister' OR email='$emailregister' ";
		$result = mysqli_query($conn,$user_check_sql);
		$existing_user = mysqli_fetch_assoc($result);

		if($passwordregister == $cpasswordregister){
			if ($existing_user) { 
			    if ($existing_user['name'] === $usernameregister) {
			      ?>
					<script type="text/javascript">
						alert("Username already exist");
						window.location = "http://localhost:8085/POS-ACC/production/login.php#signup";
					</script>
			    <?php
			    }

			    if ($existing_user['email'] === $emailregister) {
			     ?>
					<script type="text/javascript">
						alert("Email already exist");
						window.location = "http://localhost:8085/POS-ACC/production/login.php#signup";
					</script>
			    <?php
			    }
			    
			}

			else {

				$sql = "INSERT INTO employee (name, role, email, outlet_id, employee_id, created_by, last_update_by, created_date, last_update_date, password) VALUES ('$usernameregister', 'Admin', '$emailregister', '$outletregister', NULL, NULL, NULL, '$created', NULL, '$passwordregister')";
	  			$result = mysqli_query($conn, $sql);
				header("location: ../login.php");
			}
		} else {
			?>
				<script type="text/javascript">
					alert("Password did not match");
					window.location = "http://localhost:8085/POS-ACC/production/login.php#signup";
				</script>
			<?php
		}
		
	}

?>