<?php
	function connect_database() {
		$connection=mysql_connect("localhost","root","");
		if (!$connection) die("Cannot connect to server");
		$database=mysql_select_db("payroll",$connection);
		if (!$database) die("Database is not found");
		$link=mysqli_connect("localhost","root","","payroll");
		if (mysqli_connect_errno()) echo "Failed to connect to MySQL: ".mysqli_connect_error();
	}
	function disconnect_database() {
		mysql_free_result($connection);
		mysql_close($connection);
	}
?>