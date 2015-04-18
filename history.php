<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	include_once("include_all_fns.php");
	print_header("View Payment History");
	connect_database();
	print_top($_SESSION['Level'],mysql_query("SELECT * FROM messages WHERE manager='".$_SESSION['EmpID']."'"));
	print_menu("View Payment History",$_SESSION['Level'],$_SESSION['EmpID'],$_SESSION['FName']);
	print_payment(mysql_query("SELECT * FROM history WHERE EmployeeID!=\"".$_SESSION['EmpID']."\""),mysql_query("SELECT * FROM history WHERE EmployeeID=\"".$_SESSION['EmpID']."\""));
	print_footer();
	mysql_close();
?>