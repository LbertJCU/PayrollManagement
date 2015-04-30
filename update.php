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
if (isset($_POST['utc'])) {
	$no=$_POST['no'];
	$id=$_POST['aid'];
	$date=$_POST['adate'];
	$start=$_POST['astart'];
	$end=$_POST['aend'];
	$mod=mysql_query ("UPDATE timecard SET CARD_ID='".$id."', CARD_DATE='".$date."', START_TIME='".$start."', END_TIME='".$end."', VERIFIED=\"V\" WHERE UPLOAD_ID='".$no."'");
	if ($mod==false) $_SESSION['msg']="Sorry, the time card information is not updated.";
	else $_SESSION['msg']="Congratulations! The information of time card is successfully updated.";
	header("Location:response.php");
}
else if (isset($_POST['urc'])) {
	$no=$_POST['num'];
	$receiptid=$_POST['rcptid'];
	$receiptdt=$_POST['rcdate']; 
	$receipttl=$_POST['rctotl'];
	$chk=mysql_query ("UPDATE receipts SET RECEIPT_ID='".$receiptid."', RECEIPT_DATE='".$receiptdt."', RECEIPT_TOTAL='".$receipttl."', VERIFIED=\"V\" WHERE UPLOAD_ID='".$no."'");
	if ($chk==false) $_SESSION['msg']="Sorry, the receipt information is not updated.";
	else $_SESSION['msg']="Congratulations! The information of receipt is successfully updated.";
	header("Location:response.php");
}
?>