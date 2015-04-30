<?php
	$connect=mysql_connect("localhost","root","");
	if (!$connect) die("Cannot connect to server");
	$db=mysql_select_db("payroll",$connect);
	if (!$db) die("Cannot read the database");
	session_start();
	if (isset($_POST['forward'])) {
		$reqid=$_POST['rqid'];
		$send=mysql_query("UPDATE request SET MGR_ID='admin' WHERE MSG_ID='".$reqid."'");
		if ($send==false) {
			$_SESSION['msg']="Sorry, the request is not forwarded to the administrator";
		}
		else {
			$_SESSION['msg']="The request is successfully forwarded to the administrator";
		}
		header("Location:response.php");
	}

?>