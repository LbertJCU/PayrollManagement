<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	include_once("include_all_fns.php");
	function setRead() {
		$feedbackid=$_POST['fid'];
		mysql_query("UPDATE feedback SET READ_ALR=\"R\" WHERE FEEDBACK_ID='".$feedbackid."'");
	}
	print_header("View Employee's Feedback");
?>
	<script language="JavaScript" type="text/javascript">
        function jumpTo(toMain, toNav)
        {
            parent.main.location.href = toMain;
            parent.navbar.location.href = toNav;
        }
    </script>
<?php
	connect_database();
	print_top($_SESSION['Level'], mysql_query("SELECT * FROM feedback WHERE MGR_ID='".$_SESSION['EmpID']."' AND READ_ALR=\"U\""), mysql_query("SELECT * FROM request WHERE MGR_ID='".$_SESSION['EmpID']."' AND READ_ALR=\"U\""));
	print_menu("View Employee's Feedback",$_SESSION['Level'],$_SESSION['EmpID'],$_SESSION['FName']);
?>
	<div id="content">
        <div class="inner">
        	<div class="row"> <div class="col-lg-12"> <h2> Manage Feedback </h2> </div> </div>
        <hr />
        <p>Here are feedbacks sent by your employees to you.</p>
            <div class="panel panel-default">
                <div class="panel-heading"> Feedback List </div>
                <div class="panel-body">
                    <div class="panel-group" id="accordion" >
                    <?php
                    $i=0;
					$feedbacks=mysql_query("SELECT * FROM feedback WHERE MGR_ID='".$_SESSION['EmpID']."' AND READ_ALR=\"U\"");
                    while ($feedback=mysql_fetch_array($feedbacks)) {
						$gname=mysql_fetch_array(mysql_query("SELECT EMP_FNAME, EMP_LNAME FROM employee WHERE EMP_ID='".$feedback['EMP_ID']."'"));
						$name=$gname[0]." ".$gname[1];
                        if ($feedback['READ_ALR']=="U") {
					?>
                    <form method="post">
                            <div class="panel panel-default" >
                                <div class="panel-heading" > <h4 class="panel-title"> <strong> 
                                <input type="hidden" name="fid" value="<?php echo $feedback['FEEDBACK_ID'] ?>"><a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i ?>" onClick="jumpTo(this.href,'setRead()'); return false;"> <?php echo $name.": ".$feedback['TITLE'] ?> </a> </strong> </h4> </div>
                                <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse">
                                    <div class="panel-body">
                                    <?php echo $feedback['FEEDBACK'];?>
                                    </div> 
                                </div> 
                            </div>
                            </form>
                     <?php
                        }
                        else if ($feedback['READ_ALR']=="R") {
                      ?>    
						    <div class="panel panel-default" >
                                <div class="panel-heading" > <h4 class=\"panel-title\"> <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i ?>"><?php echo $feedback['TITLE']." From: ".$name; ?></a> </h4> </div>
                                <div id="collapse<?php echo $i ?>" class="panel-collapse collapse">
                                    <div class="panel-body">
                                    <?php echo $feedback['FEEDBACK']; ?>
                                    </div> 
                                </div> 
                            </div>
                    <?php
                        }
                    $i=$i+1;
                    }
                    ?>
                </div>
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