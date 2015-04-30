<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	include_once("include_all_fns.php");
	print_header("Respond to Request");
	connect_database();
	if ($_SESSION['msg']!="") {
?>
	<script> window.onload=alert("<?php echo $_SESSION['msg']?>");</script> 
<?php
	}
	$_SESSION['msg']="";
	print_top($_SESSION['Level'], mysql_query("SELECT * FROM feedback WHERE MGR_ID='".$_SESSION['EmpID']."' AND READ_ALR=\"U\""), mysql_query("SELECT * FROM request WHERE MGR_ID='".$_SESSION['EmpID']."' AND READ_ALR=\"U\""));
	print_menu("Respond to Request",$_SESSION['Level'],$_SESSION['EmpID'],$_SESSION['FName']);
?>
    <div id="content">
        <div class="inner">
            <div class="row"> <div class="col-lg-12"> <h2> Pending Requests </h2> </div> </div>
            <hr />
            <p>Here are the requests you need to respond.</p>
    <?php
	$i=0;
	$absen=mysql_query("SELECT * FROM timecard WHERE MGR_ID='".$_SESSION['EmpID']."' AND VERIFIED='U'");
	while ($coming=mysql_fetch_array($absen)) {
		$tname=mysql_fetch_array(mysql_query("SELECT EMP_FNAME, EMP_LNAME FROM employee WHERE EMP_ID='".$coming['EMP_ID']."'"));
		$tcname=$tname[0]." ".$tname[1];
	?>
		<div class="panel panel-default" >
		<div class="panel-heading" > <h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i?>"><?php echo $tcname ?></a>
       		</h4> </div>
		<div id="collapse<?php echo $i?>" class="panel-collapse collapse in">
			<div class="panel-body">
			<strong>Time Card</strong><br/>
			<img src="<?php echo $coming['CARD_PATH']; ?>" width="50" height="100" />
        	</div>
		<div class="panel-body">
        		<button class="btn btn-primary" data-toggle="modal" data-target="#uiModal<?php echo $i ?>"> Respond Request </button>
		</div>
		
		<div class="col-lg-6">
			<div class="modal fade" id="uiModal<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog"> 
					<div class="modal-content">
						<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="H3">Respond to Request</h4> </div>
						<div class="modal-body"> <form action="update.php" method="post" role="form">
							<img src="<?php echo $coming['CARD_PATH'] ?>" />
							<input type="hidden" name="no" value="<?php echo $coming['UPLOAD_ID'] ?>" />
                            <div class="form-group">
								<label>Card ID</label> <input class="form-control" name="aid" />
							</div>
							<div class="form-group">
								<label>Card Date</label> <input type="date" class="form-control" name="adate" />
							</div>
							<div class="form-group">
								<label>Start Time</label> <input pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" class="form-control" name="astart" />
							</div>
							<div class="form-group">
								<label>End Time</label> <input pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" class="form-control" name="aend" />
							</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" name="utc" class="btn btn-primary">Save changes</button>
						</form> </div> 
					</div> 
				</div> 
			</div> 
		</div>
    </div>
 </div> </div>
	<?php 
	$i=$i+1;
	} 
	
	$j=2;
	$bill=mysql_query("SELECT * FROM receipts WHERE MGR_ID='".$_SESSION['EmpID']."' AND VERIFIED='U'");
	while ($unseen=mysql_fetch_array($bill)) {
		$getName=mysql_fetch_array(mysql_query("SELECT EMP_FNAME, EMP_LNAME FROM employee WHERE EMP_ID='".$pending['EMP_ID']."'"));
		$rcname=$getName[0]." ".$getName[1];
	?>
		<div class="panel panel-default" >
		<div class="panel-heading" > <h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $j?>"><?php echo $rcname ?></a>
       		</h4> </div>
		<div id="collapse<?php echo $j?>" class="panel-collapse collapse in">
			<div class="panel-body">
			<strong>Sales Receipt</strong><br/>
			<img src="<?php echo $unseen['RECEIPT_PATH']; ?>" width="50" height="100"/>
        	</div>
		<div class="panel-body">
        		<button class="btn btn-primary" data-toggle="modal" data-target="#uiModal<?php echo $j ?>"> Respond Request </button>
		</div>
		
		<div class="col-lg-6">
			<div class="modal fade" id="uiModal<?php echo $j ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog"> 
					<div class="modal-content">
						<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="H3">Respond to Request</h4> </div>
						<div class="modal-body"> <form action="update.php" method="post" role="form">
							<img src="<?php echo $unseen['RECEIPT_PATH'] ?>" />
                            <input type="hidden" name="num" value="<?php echo $unseen['UPLOAD_ID'] ?>" />
							<div class="form-group">
								<label>Receipt ID</label> <input type="text" class="form-control" name="rcptid" />
							</div>
							<div class="form-group">
								<label>Receipt Date</label> <input type="date" class="form-control" name="rcdate" />
							</div>
							<div class=\"form-group\">
								<label>Receipt Total</label> <input type="number" step="0.01" class="form-control" name="rctotl" />
							</div>
                        </div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary" name="urc">Save changes</button>
						</form> </div> </div>
					</div>
				</div>
			</div>
		</div>
   </div>
	<?php 
	$j=$j+1; 
	}
	
	$k=0;
	$request=mysql_query("SELECT * FROM request WHERE MGR_ID='".$_SESSION['EmpID']."'");
	while ($pending=mysql_fetch_array($request)) {
		$getName=mysql_fetch_array(mysql_query("SELECT EMP_FNAME, EMP_LNAME FROM employee WHERE EMP_ID='".$pending['EMP_ID']."'"));
		$name=$getName[0]." ".$getName[1];
		if ($pending['MGR_ID']!="admin") {
	?>
		<form method="post"> <div class="panel panel-default" > 
		<div class="panel-heading" > <h4 class="panel-title">
        <input type="hidden" name="rqid" value="<?php echo $pending['MSG_ID'] ?>" />
			<a data-toggle="collapse" data-parent="#accordion" href="#collapsa<?php echo $k?>"><?php echo $name ?></a>
       		</h4> </div>
		<div id="collapsa<?php echo $k?>" class="panel-collapse collapse">
			<div class="panel-body">
			<strong><?php echo $pending['TITLE'] ?></strong><br/>
			<?php echo $pending['REQUEST']; ?>
        	<br/> <br/>
        		<button type="submit" class="btn btn-success" name="forward" formaction="forward.php"> Forward to Admin </button>
                <button type="submit" class="btn btn-danger" formaction="<?php reject() ?>"> Reject Request </button>
		</form> </div> </div>
    <?php
		}
	$k=$k+1;
	}
	?>
    
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