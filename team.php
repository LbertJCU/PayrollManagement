<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	include_once("include_all_fns.php");
	print_header("Team Management");
	connect_database();
	print_top($_SESSION['Level'],mysql_query("SELECT * FROM messages WHERE manager='".$_SESSION['EmpID']."'"));
	print_menu("Team Management",$_SESSION['Level'],$_SESSION['EmpID'], $_SESSION['FName']);
	print_team(mysql_query("SELECT * FROM employee WHERE Manager=\"nomgr\" AND EmployeeID!=\"".$_SESSION['EmpID']."\""),RecruitMember(),mysql_query("SELECT * FROM employee WHERE Manager='".$_SESSION['FName']."'"),TerminateMember());
	print_footer();
	disconnect_database();
?>