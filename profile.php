<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	include_once("include_all_fns.php");
	print_header("View Profile");
	connect_database();
	if ($_SESSION['msg']!="") {
?>
	<script> window.onload=alert("<?php echo $_SESSION['msg']?>");</script>
<?php } $_SESSION['msg']="";
	print_top($_SESSION['Level'], mysql_query("SELECT * FROM feedback WHERE MGR_ID='".$_SESSION['EmpID']."' AND READ_ALR=\"U\""), mysql_query("SELECT * FROM request WHERE MGR_ID='".$_SESSION['EmpID']."' AND READ_ALR=\"U\""));
	print_menu("View Profile",$_SESSION['Level'],$_SESSION['EmpID'],$_SESSION['FName']);
	$profile=mysql_query("SELECT * FROM employee WHERE EMP_ID=\"".$_SESSION['EmpID']."\"");
	$Employee=mysql_fetch_array($profile);
	$career=mysql_query("SELECT * FROM workhistory WHERE EMP_ID='".$_SESSION['EmpID']."'");
?>
    <div id="content">
    	<div class="inner">
            <div class="row"> <div class="col-lg-12"> <h2> Profile </h2> </div> </div>
            <hr />
            <div class="row"> 
                <div class="col-lg-9">
                    <div class="panel panel-default">
                    	<div class="panel-heading"> View Profile </div>
                        <div class="panel-body" >
                            <div id= "wizard" >
                                <h2> Personal </h2>
                                <section> <form role="form">
                                    <div class="form-group">
                                    	<label> First Name </label> <input class="form-control" readonly value="<?php echo $Employee['EMP_FNAME'] ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label> Last Name </label> <input class="form-control" readonly value="<?php echo $Employee['EMP_LNAME'] ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label> Position-POS </label> <input class="form-control" readonly value="<?php echo $Employee['EMP_POS'] ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label> Date of Birth </label> <input type="date" readonly class="form-control" value="<?php echo $Employee['EmpDateOfBirth'] ?>" />
                                    </div>
                                </form> </section>
                                
                                <h2> Contact </h2> 
                                <section> <form role="form">
                                <div class="form-group">
                                	<label> Email </label> <input class="form-control" name="e-mail" value="<?php echo $Employee['EMP_EMAIL'] ?>" readonly/>
                                </div>
                                <div class="form-group">
                                	<label> Contact </label> <input class="form-control" value="<?php echo $Employee['EMP_CONTACT'] ?>" readonly/>
                                </div>
                                    <div class="form-group">
                                        <label> Address </label> <input class="form-control" name="address" value="<?php echo $Employee['EMP_ADDRESS'] ?>" readonly/>
                                    </div>
                                </form> </section>
                            
                                <h2>Extras</h2>
                                <section> <form role=\"form\">
                                <div class="form-group">
                                <label> Payment Method </label>
                                    <select name="method" class="form-control" readonly>
                                    <?php
                                    if ($Employee['EMP_PAY_METHOD']=="cash") {
                                        echo "<option value=\"cash\" selected>Cash</option>";
                                        echo "<option value=\"delver\">Delivered to Postal Address</option>";
                                        echo "<option value=\"trnsfr\">Transfer to Bank Account</option>";
                                    }
                                    else if ($Employee['EMP_PAY_METHOD']=="delver") {
                                        echo "<option value=\"cash\">Cash</option>";
                                        echo "<option value=\"delver\" selected>Delivered to Postal Address</option>";
                                        echo "<option value=\"trnsfr\">Transfer to Bank Account</option>";
                                    }
                                    else if ($Employee['EMP_PAY_METHOD']=="trnsfr") {
                                        echo "<option value=\"cash\">Cash</option>";
                                        echo "<option value=\"delver\">Delivered to Postal Address</option>";
                                        echo "<option value=\"trnsfr\" selected>Transfer to Bank Account</option>";
                                    }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                	<label> Bank Account </label> 
                                    <input name="bankacc" class="form-control" value="<?php echo $Employee['EMP_BANK_ACC'] ?>" readonly />
                                </div>
                                <hr/>
                                <div class=\"form-group\">
                                    <label> Work History </label>
                                    <select name="workhistory" class="form-control" multiple size="10" readonly>
                                    <?php
                                    while ($whst=mysql_fetch_array($career)) {
                                        echo "<option>".$whst['POSITION']."&emsp; From: ".$whst['START_DATE']."&emsp; To: ".$whst['END_DATE']."</option>";
                                    }
									?>
                                    </select>
                                </div>
                                </form> </section>
                            </div> 
                        </div> 
                	</div> 
            	</div>
                                                              
            <div class="row"> 
            	<div class="col-lg-3"> 
            		<div class="panel panel-default">
                    	<div class="panel-heading"> Edit Profile </div>
                        	<div class="panel-body" > 
                            	<div id= "wizard" >
                                	<section> <form action="editemployee.php" method="post" role="form">
                                	<div class="form-group">
                                        <label>New Password</label> 
                                        <input type="password" name="npswd" class="form-control"/>
                                	</div>
                                	<div class="form-group">
                                    	<label>Confirm Password</label> 
                                        <input type="password" name="cnpsw" class="form-control"/>
                                	</div>
                                	<div class="form-group">
                                    	<label>Email</label> 
                                        <input class="form-control" name="e-mail" />
                                	</div>
                                	<div class="form-group">
                                    	<label>Contact</label> 
                                        <input class="form-control" name="contact"/>
                                	</div>
                                	<div class="form-group">
                                    	<label>Address</label> 
                                        <input class="form-control" name="address" />
                                	</div>
                                	<div class="form-group">
                                        <label>Payment Method</label>
                                        <select name="method" class="form-control">
                                                <option value="" selected> </option>";
                                                <option value="cash">Cash</option>
                                                <option value="delver">Delivered to Postal Address</option>
                                                <option value="trnsfr">Transfer to Bank Account</option>
                                        </select>
                                	</div>
                                	<div class="form-group">
									<?php
                                    if ($Employee['EMP_PAY_METHOD']=="trnsfr") echo "<label> Bank Account </label> <input class=\"form-control\" name=\"bankacc\" value=\"".$Employee['EMP_BANK_ACC']."\"/>";
                                    else echo "<label> Bank Account </label> <input class=\"form-control\" name=\"bankacc\" />";
                                    ?>
                                	</div>
                                	<button type="submit" name="change" class="btn btn-primary">Save changes</button>
                                </form> </section> </div>
                            </div> 
                        </div> 
					</div> 
                </div> 
            </div> 
    	</div>
    </div>	
</div>
<?php
	print_footer();
	print_end();
	print_modal(mysql_fetch_array(mysql_query("SELECT * FROM employee WHERE EMP_ID=\"".$_SESSION['EmpID']."\"")));
	disconnect_database();
?>