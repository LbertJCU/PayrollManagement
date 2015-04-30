<?php
	session_start();
	require 'PHPMailerAutoload.php';
	$connect=mysql_connect("localhost","root","");
	if (!$connect) {
		die("Cannot connect to the server");
	}
	$db=mysql_select_db("payroll",$connect);
	if (!$db) {
		die("Cannot read the database");
	}
	if (isset($_POST['ask'])) {
		$email=$_POST['accmail'];
		$person=mysql_fetch_array(mysql_query("SELECT * FROM employee WHERE EMP_EMAIL = '".$email."'"));
		if ($person==false) echo "E-mail not found";
		else if ($person==true) {
			$personName=$person['EMP_FNAME']." ".$person['EMP_LNAME'];
			$personMail=$person['EMP_EMAIL'];
			$personPassword=$person['PASSWORD'];
			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true; 
			$mail->Username = 'sptpayrollsystem@gmail.com';  
			$mail->Password = 'payrollmanage';
			$mail->SMTPSecure = 'tls';
			$mail->Port = 587;
			$mail->setFrom('sptpayrollsystem@gmail.com', 'Support for Payroll Management System');
			$mail->addAddress($personMail, $personName);
			$mail->isHTML(true);  
			$mail->Subject = 'Your Lost Password';
			$mail->Body    = "<p>Dear ".$personName.",</p> <p>Your lost password is <b>".$personPassword."</b></p>";
			if(!$mail->send()) {
				$_SESSION['msg'] = "Message could not be sent.\nMailer Error: ".$mail->ErrorInfo."";
			}
			else $_SESSION['msg'] = "Please check your e-mail inbox for your lost password";
			header("Location:index.php");
		}
	}
?>