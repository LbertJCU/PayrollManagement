<?php
	session_start();
	$connect=mysql_connect("localhost","root","");
	if (!$connect) {
		die("Cannot connect to the server");
	}
	$db=mysql_select_db("payroll",$connect);
	if (!$db) {
		die("Cannot read the database");
	}
	if (isset($_POST['delete'])) {
		foreach ($_POST['employee'] as $select) {
			if(isset($select)) {
				$bye=mysql_query("DELETE FROM employee WHERE EMP_ID=\"".$select."\"");
			}
		}
		if ($bye==false) $_SESSION['msg']="Failed to remove the selected employee from database";
		else if ($bye==true) $_SESSION['msg']="The selected employee is successfully removed";
		header("Location:manage.php");
	}
?>