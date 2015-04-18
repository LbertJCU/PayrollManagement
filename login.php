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
		$find=mysql_query("SELECT * FROM accounts WHERE UserName='".$_POST['uname']."'",$connect);
		$search=mysql_fetch_array($find);
		$count=mysql_num_rows($find);
		if ($count!=1) {
			die("Account not found.<br/>");
		}
		if ($count==1 & ($_POST['pword']!=$search['Password'])) {
			die("Password is wrong.");
		}
		if ($count==1 & $_POST['pword']==$search['Password']) {
			session_start();
			$_SESSION['login']=true;
			$name=mysql_query("SELECT * FROM employee WHERE EmployeeID='".$_POST['uname']."'",$connect);
			$user=mysql_fetch_array($name);
			$_SESSION['EmpID']=$user['EmployeeID'];
			$_SESSION['FName']=$user['EmpFirstName'];
			$_SESSION['LName']=$user['EmpLastName'];
			$_SESSION['manager']=$user['Manager'];
			$_SESSION['Level']=$search['Type'];
		}
		header("Location:profile.php");
	}
?>