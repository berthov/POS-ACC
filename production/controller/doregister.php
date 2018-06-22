<?php
	include("doconnect.php");
	session_start();

	if($_SERVER["REQUEST_METHOD"]=="POST"){

		$usernameregister = mysqli_escape_string($conn1, $_POST['username']);
		$passwordregister = md5(mysqli_escape_string($conn1, $_POST['password']));
		$cpasswordregister = md5(mysqli_escape_string($conn1, $_POST['cpassword']));
		$emailregister = mysqli_escape_string($conn1, $_POST['email']);
		$outletregister = mysqli_escape_string($conn1, $_POST['outlet']);
		$created = date("Y-m-d");
		$ledger = date("mdhs");
		$expiration_date = date("Y-m-d", strtotime("+14 days"));

		$user_check_sql = "SELECT * FROM employee WHERE name = '$usernameregister' OR email='$emailregister' ";
		$result = mysqli_query($conn1,$user_check_sql);
		$existing_user = mysqli_fetch_assoc($result);

		if($passwordregister == $cpasswordregister){
			if ($existing_user) { 
			    if ($existing_user['name'] === $usernameregister) {
			      echo 'Username already exist';
			    }

			    else if ($existing_user['email'] === $emailregister) {
					echo 'Email already exist';
			    }
			}

			else {
				$roleregister = "Admin";
				$undefined = "Undefined";
				$status = "Active";
				$sql_outlet = "INSERT INTO outlet (name, address, phone, city, province, outlet_id, postal_code ,date_founded,email,last_update_by, created_by,created_date, last_update_date, status,ledger_id,billing_status,expiration_date) VALUES ('$outletregister', '$undefined', '$undefined', '$undefined', '$undefined', NULL, '$undefined', '$created', '$undefined','$usernameregister','$usernameregister','$created','$created','$status','$ledger','Trial','$expiration_date')";
	  			$result = mysqli_query($conn1, $sql_outlet);	  			

	  			$sql_outlet_id = "SELECT outlet_id FROM outlet WHERE ledger_id = '$ledger'";
	  			$result_outlet = mysqli_query($conn1, $sql_outlet_id);
	  			$existing_outlet = mysqli_fetch_assoc($result_outlet);


				$sql = "INSERT INTO employee (name, role, email, outlet_id, employee_id, created_by, last_update_by, created_date, last_update_date, password,ledger_id) VALUES ('$usernameregister', '$roleregister', '$emailregister', '".$existing_outlet['outlet_id']."', NULL, NULL, NULL, '$created', NULL, '$passwordregister','$ledger')";
	  			$result = mysqli_query($conn1, $sql);

				header("location: ../login.php");
			}

		} else {
			echo 'password did not match';
		}
		
	}
?>