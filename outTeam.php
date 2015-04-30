<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	$connect=mysql_connect("localhost","root","");
	if (!$connect) die("Cannot connect to server");
	$db=mysql_select_db("payroll",$connect);
	if (!$db) die("Cannot read the database");
	if (isset($_POST['removeTeam1'])) {
		foreach ($_POST['teamMember'] as $toRemove) {
			$out=mysql_query("UPDATE employee SET MGR_ID=\"nomgr\" WHERE EMP_ID = \"".$toRemove."\"");
		}
		if ($out==false) $_SESSION['msg']="Failed to remove members from team";
		else if ($out==true) $_SESSION['msg']="You removed members from your team";
	}
	else if (isset($_POST['removeTeam2'])) {
		$throw=explode(",",$_POST['outones']);
		foreach ($throw as $exit) {
				$out=mysql_query("UPDATE employee SET MGR_ID=\"nomgr\" WHERE EMP_ID = \"".$exit."\"");
		}
		if ($out==false) $_SESSION['msg']="Failed to remove all members from your team";
		else if ($out==true) $_SESSION['msg']="You removed all members from your team";
	}
	mysql_close();
	header("Location:team.php");
?>