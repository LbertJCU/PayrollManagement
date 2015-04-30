<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	include_once('include_all_fns.php');
	print_header("File Upload");
	connect_database();
	if ($_SESSION['msg']!="") {
?>
	<script> window.onload=alert("<?php echo $_SESSION['msg']?>");</script>
<?php } $_SESSION['msg']=""; ?>
	<script>
	function refresh() {
		var select=document.getElementById("sbj");
		if (select.options[select.selectedIndex].value == "tmcd") {
			document.getElementById("1").style.display = 'block';
			document.getElementById("2").style.display = 'none';
			document.getElementById("3").style.display = 'none';
			document.getElementById("go").innerHTML="Upload Files";
		}
		else if (select.options[select.selectedIndex].value == "slrp") {
			document.getElementById("1").style.display = 'none';
			document.getElementById("2").style.display = 'block'; 
			document.getElementById("3").style.display = 'none';
			document.getElementById("go").innerHTML="Upload Files";
		}
		else {
			document.getElementById("1").style.display = 'none';
			document.getElementById("2").style.display = 'none';
			document.getElementById("3").style.display = 'block';
			document.getElementById("go").innerHTML="Submit Request";
		}
	}
    </script>
<?php
	print_top($_SESSION['Level'], mysql_query("SELECT * FROM feedback WHERE MGR_ID='".$_SESSION['EmpID']."' AND READ_ALR=\"U\""), mysql_query("SELECT * FROM request WHERE MGR_ID='".$_SESSION['EmpID']."' AND READ_ALR=\"U\""));
	print_menu("File Upload",$_SESSION['Level'],$_SESSION['EmpID'],$_SESSION['FName']);
?>
	<div id="content"> 
        <div class="inner"> 
            <div class="row"> <div class="col-lg-12"> <h2> File Uploads </h2> </div> </div> <hr />
            <div class="row"> 
                <div class="col-lg-12"> 
                    <div class="panel panel-default">
                    	<div class="panel-heading"> Upload your Files </div>                   
                        <div class="panel-body">
                            <div class="panel-group" id="accordion" >
                            	<div class="body"> <form action="send.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                    <label>Subject of Upload </label>
                                    <select class="form-control" id="sbj" name="subject" onchange="refresh()"/>
                                            <option value="tmcd">Time Card</option>
                                            <option value="slrp">Sales Receipts</option>
                                            <!-- Second type of request (i.e. text request)-->
                                            <option value="lalala">Lalala</option>
                                        </select>
                                    <p id="file">
                                    	<div class="form-group" id="1" style="display:none;">
                                    		<label>Upload your time card here</label> 
                                        	<input id="file-4" type="file" class="file" name="card" data-upload-url="#" />
                                        </div>
                                    	<div class="form-group" id="2" style="display:none;">
                                        <label>Upload your sales receipts here</label> 
                                        <input id="file-5" class="file" type="file" name="bills[]" multiple  data-upload-url="#" data-preview-file-icon="" />
                                        </div>
                                        <div class="form-group" id="3" style="display:none;">
                                        <label>Write your details of request here</label>
                                        <textarea name='request' class='form-control' rows='10'></textarea>
                                        </div>
                                    </p>
                                    <button type="submit" id="go" name="upload" class="btn btn-primary"></button>
                                    </form> 
                                    <div> 
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
<script src="assets/js/fileinput.js"></script>
	<script>refresh();</script>
<?php
    print_end();
	$profile=mysql_query("SELECT * FROM employee WHERE EMP_ID=\"".$_SESSION['EmpID']."\"");
	print_modal(mysql_fetch_array($profile));
	disconnect_database();
?>