<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	$connect=mysql_connect("localhost","root","");
	if (!$connect) {
		die("Cannot connect to the server");
	}
	$db=mysql_select_db("payroll",$connect);
	if (!$db) {
		die("Cannot read the database");
	}
	if (isset($_POST['change'])) {
		$sql="UPDATE employee SET ";
		$empid=$_SESSION['EmpID'];
		if ($_POST['npswd']==$_POST['cnpsw']) $password=$_POST['npswd'];
		if ($password!="")$sql=$sql."PASSWORD='".$password."'";
		else if ($password=="") {
			$crpas=mysql_fetch_array(mysql_query("SELECT PASSWORD FROM employee WHERE EMP_ID='".$_SESSION['EmpID']."'"));
			$sql=$sql."PASSWORD='".$crpas[0]."'";
		}
		$email=$_POST['e-mail'];
		if ($email!="") $sql=$sql.", EMP_EMAIL='".$email."'";
		$address=$_POST['address'];
		if ($address!="") $sql=$sql.", EMP_ADDRESS='".$address."'";
		$contact=$_POST['contact'];
		if ($contact!="") $sql=$sql.", EMP_CONTACT='".$contact."'";
		$method=$_POST['method'];
		if ($method!="") $sql=$sql.", EMP_PAY_METHOD='".$method."'";
		$account=$_POST['bankacc'];
		if ($account!="") $sql=$sql.", EMP_BANK_ACC='".$account."'";
		$sql=$sql." WHERE EMP_ID='".$empid."'";
		$execute=mysql_query($sql);
		if ($execute==false) $_SESSION['msg'] = "Sorry, your profile is not updated.";
		else if ($_POST['npswd']!=$_POST['cnpsw']) $_SESSION['msg']="Your password and confirm password does not match";
		else if ($execute==true) $_SESSION['msg'] = "Congratulations, your changes is already made.";
		header('Location:profile.php');
	}
?>