<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	include_once("include_all_fns.php");
	print_header("Express Feedback");
	connect_database();
	if ($_SESSION['msg']!="") {
?>
	<script> window.onload=alert("<?php echo $_SESSION['msg']?>");</script>
<?php } $_SESSION['msg']="";
	print_top($_SESSION['Level'], mysql_query("SELECT * FROM feedback WHERE MGR_ID='".$_SESSION['EmpID']."' AND READ_ALR=\"U\""), mysql_query("SELECT * FROM request WHERE MGR_ID='".$_SESSION['EmpID']."' AND READ_ALR=\"U\""));
	print_menu("Express Feedback",$_SESSION['Level'],$_SESSION['EmpID'],$_SESSION['FName']);
?>
    <div id="content">
        <div class="inner">
            <div class="row"> <div class="col-lg-12"> <h2> Send Feedback </h2> </div> </div>
            <hr />
            <div id="div-1" class="body collapse in"> <form action="feedback.php" method="post">
            	<label>Title of feedback: </label> <input class="form-control" name="title" /> <p> </p>
                <p>Write down your feedbacks you wish to tell your manager here.</p>
            	<textarea id="wysihtml5" class="form-control" rows="10" name="feedback"></textarea>
                <div class="form-actions"> <br />
                    <input type="submit" name="send" value="Send Feedback" class="btn btn-primary" />
                </div> 
            </form> </div> 
        </div> 
    </div>
</div>
<?php
	print_footer();
	print_end();
	$profile=mysql_query("SELECT * FROM employee WHERE EMP_ID=\"".$_SESSION['EmpID']."\"");
	print_modal(mysql_fetch_array($profile));
	disconnect_database();
?>