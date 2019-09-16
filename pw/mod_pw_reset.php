<?php
require_once("../admin/lib/dbconnection.php");


	if(isset($_POST["uname"])){
		$uname = $_POST["uname"];
		$cpass = $_POST["cpass"];
		$pass = $_POST["pass"];



		$dbobj = DB::connect();
		$sql = "SELECT emp_email FROM tbl_employee WHERE emp_id='$cpass';";
		$result = $dbobj->query($sql);

		$nor = $result->num_rows;

		if($nor==0){
			echo("0,Invalid Current password");
		}
		else{
			$rec = $result->fetch_assoc();
			$email = $rec["emp_email"];
			if($uname!=md5($rec['emp_email'])){
				echo("0,Invalid current Password");
			}
			else{
				$sql = "UPDATE tbl_users SET usr_pass=?,pwd_reset=? WHERE usr_name=?;";

				$stmt = $dbobj->prepare($sql);
				$pass = md5($pass);
				$reset = 0;
				$stmt->bind_param("sis",$pass,$reset,$email);

				if(!$stmt->execute()){
				echo("0,SQL Error : ".$stmt->error);
				}
				else{
					echo("1,Password reset successfully!");
				}

				$stmt->close();
			
			}

		}
		$dbobj->close();

	}

?>