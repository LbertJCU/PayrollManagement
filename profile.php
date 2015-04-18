<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	include_once("include_all_fns.php");
	print_header("View Profile");
	connect_database();
	print_top($_SESSION['Level'],mysql_query("SELECT * FROM messages WHERE manager='".$_SESSION['EmpID']."'"));
	print_menu("View Profile",$_SESSION['Level'],$_SESSION['EmpID'],$_SESSION['FName']);
	$profile=mysql_query("SELECT * FROM employee WHERE EmployeeID=\"".$_SESSION['EmpID']."\"");
	$account=mysql_query("SELECT * FROM accounts WHERE UserName=\"".$_SESSION['EmpID']."\"");
	print_profile(mysql_fetch_array($profile), mysql_fetch_array($account),UpdateProfile());
	print_footer();
	disconnect_database();
?>