<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	include_once("include_all_fns.php");
	print_header("Respond to Request");
	connect_database();
	print_top($_SESSION['Level'],mysql_query("SELECT * FROM messages WHERE manager='".$_SESSION['EmpID']."'"));
	print_menu("Respond to Request",$_SESSION['Level'],$_SESSION['EmpID'],$_SESSION['FName']);
	print_pending(mysql_query("SELECT * FROM requests WHERE status='new'"));
	print_footer();
	disconnect_database();
?>