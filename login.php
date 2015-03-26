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
		$find=mysql_query("SELECT * FROM member WHERE UserName='".$_POST['uname']."'",$connect);
		$search=mysql_fetch_array($find);
		$count=mysql_num_rows($find);
		if ($count!=1) {
			echo("Account not found.<br/>");
		}
		if ($count==1 & ($_POST['pword']!=$search['Password'])) {
			echo("Password is wrong.");
		}
		if ($count==1 & $_POST['pword']==$search['Password']) {
			session_start();
			$_SESSION['username']=$_POST['uname'];
			$name=mysql_query("SELECT FirstName FROM member WHERE UserName='".$_SESSION['username']."'",$connect);
			$user=mysql_fetch_array($name);
			$_SESSION['FirstName']=$user['FirstName'];
			$_SESSION['login']=true;
		}
		if ($search['Type']=="Employee") {
			header("Location:ehome.html");
		}
		if ($search['Type']=="Manager") {
			header("Location:mhome.html");
		}
		if ($search['Type']=="Admin") {
			header("Location:ahome.php");
		}
		
	}
?>