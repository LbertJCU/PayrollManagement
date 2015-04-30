<?php
	session_start();
	if (isset($_POST['send'])) {
		$fnm=$_SESSION['EmpID'];
		if ($_SESSION['manager']!="nomgr") $mgr=$_SESSION['manager'];
		$name=$_SESSION['FName'];
		$ttl=$_POST['title'];
		$msg=$_POST['feedback'];
		$sent=mysql_query("INSERT INTO feedback (EMP_ID, EMP_NAME, MGR_ID, TITLE, FEEDBACK, READ_ALR) VALUES (\"".$fnm."\",\"".$name."\",\"".$mgr."\",\"".$ttl."\",\"".$msg."\",\"U\")");
		if ($sent==false) $_SESSION['msg']="Sorry, your feedback is not sent to server.";
		else if ($sent==true) $_SESSION['msg']="Thanks for your feedback.";
		header("Location:writeFeedback.php");
	}
?>