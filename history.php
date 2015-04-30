<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	include_once("include_all_fns.php");
	print_header("View Payment History");
	connect_database();
	print_top($_SESSION['Level'], mysql_query("SELECT * FROM feedback WHERE MGR_ID='".$_SESSION['EmpID']."' AND READ_ALR=\"U\""), mysql_query("SELECT * FROM request WHERE MGR_ID='".$_SESSION['EmpID']."' AND READ_ALR=\"U\""));
	print_menu("View Payment History",$_SESSION['Level'],$_SESSION['EmpID'],$_SESSION['FName']);
?>
    <div id="content">
        <div class="inner">
            <div class="row"> <div class="col-lg-12"> <h2> <?php 
			if ($_SESSION['Level']=="Admin") echo "Recorded Transactions";
			else echo "Payment History";
			?> </h2> </div> </div>
            <hr />
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                            	<?php
								$level=$_SESSION['Level'];
								$admin=mysql_query("SELECT * FROM history WHERE EMP_ID!=\"".$_SESSION['EmpID']."\"");
								$others=mysql_query("SELECT * FROM history WHERE EMP_ID=\"".$_SESSION['EmpID']."\"");
                                if ($level=="Admin") {
								?>
                        			<div class="panel-heading"> All Employee Payments </div>
                        			<div class="panel-body">
                            		<div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <?php
                                    echo "<thead><tr><th>Payment ID</th><th>Employee ID</th><th>Employee Name</th><th>Date</th><th>Amount</th><th>Payment Method</th></tr></thead>";
                                echo "<tbody>";
                                    while ($Apymt=mysql_fetch_array($admin)) {
										$name=mysql_fetch_array(mysql_query("SELECT EMP_FNAME, EMP_LNAME FROM employee WHERE EMP_ID='".$Apymt['EMP_ID']."'"));
                                    echo "<tr class=\"gradeA\">";
									echo "<td>".$Apymt['PAYMENT_ID']."</td>";
                                    echo "<td>".$Apymt['EMP_ID']."</td>";
									echo "<td>".$name[0]." ".$name[1]."</td>";
                                    echo "<td>".$Apymt['PAY_DATE']."</td>";
                                    echo "<td> $".$Apymt['PAY_AMOUNT']."</td>";
                                    echo "<td>".$Apymt['PAY_METHOD']."</td>";
                                    echo "</tr>";
                                    }
                                }
                                if ($level=="Employee" || $level=="Manager") {
								?>
                                    <div class="panel-heading"> Payments Made to Me </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <?php
                                    echo "<thead><tr><th>Payment ID</th><th>Date</th><th>Amount</th><th>Payment Method</th></tr></thead>";
                                echo "<tbody>";
                                    while ($Opymt=mysql_fetch_array($others)) {
                                        echo "<tr>";
										echo "<td>".$Opymt['PAYMENT_ID']."</td>";
                                        echo "<td>".$Opymt['PAY_DATE']."</td>";
                                        echo "<td>$".$Opymt['PAY_AMOUNT']."</td>";
                                        echo "<td>".$Opymt['PAY_METHOD']."</td>";
                                        echo "</tr>";
                                    }
                                }
								?>
                                </tbody>
                            </table>
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
 <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
     <script>
         $(document).ready(function () {
             $('#dataTables-example').dataTable();
         });
    </script>
<?php
	print_end();
	$profile=mysql_query("SELECT * FROM employee WHERE EMP_ID=\"".$_SESSION['EmpID']."\"");
	print_modal(mysql_fetch_array($profile));
	mysql_close();
?>