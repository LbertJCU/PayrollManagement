<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	include_once("include_all_fns.php");
	print_header("Team Management");
	connect_database();
	if ($_SESSION['msg']!="") {
?>
	<script> window.onload=alert("<?php echo $_SESSION['msg']?>");</script>
<?php } $_SESSION['msg']=""; 
	print_top($_SESSION['Level'], mysql_query("SELECT * FROM feedback WHERE MGR_ID='".$_SESSION['EmpID']."' AND READ_ALR=\"U\""), mysql_query("SELECT * FROM request WHERE MGR_ID='".$_SESSION['EmpID']."' AND READ_ALR=\"U\""));
	print_menu("Team Management",$_SESSION['Level'],$_SESSION['EmpID'], $_SESSION['FName']);
?>
   <div id="content">
     <div class="inner">
                <div class="row"> <div class="col-lg-12"> <h2> Team Management </h2> </div> </div>
                <hr />
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box">
                                  <div id="div-3" class="accordion-body collapse in body">
                                      <div class="row">
                                          <div class="col-lg-5">
                                          <h5><strong>Available Employees</strong></h5>
                                              <div class="form-group"> <form method="post">
                                                  <div class="input-group">
                                                  <input id="box1Filter" type="text" placeholder="Filter" class="form-control"/>
                                                  <span class="input-group-btn">
                                                  <button id="box1Clear" class="btn btn-warning" type="button">x</button> </span>
                                                  </div> 
                                              </div>
                                            <div class="form-group">
                                                <select id="box1View" name="newEmployee[]" multiple="multiple" class="form-control" size="16">
                                                <?php
												$getNew=mysql_query("SELECT * FROM employee WHERE MGR_ID=\"nomgr\" AND EMP_ID!=\"".$_SESSION['EmpID']."\"");
                                                while ($members=mysql_fetch_array($getNew)) {
                                                    echo "<option value=\"".$members['EMP_ID']."\">".$members['EMP_FNAME']." ".$members['EMP_LNAME']."</option>";
                                                }
												?>
                                                </select>
                                                <input type="hidden" name="newones" id="allnewdata"/>
                                                <hr>
                                                <div class="alert alert-block">
                                                <span id="box1Counter" class="countLabel"></span>
                                                <select id="box1Storage" class="form-control"></select>
                                                </div> 
                                            </div> 
                                         </div>               
                                        <div class="col-lg-2">
                                        	<div class="col-lg-4 col-lg-offset-3">
                                            <br/><br/> 
                                            <div class="btn-group btn-group-vertical" style="white-space: normal;">
                                            <button name="addTeam1" type="submit" class="btn btn-primary" formaction="inTeam.php"><i class="icon-chevron-right icon-white"></i> </button>
                                            <button name="addTeam2" type="submit" class="btn btn-primary" formaction="inTeam.php"> <i class="icon-forward"></i> </button>
                                            <button name="removeTeam2" type="submit" class="btn btn-danger" formaction="outTeam.php"> <i class="icon-backward"></i> </button>
                                            <button name="removeTeam1" type="submit" class="btn btn-danger" formaction="outTeam.php"> <i class="icon-chevron-left icon-white"></i> </button>
                                            </div> 
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-5">
                                        <h5><strong>Team Members</strong></h5>
                                            <div class="form-group">
                                            	<div class="input-group">
                                            		<input id="box2Filter" type="text" placeholder="Filter" class="form-control" />
                                            		<span class="input-group-btn"> <button id="box2Clear" class="btn btn-warning" type="button">x</button></span>
                                            	</div> 
                                            </div>
                                                <div class="form-group">
                                                <select id="box2View" name="teamMember[]" multiple="multiple" class="form-control" size="16">";
													<?php
                                                    $getTeam=mysql_query("SELECT * FROM employee WHERE MGR_ID='".$_SESSION['EmpID']."'");
                                                    while ($members=mysql_fetch_array($getTeam)) {
                                                        echo "<option value=\"".$members['EMP_ID']."\">".$members['EMP_FNAME']." ".$members['EMP_LNAME']."</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <input type="hidden" name="outones" id="allbaddata"/>
                                                </div>
                                                <hr />
                                            <div class="alert alert-block">
                                                <span id="box2Counter" class="countLabel"></span>
                                                <select id="box2Storage" class="form-control"> </select>
                                            </div>
                                            </form> </div> 
                                        </div> 
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
?>
		<script src="assets/js/jquery-ui.min.js"></script>
        <script src="assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="assets/plugins/inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
        <script src="assets/plugins/chosen/chosen.jquery.min.js"></script>
        <script src="assets/plugins/colorpicker/js/bootstrap-colorpicker.js"></script>
        <script src="assets/plugins/tagsinput/jquery.tagsinput.min.js"></script>
        <script src="assets/plugins/validVal/js/jquery.validVal.min.js"></script>
        <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="assets/plugins/daterangepicker/moment.min.js"></script>
        <script src="assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>
        <script src="assets/plugins/timepicker/js/bootstrap-timepicker.min.js"></script>
        <script src="assets/plugins/switch/static/js/bootstrap-switch.min.js"></script>
        <script src="assets/plugins/jquery.dualListbox-1.3/jquery.dualListBox-1.3.min.js"></script>
        <script src="assets/plugins/autosize/jquery.autosize.min.js"></script>
        <script src="assets/plugins/jasny/js/bootstrap-inputmask.js"></script>
        <script src="assets/js/formsInit.js"></script>
        <script>
            $(function () { formInit(); });
        </script>
    <script>
    (function() {
        var newValues = [];
        $('#box1View option').each(function() { newValues.push($(this).val()); });
        document.getElementById("allnewdata").value=newValues;
        
        var teamOut = [];
        $('#box2View option').each(function() { teamOut.push($(this).val()); });
        document.getElementById("allbaddata").value=teamOut;
    })();
	</script>
    
<?php
	print_end();
	$profile=mysql_query("SELECT * FROM employee WHERE EMP_ID=\"".$_SESSION['EmpID']."\"");
	print_modal(mysql_fetch_array($profile));
	disconnect_database();
?>