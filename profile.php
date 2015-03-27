<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
?>
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
<h1>Employee Profile</h1>
<form name="profile" action="editemployee.php" method="post">
<p><label for="empnum">Employee ID :</label>
<input type="text" id="empnum" disabled value=<?php $SESSION['EmpID']?>/></p>
<fieldset>
<legend>Employee Name</legend>
<p><label for="name">First Name :</label>
<input type="text" id="name" disabled value=<?php $SESSION['FName']?>/></p>
<p><label for="name">Last Name :</label>
<input type="text" id="name" disabled value=<?php $SESSION['EmpID']?>/></p>
</fieldset>
<p><label for="e-mail">E-mail address :</label>
<input type="email" id="e-mail"/></p>
<p><label for="address">Postal Address :</label>
<textarea id="address" rows="3"></textarea></p>
<p><label for="method">Payment Method :</label>
<select name="method" id="method">
	<option value="cash">Paid by Paymaster</option>
    <option value="delver">Deliver to Postal Address</option>
    <option value="trnsfr">Transfer to Bank Account</option>
</select>
<fieldset id="mtd">
<legend>Payment Information</legend>
<p><label for="bank">Bank Name : </label><input type="text" id="bank"/></p><p><label for="bankacc">Bank Account : </label><input type="text" id="bankacc" maxlength="16" size="16"></p>
</fieldset>
<br/>
<input type="submit" value="Update Profile"/>
</form>
</content>
<footer>
</footer>
</body>
</html>
