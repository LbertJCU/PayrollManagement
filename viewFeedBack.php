<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	include_once("include_all_fns.php");
	print_header("View Employee's Feedback");
	connect_database();
	print_top($_SESSION['Level'],mysql_query("SELECT * FROM messages WHERE manager='".$_SESSION['EmpID']."'"));
	print_menu("View Employee's Feedback",$_SESSION['Level'],$_SESSION['EmpID'],$_SESSION['FName']);
	print_vfeedback(mysql_query("SELECT * FROM feedback WHERE EmpManager='".$_SESSION['FName']."'"));
	print_footer();
	disconnect_database();
?>