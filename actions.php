<?php
function UpdateProfile() {
	if (isset($_POST['change'])) {
		$empid=$_SESSION['EmpID'];
		$email=$_POST['e-mail'];
		$address=$_POST['address'];
		$method=$_POST['method'];
		if ($method=="trnsfr") {
			$bank=$_POST['bank'];
			$account=$_POST['bankacc'];
		}
		else {
			$bank='';
			$account=0;
		}			
		$sql="UPDATE employee WHERE EmployeeID='".$empid."' SET EmployeeEmail='".$email."', EmployeeAddress='".$address."', PaymentMethod='".$method."', BankName='".$bank."', BankAccount=".$account."";
		mysql_query($sql);
		header('Location:profile.php');
	}
}

function UploadFile() {
	if (isset($_POST['upload'])) {}
}

function SendFeedback() {
	if (isset($_POST['send'])) {
		$eid=$_SESSION['EmpID'];
		if ($_SESSION['manager']!="nomgr") $mgr=$_SESSION['manager'];
		$ttl=$_POST['title'];
		$msg=$_POST['feedback'];
		mysql_query("INSERT INTO feedback VALUES (\"".$eid."\",\"".$mgr."\",\"".$ttl."\",\"".$msg."\")");
	}
}

function RecruitMember() {
	if (isset($_POST['addTeam'])) {
		foreach ($_POST['box1view'] as $toAdd) {
			$enter="UPDATE employee WHERE EmployeeID = '".$toAdd."' SET Manager='".$_SESSION('EmpFirstName')."'";
			mysql_query($enter);
		}
		mysql_close();
	}
	header("Location:team.php");
}

function TerminateMember() {
	if (isset($_POST['removeTeam'])) {
		foreach ($_POST['box2view'] as $toRemove) mysql_query("UPDATE employee WHERE EmployeeID = '".$toRemove." SET Manager='nomgr'");
		mysql_close();
	}
	header("Location:team.php");
}
?>