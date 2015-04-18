<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	include_once("include_all_fns.php");
	print_header("View Colleague Profile");
	connect_database();
	print_top($_SESSION['Level'],mysql_query("SELECT * FROM messages WHERE manager='".$_SESSION['EmpID']."'"));
	print_menu("View Colleague Profile",$_SESSION['Level'],$_SESSION['EmpID'],$_SESSION['FName']);
	print_colleague(mysql_query("SELECT * FROM Employee WHERE EmployeeID!=\"".$_SESSION['EmpID']."\" AND EmployeeID!=\"admin\""));
	print_footer();
	mysql_close();
?>