<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<header>
</header>
<menu>
<ul>
<li>View Profile</li>
<li>Create Requests</li>
<li>Post Files</li>
<li>Colleagues</li>
</ul>
</menu>
<content>
<h1>File Upload</h1>
<form action="upload.php" method="post" enctype="multipart/form-data">
<p><label for="timecard">Upload your time card here : </label><input type="file" name="time" id="timecard"/></p>
<p><label for="salesreceipt">Upload your sales receipt here : </label>
<input type="file" name="sales[]" id="salesreceipt" multiple/></p>
<input type="submit" name="upload" value="Upload"/>
</form>
<?php

if (isset($_POST['upload'])) {
	$timeCard_name=$_FILES['time']['name'];
	$timeCard_size=$_FILES['time']['size'];
	$timeCard_type=$_FILES['time']['type'];
	$timeCard_tmp_name=$_FILES['time']['tmp_name'];
	$salesNum=count($_FILES['sales']['name']);
	if (empty($timeCard_name)) {
		echo "<script>alert(\"Please select the time card for upload\");</script>";
		exit();
	}	
	if (!empty($timeCard_name) && $salesNum>1) {
		move_uploaded_file($timeCard_tmp_name,"uploads/$timeCard_name");
		for ($i=0;$i<$salesNum;$i++) {
			$salesName=$_FILES['sales']['name'][$i];
			$salesType=$_FILES['sales']['type'][$i];
			$salesSize=$_FILES['sales']['size'][$i];
			$salesTemp=$_FILES['sales']['tmp_name'][$i];
			move_uploaded_file($salesTemp,"uploads/$salesName");
		}
		echo "<script>alert('Image Uploaded Successfully!');</script>";
	}
	if (!empty($timeCard_name) && $salesNum==1) {
		move_uploaded_file($timeCard_tmp_name,"uploads/$timeCard_name");
		echo "<script>alert('Time card Upload Successfully!');</script>";
	}
}
?>
</content>
<footer>
</footer>
</body>
</html>