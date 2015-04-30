<?php
session_start();
	$connect=mysql_connect("localhost","root","");
	if (!$connect) {
		die("Cannot connect to the server");
	}
	$db=mysql_select_db("payroll",$connect);
	if (!$db) {
		die("Cannot read the database");
	}
	if (isset($_POST['login'])) {
		$find=mysql_query("SELECT * FROM employee WHERE EMP_ID='".$_POST['uname']."'",$connect);
		$search=mysql_fetch_array($find);
		$count=mysql_num_rows($find);
		if ($count!=1) {
			$_SESSION['msg']="Account not found.";
			$redirect="index.php";
		}
		if ($count==1 & ($_POST['pword']!=$search['PASSWORD'])) {
			$_SESSION['msg']="Password is wrong.";
			$redirect="index.php";
		}
		if ($count==1 & ($_POST['pword']==$search['PASSWORD'])) {
			session_start();
			$_SESSION['login']=true;
			$name=mysql_query("SELECT * FROM employee WHERE EMP_ID='".$_POST['uname']."'",$connect);
			$user=mysql_fetch_array($name);
			$_SESSION['EmpID']=$user['EMP_ID'];
			$_SESSION['FName']=$user['EMP_FNAME'];
			$_SESSION['LName']=$user['EMP_LNAME'];
			$_SESSION['manager']=$user['MGR_ID'];
			$_SESSION['Level']=$user['EMP_POS'];
			$_SESSION['msg']="";
			$redirect="profile.php";
		}
		header("Location:".$redirect."");
	}
?>