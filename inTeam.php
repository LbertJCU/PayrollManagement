<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	$connect=mysql_connect("localhost","root","");
	if (!$connect) die("Cannot connect to server");
	$db=mysql_select_db("payroll",$connect);
	if (!$db) die("Cannot read the database");
	if (isset($_POST['addTeam1'])) {
		foreach ($_POST['newEmployee'] as $toAdd) {
			$recruit=mysql_query("UPDATE employee SET MGR_ID=\"".$_SESSION['EmpID']."\" WHERE EMP_ID=\"".$toAdd."\"");
		}
		if ($recruit==false) $_SESSION['msg']="Failed to recruit members into team";
		else if ($recruit==true) $_SESSION['msg']="You recruited new members into your team";
	}
	else if (isset($_POST['addTeam2'])) {
		$recruit=explode(",",$_POST['newones']);
		foreach ($recruit as $enter) {
			$into=mysql_query("UPDATE employee SET MGR_ID=\"".$_SESSION['EmpID']."\" WHERE EMP_ID=\"".$enter."\"");
		}
		if ($into==false) $_SESSION['msg']="Failed to recruit all vacant employees into your team";
		else if ($into==true) $_SESSION['msg']="You recruited all vacant employees into your team";
	}
	mysql_close();
	header("Location:team.php");
?>