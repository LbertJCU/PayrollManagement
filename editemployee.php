<?php
	$connect=mysql_connect("localhost","root","");
	if (!$connect) {
		die("Cannot connect to the server");
	}
	$db=mysql_select_db("payroll",$connect);
	if (!$db) {
		die("Cannot read the database");
	}
	if (isset($_POST['login'])) {
		$empid=$_SESSION['EmpID'];
		$email=$_POST['e-mail'];
		$address=$_POST['address'];
		$method=$_POST['method'];
		if ($method=="trnsfr") {
			$bank=$_POST['bank'];
			$account=$_POST['bankacc'];
		}
		$sql="UPDATE payroll WHERE id='".$empid."' SET email='".$email."', address='".$address."', method='".$method."', bank='".$bank."', account='".$account."'";
		mysql_query($sql);
		header();
	}
?>