<?php
	session_start();
		$connection=mysql_connect("localhost","root","");
		if (!$connection) die("Cannot connect to server");
		$database=mysql_select_db("payroll",$connection);
		if (!$database) die("Database is not found");
		$link=mysqli_connect("localhost","root","","payroll");
		if (mysqli_connect_errno()) echo "Failed to connect to MySQL: ".mysqli_connect_error();
	if (isset($_POST['add'])) {
		$query="";
		$fname=$_POST['firstName'];
		$lname=$_POST['lastName'];
		$dateOfBirth=$_POST['DOB'];
		$address=$_POST['address'];
		$email=$_POST['e-mail'];
		$contact=$_POST['contact'];
		$position=$_POST['Position'];
		if ($position=="Employee") {
			$countn=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM employee WHERE EMP_POS=\"Employee\""));
			$fid=sprintf("%06d",$countn[0]+1);
			$id="SF".$fid;
		}
		else if ($position=="Manager") {
			$countg=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM employee WHERE EMP_POS=\"Manager\""));
			$gid=sprintf("%06d",$countg[0]+1);
			$id="MG".$gid;
		}
		$method=$_POST['method'];
		$bankacc=$_POST['account'];
		if ($_POST['Mscheme']!="") $scheme=$_POST['Mscheme'];
		else if ($_POST['Escheme']!="") $scheme=$_POST['Escheme'];
		$query.="INSERT INTO employee VALUES ('".$id."','password','".$fname."','".$lname."','".$dateOfBirth."','".$address."','".$email."',".$contact.",'".$position."','".$method."','".$bankacc."','nomgr');";
		if ($scheme=="hour") {
			$hourlyRate=$_POST['rate'];
			$query.="INSERT INTO hourly VALUES ('".$id."','".$hourlyRate."');";
		}
		else if ($scheme=="Eslry" || $scheme=="Mslry") {
			$monthSalary=$_POST['Msalary'];
			$query.="INSERT INTO salary VALUES ('".$id."','".$monthSalary."');";
		}
		else if ($scheme=="Ecomm" || $scheme=="Mcomm") {
			$monthSalary=$_POST['Csalary'];
			$addCommision=$_POST['commision'];		
			$query.="INSERT INTO salesman VALUES ('".$id."','".$monthSalary."','".$addCommision."');";
		}
		$update=mysqli_multi_query($link,$query);
		if ($update==false) {
			$_SESSION['msg']="Failed to register the new employee";
		}
		else if ($update==true) $_SESSION['msg']="Congratulations! The new employee is successfully registered.";
		header("Location:manage.php");
	}
?>