<?php
	include("doconnect.php");
	session_start();

	if($_SERVER["REQUEST_METHOD"]=="POST"){

		$usernameregister = mysqli_escape_string($conn, $_POST['username']);
		$passwordregister = md5(mysqli_escape_string($conn, $_POST['password']));
		$cpasswordregister = md5(mysqli_escape_string($conn, $_POST['cpassword']));
		$emailregister = mysqli_escape_string($conn, $_POST['email']);
		$outletregister = mysqli_escape_string($conn, $_POST['outlet']);
		$created = date("Y-m-d H:i:s");
		$ledger = date("mdhs");

		$user_check_sql = "SELECT * FROM employee WHERE name = '$usernameregister' OR email='$emailregister' ";
		$result = mysqli_query($conn,$user_check_sql);
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
				$sql = "INSERT INTO employee (name, role, email, outlet_id, employee_id, created_by, last_update_by, created_date, last_update_date, password,ledger_id) VALUES ('$usernameregister', '$roleregister', '$emailregister', '$outletregister', NULL, NULL, NULL, '$created', NULL, '$passwordregister','$ledger')";
	  			$result = mysqli_query($conn, $sql);

				$sql_outlet = "INSERT INTO outlet (name, address, phone, city, province, outlet_id, postal_code ,date_founded,email,last_update_by, created_by,created_date, last_update_date, status,ledger_id) VALUES ('$outletregister', '$undefined', '$undefined', '$undefined', '$undefined', NULL, '$undefined', '$created', '$undefined','$usernameregister','$usernameregister','$created','$created','$status','$ledger')";
	  			$result = mysqli_query($conn, $sql_outlet);	  			

				header("location: ../login.php");
			}

		} else {
			echo 'password did not match';
		}
		
	}
?>