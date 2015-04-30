<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	$connect=mysql_connect("localhost","root","");
	if (!$connect) die("Cannot connect to server");
	$db=mysql_select_db("payroll",$connect);
	if (!$db) die("Cannot read the database");
	if (isset($_POST['upload'])) {
		$subject=$_POST['subject'];
		if ($subject == "tmcd") {
			mysql_query("INSERT INTO timecard (UPLOAD_ID) VALUES (NULL)");
			$no=mysql_fetch_array(mysql_query("SELECT LAST_INSERT_ID()"));
			$filename=$_FILES['card']['name'];
			$ext=pathinfo($filename,PATHINFO_EXTENSION);
			$timeCard_type=$_FILES['card']['type'];
			if (($timeCard_type!="image/png") && ($timeCard_type!="image/jpeg")) $_SESSION['msg'] = "Only png, jpg, and jpeg files are supported.";
			else {
				$timeCard_size=$_FILES['card']['size'];
				$timeCard_name=$no[0]."[timecard]_".$_SESSION['EmpID']."-".date("dmY").".".$ext;
				$timeCard_tmp_name=$_FILES['card']['tmp_name'];
				move_uploaded_file($timeCard_tmp_name,"uploads/$timeCard_name");
				$uptime = mysql_query("UPDATE timecard SET TYPE=\"Time Card\", EMP_ID=\"".$_SESSION['EmpID']."\", EMP_NAME=\"".$_SESSION['FName']."\", MGR_ID=\"".$_SESSION['manager']."\", CARD_PATH=\"uploads/".$timeCard_name."\", VERIFIED=\"U\" WHERE UPLOAD_ID='".$no[0]."'");
				if ($uptime==false) $_SESSION['msg'] = "Sorry, your time card is not uploaded.";
				if ($uptime==true) $_SESSION['msg'] = "Congratulations! Your time card is successfully uploaded";
			}
		}
		else if ($subject == "slrp") {
			$salesNum=count($_FILES['bills']['name']);
			for ($i=0;$i<$salesNum;$i++) {
				mysql_query("INSERT INTO receipts (UPLOAD_ID) VALUES (NULL)");
				$num=mysql_fetch_array(mysql_query("SELECT LAST_INSERT_ID()"));
				$filesname=$_FILES['bills']['name'][$i];
				$filesext=pathinfo($filesname,PATHINFO_EXTENSION);
				$salesType=$_FILES['bills']['type'][$i];
				if($salesType!="image/png" && $salesType!="image/jpeg") $_SESSION['msg'] = "Only png, jpg, and jpeg files are supported.";
				else {
				$salesSize=$_FILES['bills']['size'][$i];
				$salesName=$num[0]."[receipt] ".$_SESSION['EmpID']."-".date("dmY")."[".($i+1)."].".$filesext;
				$salesTemp=$_FILES['bills']['tmp_name'][$i];
				move_uploaded_file($salesTemp,"uploads/$salesName");
				$upbill=mysql_query ("UPDATE receipts SET TYPE=\"Sales Receipt\", EMP_ID=\"".$_SESSION['EmpID']."\", MGR_ID=\"".$_SESSION['manager']."\", RECEIPT_PATH=\"uploads/".$salesName."\", VERIFIED=\"U\" WHERE UPLOAD_ID='".$num[0]."'");
				if ($upbill==false) $_SESSION['msg'] = "Sorry, your sales receipts are not uploaded.";
				else if ($upbill==true) $_SESSION['msg'] = "Congratulations! Your sales receipts are successfully uploaded";
				}
			}
		}
		else if ($subject!="tmcd" || $subject!="slrp") {
			$message=$_POST['request'];
			$send=mysql_query("INSERT INTO request (EMP_ID, MGR_ID, TITLE, REQUEST) VALUES (\"".$_SESSION['EmpID']."\",\"".$_SESSION['manager']."\",\"".$subject."\",\"".$message."\")");
			if ($send==false) $_SESSION['msg'] = "Sorry, your request is not sent to your manager.";
			else $_SESSION['msg'] = "Congratulations! Your request is successfully sent to your manager";
		}
		header("Location:upload.php");
	}
?>