<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	include_once("include_all_fns.php");
	print_header("Manage Employee");
	connect_database();	
	if ($_SESSION['msg']!="") {
?>
	<script> window.onload=alert("<?php echo $_SESSION['msg']?>");</script>
<?php } $_SESSION['msg']=""; ?>
	<script>
	function control() {
		var level=document.getElementById("level");
		var eschema=document.getElementById("eScheme");
		var mschema=document.getElementById("mScheme");
		if (level.options[level.selectedIndex].value=="") {
			document.getElementById("m.scheme").style.display="none";
			document.getElementById("e.scheme").style.display="none";
			document.getElementById("hourdtl").style.display='none';
			document.getElementById("salrdtl").style.display='none';
			document.getElementById("commdtl").style.display='none';
		}
		else if (level.options[level.selectedIndex].value=="Manager") {
				document.getElementById("m.scheme").style.display="block";
				document.getElementById("e.scheme").style.display="none";
				if (mschema.options[mschema.selectedIndex].value == "Mslry") {
					document.getElementById("hourdtl").style.display='none';
					document.getElementById("salrdtl").style.display='block';
					document.getElementById("commdtl").style.display='none';
				}
				else if (mschema.options[mschema.selectedIndex].value == "Mcomm") {
					document.getElementById("hourdtl").style.display='none';
					document.getElementById("salrdtl").style.display='none';
					document.getElementById("commdtl").style.display='block';
				}
				else {
					document.getElementById("hourdtl").style.display='none';
					document.getElementById("salrdtl").style.display='none';
					document.getElementById("commdtl").style.display='none';
				}
		}
		else if (level.options[level.selectedIndex].value=="Employee") {
			document.getElementById("m.scheme").style.display="none";
			document.getElementById("e.scheme").style.display="block";
			if (eschema.options[eschema.selectedIndex].value=="hour") {
				document.getElementById("hourdtl").style.display='block';
				document.getElementById("salrdtl").style.display='none';
				document.getElementById("commdtl").style.display='none';
			}
			else if (eschema.options[eschema.selectedIndex].value == "Eslry") {
				document.getElementById("hourdtl").style.display='none';
				document.getElementById("salrdtl").style.display='block';
				document.getElementById("commdtl").style.display='none';
			}		
			else if (eschema.options[eschema.selectedIndex].value == "Ecomm") {
				document.getElementById("hourdtl").style.display='none';
				document.getElementById("salrdtl").style.display='none';
				document.getElementById("commdtl").style.display='block';
			}		
			else {
				document.getElementById("hourdtl").style.display='none';
				document.getElementById("salrdtl").style.display='none';
				document.getElementById("commdtl").style.display='none';
			}
		}
	}
	</script>
<?php
	print_top($_SESSION['Level'], mysql_query("SELECT * FROM feedback WHERE MGR_ID='".$_SESSION['EmpID']."' AND READ_ALR=\"U\""), mysql_query("SELECT * FROM request WHERE MGR_ID='".$_SESSION['EmpID']."' AND READ_ALR=\"U\""));
	print_menu("Manage Employee",$_SESSION['Level'],$_SESSION['EmpID'],$_SESSION['FName']);
?>
	<div id="content">
        <div class="inner" >
            <div class="row"> <div class="col-lg-12"> <h2> Employee Management </h2> </div> </div>
            <hr />
            <div class="panel-body">
                <div class="panel-group" id="accordion" >
                    <div class="form-group">
                        <div class="table-responsive">
                        <form action="expel.php" method="post" role="form">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead> <tr>
                                <th></th>
                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Employee Position</th>
                                <th>Employee's Manager</th>
                                <th>E-mail Address</th>
                                <th>Employee Contact</th>
                            </tr> </thead>
                            <tbody>
                            <?php
							$employee=mysql_query("SELECT * FROM employee WHERE EMP_ID!=\"".$_SESSION['EmpID']."\"");
                            while ($employ=mysql_fetch_array($employee)) {
                                echo "<tr>";
                                echo "<td><input type=\"checkbox\" name=\"employee[]\" value=\"".$employ['EMP_ID']."\"></td>";
                                echo "<td>".$employ['EMP_ID']."</td>";
                                echo "<td>".$employ['EMP_FNAME']." ".$employ['EMP_LNAME']."</td>";
								echo "<td>".$employ['EMP_POS']."</td>";
                                echo "<td>".$employ['MGR_ID']."</td>";
                                echo "<td>".$employ['EMP_EMAIL']."</td>";
                                echo "<td>".$employ['EMP_CONTACT']."</td>";
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-default" name="delete">Delete Employee</button>
                        &emsp;
                        <button type="reset" class="btn btn-default" name="clear">Reset Selection</button>
                        &emsp;
                        <button type="button" class="btn btn-primary" name="add" href="#addEmployee"  data-toggle="modal"  data-target="#addEmployee">Add New Employee</a></button>
                        </form>
                    </div> 
                </div> 
            </div> 
        </div> 
   </div>
</div>
    <div class="panel-body">
        <div class="col-lg-6">
            <div class="modal fade" id="addEmployee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog"> 
                    <div class="modal-content"> 
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="H4">Add New Employee</h4> 
                        </div>
                        <div class="modal-body"> <form action="newEmployee.php" method="post" role="form">
                            <div class="form-group">
                                <label>First Name</label> <input class="form-control" name="firstName" />
                            </div>
                            <div class="form-group">
                                <label>Last Name</label> <input class="form-control" name="lastName" />
                            </div>
                            <div class="form-group">
                                <label>Date of Birth</label> <input type="date" name="DOB" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Address</label> <input class="form-control" name="address" />
                            </div>
                            <div class="form-group">
                                <label>E-mail</label> <input type="email" name="e-mail" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Contact</label> <input class="form-control" name="contact"/>
                            </div>
                            <div class="form-group">
                            	<label>Payment Method</label>
                                <select class="form-control" name="method">
                                	<option value="cash">Cash Payment</option>
                                    <option value="delver">Deliver to Postal Address</option>
                                    <option value="trnsfr">Transfer to Bank Account</option>
                                </select>
                            </div>
                            <div class="form-group">
                            	<label>Bank Account</label> <input class="form-control" name="account"/>
                            </div>
                            <div class="form-group">
                                <label>Organizational Position</label>
                                <select class="form-control" id="level" name="Position" onChange="control()"/>
                                    <option selected> </option>
                                    <option id="e" value="Employee">Employee</option>
                                    <option id="m" value="Manager" style="display:none;">Manager</option>
                                </select>
                            </div>
                            <div class="form-group" id="m.scheme" style="display:none;">
                            	<label>Employment Scheme</label>
                                <select class="form-control" id="mScheme" name="Mscheme" onChange="control()" />
                                	<option selected> </option>
                                    <option value="Mslry">Salaried Employee</option>
                                    <option value="Mcomm">Commision</option>
                                </select>
                            </div>
                            <div class="form-group" id="e.scheme" style="display:none;">
                            	<label>Employment Scheme</label>
                                <select class="form-control" id="eScheme" name="Escheme" onChange="control()" />
                                	<option selected> </option>
                                    <option value="hour">Hourly basis</option>
                                    <option value="Eslry">Salaried Employee</option>
                                    <option value="Ecomm">Commision</option>
                                </select>
                            </div>
                            <div id="hourdtl" class="form-group" style="display:none;">
                                <label>Hourly Rate</label>
                                <input type="number" class="form-control" step="0.25" name="rate" />
                            </div>
                            <div id="salrdtl" class="form-group" style="display:none;">
                            	<label>Gross Salary</label>
                                <input type="number" class="form-control" step="0.25" name="Msalary" />
                            </div>
                            <div id="commdtl" class="form-group" style="display:none;">
                            	<p>
                                <label>Gross Salary</label>
                                <input type="number" class="form-control" step="0.25" name="Csalary" />
                                </p> <p>
                                <label>Commision</label>
                                <input type="number" class="form-control" step="0.25" name="commision" />
                                </p>
                            </div>
                        </div>
                        <div class="modal-footer">
                        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" name="add" class="btn btn-primary">Add New</button>
                        </form>
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div>
    </div>
</div>
<?php
	print_footer();
?>
	<script>control();</script>
<?php
	print_end();
	$profile=mysql_query("SELECT * FROM employee WHERE EMP_ID=\"".$_SESSION['EmpID']."\"");
	print_modal(mysql_fetch_array($profile));
	disconnect_database();
?>