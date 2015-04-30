<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	include_once("include_all_fns.php");
	print_header("View Colleague Profile");
	connect_database();
	print_top($_SESSION['Level'], mysql_query("SELECT * FROM feedback WHERE MGR_ID='".$_SESSION['EmpID']."' AND READ_ALR=\"U\""), mysql_query("SELECT * FROM request WHERE MGR_ID='".$_SESSION['EmpID']."'"));
	print_menu("View Colleague Profile",$_SESSION['Level'],$_SESSION['EmpID'],$_SESSION['FName']);
?>
    <div id="content">
        <div class="inner">
            <div class="row"> <div class="col-lg-12"> <h2> Colleagues </h2> </div> </div> <hr />
            <div class="row">
                <div class="col-lg-12">
                    <form action="" method="post">
                        <table width="100%"><tr>
                            <td width="20%"><label>Select an employee to view</label></td>
                            <td width="70%">
                                <select name="person" data-placeholder="Colleagues" class="form-control">
                                    <option selected="selected">Please select one</option>
                                    <?php
									$friends=mysql_query("SELECT * FROM Employee WHERE EMP_ID!=\"".$_SESSION['EmpID']."\" AND EMP_ID!=\"admin\"");
                                    while ($friend=mysql_fetch_array($friends)) {
                                        echo "<option value=\"".$friend['EMP_ID']."\">".$friend['EMP_FNAME']." ".$friend['EMP_LNAME']."</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit" name="viewColleague">
                                    <i class="icon-search"></i> </button> 
                                </span> 
                            </td>
                        </tr> </table>
                    </form> <br/>
                <?php
                if (isset($_POST['viewColleague'])) {
                    $person=mysql_query("SELECT * FROM employee WHERE EMP_ID='".$_POST['person']."'");
                    $display=mysql_fetch_array($person);
                    echo "<div class=\"row\">";
                    echo "<div class=\"col-lg-12\">";
                    echo "<div class=\"panel panel-default\">";
                    echo "<div class=\"panel-heading\"> ".$display['EMP_FNAME']." ".$display['EMP_LNAME']." </div>";
                    echo "<div class=\"panel-body\">";
                    echo "<div class=\"form-group\">";
                    echo "<label> First Name </label> <input class=\"form-control\" value=\"".$display['EMP_FNAME']."\" readonly/>";
                    echo "</div>";
                    echo "<div class=\"form-group\">";
                    echo "<label> Last Name </label> <input class=\"form-control\" value=\"".$display['EMP_LNAME']."\" readonly/>";
                    echo "</div>";
                    echo "<div class=\"form-group\">";
                    echo "<label> Position-POS </label> <input class=\"form-control\" value=\"".$display['EMP_POS']."\"  readonly/>";
                    echo "</div>";
                    echo "<div class=\"form-group\">"; 
                    echo "<label> Date of Birth </label> <input class=\"form-control\" value=\"".$display['EMP_DOB']."\" readonly/>";
                    echo "</div>";
                    echo "<div class=\"form-group\">";
                    echo "<label> Email </label> <input class=\"form-control\" value=\"".$display['EMP_EMAIL']."\" readonly/>";
                    echo "</div>";
                    echo "<div class=\"form-group\">";
                    echo "<label> Work History </label> <select class=\"form-control\" multiple readonly>";
                    while ($whst=mysql_fetch_array(mysql_query("SELECT * FROM workhistory WHERE EMP_ID='".$_POST['person']."'"))) {
                        echo "<option>".$whst['POSITION']." From : ".$whst['START_DATE']." To : ".$whst['END_DATE']."</option>";
                    }
                    echo "</select> </div>";
                    echo "</div> </div> </div>";
                }
				?>	 
                </div> 
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