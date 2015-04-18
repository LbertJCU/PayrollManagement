<?php
//Initialize document
function print_header($title) {
	echo "<!DOCTYPE html>";
	echo "<html>";
	echo "<!--[if IE 8]> <html lang=\"en\" class=\"ie8\"> <![endif]-->";
	echo "<!--[if IE 9]> <html lang=\"en\" class=\"ie9\"> <![endif]-->";
	echo "<!--[if !IE]><!--> <html lang=\"en\"> <!--<![endif]-->";
	
	echo "<head>";
	
	echo "<meta charset=\"UTF-8\">";
	echo "<title>".$title."</title>";
	echo "<meta content=\"width=device-width, initial-scale=1.0\" name=\"viewport\" />";
	echo "<meta content=\"\" name=\"description\" />";
	echo "<meta content=\"\" name=\"author\" />";
	
	echo "<!--[if IE]>";
    echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">";
    echo "<![endif]-->";
	
	echo "<link rel=\"stylesheet\" href=\"assets/plugins/bootstrap/css/bootstrap.css\" />";
    echo "<link rel=\"stylesheet\" href=\"assets/css/main.css\" />";
    echo "<link rel=\"stylesheet\" href=\"assets/css/theme.css\" />";
    echo "<link rel=\"stylesheet\" href=\"assets/css/MoneAdmin.css\" />";
    echo "<link rel=\"stylesheet\" href=\"assets/plugins/Font-Awesome/css/font-awesome.css\" />";
	
	echo "<link href=\"assets/plugins/jquery-steps-master/demo/css/jquery.steps.css\" rel=\"stylesheet\" />";    
	echo "<link href=\"assets/css/jquery-ui.css\" rel=\"stylesheet\" />";
	echo "<link rel=\"stylesheet\" href=\"assets/plugins/uniform/themes/default/css/uniform.default.css\" />";
	echo "<link rel=\"stylesheet\" href=\"assets/plugins/inputlimiter/jquery.inputlimiter.1.0.css\" />";
	echo "<link rel=\"stylesheet\" href=\"assets/plugins/chosen/chosen.min.css\" />";
	echo "<link rel=\"stylesheet\" href=\"assets/plugins/colorpicker/css/colorpicker.css\" />";
	echo "<link rel=\"stylesheet\" href=\"assets/plugins/tagsinput/jquery.tagsinput.css\" />";
	echo "<link rel=\"stylesheet\" href=\"assets/plugins/daterangepicker/daterangepicker-bs3.css\" />";
	echo "<link rel=\"stylesheet\" href=\"assets/plugins/datepicker/css/datepicker.css\" />";
	echo "<link rel=\"stylesheet\" href=\"assets/plugins/timepicker/css/bootstrap-timepicker.min.css\" />";
	echo "<link rel=\"stylesheet\" href=\"assets/plugins/switch/static/stylesheets/bootstrap-switch.css\" />";
	echo "<link rel=\"stylesheet\" href=\"assets/css/bootstrap-fileupload.min.css\" />";
	
	echo "<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->";
    echo "<!--[if lt IE 9]>";
    echo "<script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>";
    echo "<script src=\"https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js\"></script>";
    echo "<![endif]-->";
	
	echo "</head>";
}
//End of document initialization

//Printing header
function print_top($level, $msgdata) {
	echo "<body class=\"padTop53 \" >";
	echo "<div id=\"wrap\">";
	echo "<div id=\"top\">";
	echo "<nav class=\"navbar navbar-inverse navbar-fixed-top\" style=\"padding-top: 10px;\">";
    echo "<a data-original-title=\"Show/Hide Menu\" data-placement=\"bottom\" data-tooltip=\"tooltip\" class=\"accordion-toggle btn btn-primary btn-sm visible-xs\" data-toggle=\"collapse\" href=\"#menu\" id=\"menu-toggle\">";
    echo "<i class=\"icon-align-justify\"></i>";
	echo "</a>";

    echo "<header class=\"navbar-header\">";
	echo "<a href=\"profile.php\" class=\"navbar-brand\">";
	echo "<img src=\"assets/img/logo.png\" width=\"\" height=\"40\" alt=\"\" /></a>";
    echo "</header>";

    echo "<ul class=\"nav navbar-top-links navbar-right\">";
	
	if ($level=="Admin") {					
    echo "<li class=\"dropdown\">";
		echo "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">";
		echo "<i class=\"icon-home\"></i>&nbsp; <i class=\"icon-chevron-down \"></i>";
		echo "</a>";

		echo "<ul class=\"dropdown-menu dropdown-user\">";
		echo "<li> <a href=\"#\"><i class=\"icon-lock\"></i> Administration</a> </li>";
		echo "<li> <a href=\"#\"><i class=\"icon-usd\"></i> Proceed Payment</a> </li>";
		echo "</ul>";
	echo "</li>";
	}
	
	if ($level=="Manager"||$level=="Admin") {
     echo "<li class=\"dropdown\">";
     echo "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">";
     echo "<span class=\"label label-success\">".count($msgdata)."</span> <i class=\"icon-envelope-alt\"></i>&nbsp; <i class=\"icon-chevron-down\"></i>";
     echo "</a>";
	 echo "<ul class=\"dropdown-menu dropdown-messages\">";
	 while ($msgdtl=mysql_fetch_array($msgdata)) {
		 echo "<li>";
		 echo "<a href=\"#\">";
		 echo "<div>";
		 echo "<strong>".$msgdtl['SenderName']."</strong>";
         echo "<span class=\"pull-right text-muted\">";
         echo "<em>".$msgdtl['Date Sent']."</em>";
         echo "</span>";
		 echo "</div>";
         echo "<div>".$msgdtl['Message']."<br /> <span class=\"label label-primary\">".$msgdtl['Priority']."</span> </div>";
         echo "</a>";
         echo "</li>";
         echo "<li class=\"divider\"></li>";
	 }
	echo "<li>";
	echo "<a class=\"text-center\" href=\"#\">";
    echo "<strong>Read All Messages</strong>";
    echo "<i class=\"icon-angle-right\"></i>";
    echo "</a>";
    echo "</li>";
    echo "</ul>";
	echo "</li>";
	}
		echo "<li class=\"dropdown\">";
		echo "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">";
		echo "<i class=\"icon-user\"></i>&nbsp; <i class=\"icon-chevron-down\"></i>";
		echo "</a>";
		echo "<ul class=\"dropdown-menu dropdown-user\">";
		echo "<li><a href=\"Profile.php\"><i class=\"icon-user\"></i> User Profile </a></li>";
		echo "<li class=\"divider\"></li>";
        echo "<li><a href=\"logout.php\"><i class=\"icon-signout\"></i> Logout </a></li>";
        echo "</ul>";
		echo "</li>";

        echo "</ul>";

        echo "</nav>";

        echo "</div>";
}
//End of printing header

//Printing navigational menus
function print_menu($title,$level,$employeeID,$firstName) {
	echo "<div id=\"left\">";
	echo "<div class=\"media user-media well-small\">";
	echo "<a class=\"user-link\" href=\"#\">";
	echo "<img class=\"media-object img-thumbnail user-img\" alt=\"User Picture\" src=\"assets/img/".$employeeID.".png\" width=\"85\" height=\"\" />";
	echo "</a>";
	echo "<br />";
	echo "<div class=\"media-body\">";
	echo "<h5 class=\"media-heading\">".$firstName."</h5>";
	echo "<ul class=\"list-unstyled user-info\">";
	echo "<li> <a style=\"width: 10px;height: 12px;\"></a> POS: ".$level."</li>";
	echo "</ul>";
	echo "</div>";
	echo "<br />";
	echo "</div>";
	
	echo "<ul id=\"menu\" class=\"collapse\">";
	if ($level=="Employee") {
		if ($title=="View Profile") echo "<li class=\"panel active\"><a href=\"profile.php\"> <i class=\"icon-user\"></i> Profile </a> </li>"; 
		else echo "<li class=\"panel\"><a href=\"profile.php\"> <i class=\"icon-user\"></i> Profile </a> </li>";
		if ($title=="View Colleague Profile") echo "<li class=\"panel active\"> <a href=\"colleague.php\"> <i class=\"icon-sitemap\"></i> Colleagues </a> </li>";
		else echo "<li class=\"panel\"> <a href=\"colleague.php\"> <i class=\"icon-sitemap\"></i> Colleagues </a> </li>";
		if ($title=="File Upload") {
			echo "<li class=\"panel active\" class=\"panel\">";
			echo "<a href=\"#\" data-parent=\"#menu\" data-toggle=\"collapse\" class=\"accordion-toggle\" data-target=\"#blank-nav\">";
			echo "<i class=\"icon-pencil\"></i> Requests";
			echo "<span class=\"pull-right\"> <i class=\"icon-angle-left\"></i> </span>";
			echo "&nbsp; <span class=\"label label-success\"></span>&nbsp; </a>";
			echo "<ul class=\"collapse\" id=\"blank-nav\">";
            echo "<liclass=\"panel active\"><a href=\"upload.php\"><i class=\"icon-upload\"></i> Post File  </a></li>";
            echo "<li><a href=\"writeFeedback.php\"><i class=\"icon-edit\"></i> Feedback  </a></li>";
			echo "</ul> </li>";
		}
		else if ($title=="Express Feedback") {
			echo "<li class=\"panel active\" class=\"panel\">";
			echo "<a href=\"#\" data-parent=\"#menu\" data-toggle=\"collapse\" class=\"accordion-toggle\" data-target=\"#blank-nav\">";
			echo "<i class=\"icon-pencil\"></i> Requests";
			echo "<span class=\"pull-right\"> <i class=\"icon-angle-left\"></i> </span>";
			echo "&nbsp; <span class=\"label label-success\"></span>&nbsp; </a>";
			echo "<ul class=\"collapse\" id=\"blank-nav\">";
            echo "<li><a href=\"upload.php\"><i class=\"icon-upload\"></i> Post File  </a></li>";
            echo "<li class=\"panel active\"><a href=\"writeFeedback.php\"><i class=\"icon-edit\"></i> Feedback  </a></li>";
			echo "</ul> </li>";
		}
		else {
			echo "<li class=\"panel\" class=\"panel\">";
			echo "<a href=\"#\" data-parent=\"#menu\" data-toggle=\"collapse\" class=\"accordion-toggle\" data-target=\"#blank-nav\">";
			echo "<i class=\"icon-pencil\"></i> Requests";
			echo "<span class=\"pull-right\"> <i class=\"icon-angle-left\"></i> </span>";
			echo "&nbsp; <span class=\"label label-success\"></span>&nbsp; </a>";
			echo "<ul classs=\"collapse\" id=\"blank-nav\">";
			echo "<li><a href=\"upload.php\"><i class=\"icon-upload\"></i> Post File  </a></li>";
			echo "<li><a href=\"writeFeedBack.php\"><i class=\"icon-edit\"></i> Feedback  </a></li>";
			echo "</ul> </li>";
			echo "<li class=\"panel\">";
		}
		if ($title=="View Payment History") echo "<li class=\"panel active\"> <a href=\"history.php\"> <i class=\"icon-list\"></i> Payment History </a> </li>";
		else echo "<li class=\"panel\"> <a href=\"history.php\"> <i class=\"icon-list\"></i> Payment History </a> </li>";
	}
	if ($level=="Manager") {
		if ($title=="View Profile") echo "<li class=\"panel active\"><a href=\"profile.php\"> <i class=\"icon-user\"></i> Profile </a> </li>";
		else echo "<li class=\"panel\"><a href=\"profile.php\"> <i class=\"icon-user\"></i> Profile </a> </li>";
		if ($title=="View Colleague Profile") echo "<li class=\"panel active\"> <a href=\"colleague.php\"> <i class=\"icon-sitemap\"></i> Colleagues </a> </li>";
		else echo "<li class=\"panel\"> <a href=\"colleague.php\"> <i class=\"icon-sitemap\"></i> Colleagues </a> </li>";
		if ($title=="Team Management") echo "<li class=\"panel active\"> <a href=\"team.php\"> <i class=\"icon-group\"></i> Manage Team </a> </li>";
		else echo "<li class=\"panel\"> <a href=\"team.php\"> <i class=\"icon-group\"></i> Manage Team </a> </li>";
		if ($title=="File Upload") {
			echo "<li class=\"panel active\" class=\"panel\">";
			echo "<a href=\"#\" data-parent=\"#menu\" data-toggle=\"collapse\" class=\"accordion-toggle\" data-target=\"#blank-nav\">";
			echo "<i class=\"icon-pencil\"></i> Requests";
			echo "<span class=\"pull-right\"> <i class=\"icon-angle-left\"></i> </span>";
			echo "&nbsp; <span class=\"label label-success\"></span>&nbsp; </a>";
			echo "<ul class=\"collapse\" id=\"blank-nav\">";
            echo "<liclass=\"panel active\"><a href=\"upload.php\"><i class=\"icon-upload\"></i> Post File  </a></li>";
            echo "<li><a href=\"writeFeedback.php\"><i class=\"icon-edit\"></i> Feedback  </a></li>";
			echo "</ul> </li>";
		}
		else if ($title=="Express Feedback") {
			echo "<li class=\"panel active\" class=\"panel\">";
			echo "<a href=\"#\" data-parent=\"#menu\" data-toggle=\"collapse\" class=\"accordion-toggle\" data-target=\"#blank-nav\">";
			echo "<i class=\"icon-pencil\"></i> Requests";
			echo "<span class=\"pull-right\"> <i class=\"icon-angle-left\"></i> </span>";
			echo "&nbsp; <span class=\"label label-success\"></span>&nbsp; </a>";
			echo "<ul class=\"collapse\" id=\"blank-nav\">";
            echo "<li><a href=\"upload.php\"><i class=\"icon-upload\"></i> Post File  </a></li>";
            echo "<li class=\"panel active\"><a href=\"writeFeedback.php\"><i class=\"icon-edit\"></i> Feedback  </a></li>";
			echo "</ul> </li>";
		}
		else {
			echo "<li class=\"panel\" class=\"panel\">";
			echo "<a href=\"#\" data-parent=\"#menu\" data-toggle=\"collapse\" class=\"accordion-toggle\" data-target=\"#blank-nav\">";
			echo "<i class=\"icon-pencil\"></i> Requests";
			echo "<span class=\"pull-right\"> <i class=\"icon-angle-left\"></i> </span>";
			echo "&nbsp; <span class=\"label label-success\"></span>&nbsp; </a>";
			echo "<ul classs=\"collapse\" id=\"blank-nav\">";
			echo "<li><a href=\"upload.php\"><i class=\"icon-upload\"></i> Post File  </a></li>";
			echo "<li><a href=\"writeFeedBack.php\"><i class=\"icon-edit\"></i> Feedback  </a></li>";
			echo "</ul> </li>";
		}
		if ($title=="View Employee's Feedback") echo "<li class=\"panel active\"> <a href=\"viewFeedBack.php\" > <i class=\"icon-comments-alt\"></i> View Feedback </a> </li>";
		else echo "<li class=\"panel\"> <a href=\"viewFeedBack.php\" > <i class=\"icon-comments-alt\"></i> View Feedback </a> </li>";
		if ($title=="Respond to Request") echo "<li class=\"panel active\"> <a href=\"response.php\"> <i class=\"icon-question-sign\"></i> Pending Requests </a> </li>";
		else echo "<li class=\"panel\"> <a href=\"response.php\"> <i class=\"icon-question-sign\"></i> Pending Requests </a> </li>";
		if ($title=="View Payment History") echo "<li class=\"panel active\"> <a href=\"history.php\"> <i class=\"icon-list\"></i> Payment History </a> </li>";
		else echo "<li class=\"panel\"> <a href=\"history.php\"> <i class=\"icon-list\"></i> Payment History </a> </li>";
	}
	if ($level=="Admin") {
		if ($title=="View Profile") echo "<li class=\"panel active\"><a href=\"profile.php\"> <i class=\"icon-user\"></i> Profile </a> </li>";
		else echo "<li class=\"panel\"><a href=\"profile.php\"> <i class=\"icon-user\"></i> Profile </a> </li>";
		if ($title=="Respond to Request") echo "<li class=\"panel active\"> <a href=\"response.php\"> <i class=\"icon-question-sign\"></i> Pending Requests </a> </li>";
		else echo "<li class=\"panel\"> <a href=\"response.php\"> <i class=\"icon-question-sign\"></i> Pending Requests </a> </li>";
		if ($title=="View Colleague Profile") echo "<li class=\"panel active\"> <a href=\"colleague.php\"> <i class=\"icon-sitemap\"></i> Colleagues </a> </li>";
		else echo "<li class=\"panel\"> <a href=\"colleague.php\"> <i class=\"icon-sitemap\"></i> Colleagues </a> </li>";
		if ($title=="Team Management") echo "<li class=\"panel active\"> <a href=\"team.php\"> <i class=\"icon-group\"></i> Manage Team </a> </li>";
		else echo "<li class=\"panel\"> <a href=\"team.php\"> <i class=\"icon-group\"></i> Manage Team </a> </li>";
		if ($title=="View Employee's Feedback") echo "<li class=\"panel active\"> <a href=\"viewFeedBack.php\" > <i class=\"icon-comments-alt\"></i> View Feedback </a> </li>";
		else echo "<li class=\"panel\"> <a href=\"viewFeedBack.php\" > <i class=\"icon-comments-alt\"></i> View Feedback </a> </li>";
		if ($title=="Employee Management") echo "<li class=\"panel active\"> <a href=\"manage.php\"> <i class=\"icon-group\"></i> Manage Employee </a> </li>";
		else echo "<li class=\"panel\"> <a href=\"manage.php\"> <i class=\"icon-group\"></i> Manage Employee </a> </li>";
		if ($title=="View Payment History") echo "<li class=\"panel active\"> <a href=\"history.php\"> <i class=\"icon-list\"></i> Payment History </a> </li>";
		else echo "<li class=\"panel\"> <a href=\"history.php\"> <i class=\"icon-list\"></i> Payment History </a> </li>";
	}
	echo "</ul>";
	echo "</div>";
}
//End of printing menu

// Printing of contents
function print_request($action) {
	echo "<div id=\"content\"> <div class=\"inner\"> <div class=\"row\"> <div class=\"col-lg-12\">";
	echo "<h2> File Uploads </h2> </div> </div> <hr />";
	echo "<div class=\"body\"> <form action=\"".$action."\" lass=\"form-horizontal\">";
	echo "<div class=\"form-group\">";
	echo "<label class=\"control-label col-lg-4\">Upload Time Card</label>";
	echo "<div class=\"col-lg-8\">";
	echo "<div class=\"fileupload fileupload-new\" data-provides=\"fileupload\">";
	echo "<div class=\"input-group\">";
	echo "<span class=\"btn btn-file btn-info\">";
	echo "<span class=\"fileupload-new\">Select file</span>";
	echo "<span class=\"fileupload-exists\">Change</span>";
	echo "<input type=\"file\" name=\"timecard\" />";
	echo "</span>";
	echo "<a href=\"#\" class=\"btn btn-danger fileupload-exists\" data-dismiss=\"fileupload\">Remove</a>";
	echo "<br /> <br />";
	echo "<div class=\"col-lg-3\">";
	echo "<i class=\"icon-file fileupload-exists\"></i> <span class=\"fileupload-preview\"></span>";
	echo "</div> </div> </div> </div> </div>";
	echo "<div class=\"form-group\">";
	echo "<label class=\"control-label col-lg-4\">Upload Sales Receipt</label>";
	echo "<div class=\"col-lg-8\">";
	echo "<div class=\"fileupload fileupload-new\" data-provides=\"fileupload\">";
	echo "<div class=\"input-group\">";
	echo "<span class=\"btn btn-file btn-info\">";
	echo "<span class=\"fileupload-new\">Select file</span>";
	echo "<span class=\"fileupload-exists\">Change</span>";
	echo "<input type=\"file\" name=\"receipt[]\" multiple/>";
	echo "</span>";
	echo "<a href=\"#\" class=\"btn btn-danger fileupload-exists\" data-dismiss=\"fileupload\">Remove</a>";
	echo "<br /> <br />";
	echo "<div class=\"col-lg-3\">";
	echo "<i class=\"icon-file fileupload-exists\"></i> <span class=\"fileupload-preview\"></span>";
	echo "<table><tr><td><button type=\"submit\" name=\"upload\" class=\"btn btn-primary\">Upload Files</button></td>";
	echo "<td width=\"50\"></td>";
	echo "<td><button type=\"reset\" class=\"btn btn-primary\">Reset Form</button></td></tr></table>";
	echo "</div> </div> </div> </div> </div>";
	echo "</form> </div> </div> </div> </div> </div> </div> </div>";
}

function print_colleague($friends) {
	echo "<div id=\"content\">";
    echo "<div class=\"inner\" >";
    echo "<div class=\"row\">";
    echo "<div class=\"col-lg-12\">";
    echo "<h2> Colleagues </h2>";
    echo "</div> </div> <hr />";
    echo "<div class=\"row\">";
    echo "<div class=\"col-lg-12\">";
	echo "<form action=\"\" method=\"post\">";
    echo "<div class=\"form-group\">";
	echo "<label class=\"control-label col-lg-3\">Select an employee to view</label>";
	echo "<div class=\"col-lg-8\">";
	echo "<select name=\"person\" data-placeholder=\"Colleagues\" class=\"form-control chzn-select-deselect\" tabindex=\"7\">";
	echo "<option selected=\"selected\">Please select one</option>";
	while ($friend=mysql_fetch_array($friends)) {
		echo "<option value=\"".$friend['EmployeeID']."\">".$friend['EmpFirstName']." ".$friend['EmpLastName']."</option>";
	}
	echo "</select>";
	echo "<input type=\"submit\" class=\"btn btn-default\" name=\"viewColleague\" value=\"View\" />";
	if (isset($_POST['viewColleague'])) {
		$person=mysql_query("SELECT * FROM employee WHERE EmployeeID='".$_POST['person']."'");
		$display=mysql_fetch_array($person);
		echo "<div class=\"form-group\">";
		echo "<label> First Name </label> <input disabled class=\"form-control\" value=\"".$display['EmpFirstName']."\"/>";
		echo "</div>";
		echo "<div class=\"form-group\">";
		echo "<label> Last Name </label> <input disabled class=\"form-control\" value=\"".$display['EmpLastName']."\"/>";
		echo "</div>";
		echo "<div class=\"form-group\">";
		echo "<label> Position-POS </label> <input disabled class=\"form-control\" value=\"".$display['Level']."\"/>";
		echo "</div>";
		echo "<div class=\"form-group\">"; 
		echo "<label> Date of Birth </label> <input disabled class=\"form-control\" value=\"".$display['EmployeeDOB']."\"/>";
		echo "</div>";
		echo "<div class=\"form-group\">";
		echo "<label> Email </label> <input disabled class=\"form-control\" value=\"".$display['EmployeeEmail']."\"/>";
		echo "</p></div>";
	}	
    echo "</div> </div> </div> </div> </div>";
    echo "</div>";
}

function print_team($getNew, $recruit, $getTeam, $terminate) {
		echo "<div id=\"content\">";
		echo "<div class=\"inner\" >";
        echo "<div class=\"row\">";
        echo "<div class=\"col-lg-12\">";
        echo "<h2> Team Management </h2>";
        echo "</div>";
        echo "</div>";
        echo "<hr />";
        echo "<div class=\"row\">";
        echo "<div class=\"col-lg-12\">";
        echo "<div class=\"box\">";
          echo "<header>";
          echo "<h5><i class=\"icon-th-large\"></i> Searching for Colleagues</h5>";    
          echo "<div class=\"toolbar\">";
          echo "<ul class=\"nav pull-right\">";
           echo "<li> <a class=\"accordion-toggle minimize-box\" data-toggle=\"collapse\" href=\"#div-3\">";
           echo "<i class=\"icon-chevron-up\"></i> </a> </li>";
          echo "</ul> </div> </header>";
          echo "<div id=\"div-3\" class=\"accordion-body collapse in body\">";
          echo "<div class=\"row\">";
          echo "<div class=\"col-lg-5\">";
          echo "<div class=\"form-group\">";
          echo "<div class=\"input-group\">";
          echo "<input id=\"box1Filter\" type=\"text\" placeholder=\"Filter\" class=\"form-control\" />";
          echo "<span class=\"input-group-btn\">";
          echo "<button id=\"box1Clear\" class=\"btn btn-warning\" type=\"button\">x</button> </span>";
          echo "</div> </div>";
        echo "<div class=\"form-group\">";
        echo "<select id=\"box1View\" multiple=\"multiple\" class=\"form-control\" size=\"16\">";
		while ($members=mysql_fetch_array($getNew)) {
			echo "<option value=\"".$members['EmployeeID']."\">".$members['EmpFirstName']." ".$members['EmpLastName']."</option>";
		}
        echo "</select>";
        echo "<hr>";
        echo "<div class=\"alert alert-block\">";
        echo "<span id=\"box1Counter\" class=\"countLabel\"></span>";
        echo "<select id=\"box1Storage\" class=\"form-control\"> </select>";
        echo "</div> </div> </div>";
                    
        echo "<div class=\"col-lg-2\">";
        echo "<div class=\"btn-group btn-group-vertical\" style=\"white-space: normal;\">";
        echo "<button id=\"to2\" name=\"addTeam\" type=\"button\" class=\"btn btn-primary\" formaction=\"".$recruit."\"> <i class=\"icon-chevron-right\"></i> </button>";
		echo "<button id=\"allTo2\" name=\"addTeam\" type=\"button\" class=\"btn btn-primary\" formaction=\"".$recruit."\"> <i class=\"icon-forward\"></i> </button>";
        echo "<button id=\"allTo1\" type=\"button\" class=\"btn btn-danger\" formaction=\"".$terminate."\"> <i class=\"icon-backward\"></i> </button>";
        echo "<button id=\"to1\" type=\"button\" class=\"btn btn-danger\" formaction=\"".$terminate."\"> <i class=\"icon-chevron-left icon-white\"></i> </button>";
        echo "</div> </div>";
    
		echo "<div class=\"col-lg-5\">";
        echo "<div class=\"form-group\">";
        echo "<div class=\"input-group\">";
        echo "<input id=\"box2Filter\" type=\"text\" placeholder=\"Filter\" class=\"form-control\" />";
        echo "<span class=\"input-group-btn\"> <button id=\"box2Clear\" class=\"btn btn-warning\" type=\"button\">x</button></span>";
        echo "</div> </div>";
        echo "<div class=\"form-group\">";
        echo "<select id=\"box2View\" multiple=\"multiple\" class=\"form-control\" size=\"16\">";
		while ($members=mysql_fetch_array($getTeam)) {
			echo "<option value=\"".$members['EmployeeID']."\">".$members['EmpFirstName']." ".$members['EmpLastName']."</option>";
		}
        echo "</select>";
        echo "</div>";
        echo "<hr />";
        echo "<div class=\"alert alert-block\">";
        echo "<span id=\"box2Counter\" class=\"countLabel\"></span>";
        echo "<select id=\"box2Storage\" class=\"form-control\"></select>";
        echo "</div> </div> </div> </div> </div> </div> </div> </div> </div> </div>";
		echo "</div>"; 
}

function print_payment($others,$admin) {
	echo "<div id=\"content\">";
	echo "<div class=\"inner\" >";
	echo "<div class=\"row\">";
	echo "<div class=\"col-lg-12\">";
	echo "<h2> Payment History </h2>";
	echo "</div>";
	echo "</div>";
	echo "<hr />";
	echo "<div class=\"panel-body\">";
    echo "<div class=\"table-responsive\">";
    echo "<table class=\"table table-striped table-bordered table-hover\" id=\"dataTables-example\">";
    echo "<thead><tr><th>Employee ID</th><th>Date</th><th>Amount</th><th>Payment Method</th></tr></thead>";
	echo "<tbody>";
	if ($_SESSION['Level']=="Admin") {
		while ($Apymt=mysql_fetch_array($admin)) {
		echo "<tr>";
		echo "<td>".$Apymt['EmployeeID']."</td>";
		echo "<td>".$Apymt['PaymentDate']."</td>";
		echo "<td>".$Apymt['PaymentAmount']."</td>";
		echo "<td>".$Apymt['PaymentMethod']."</td>";
		echo "</tr>";
		}
	}
	else while ($Opymt=mysql_fetch_array($others)) {
		echo "<tr>";
		echo "<td>".$Opymt['PaymentDate']."</td>";
		echo "<td>".$Opymt['PaymentAmount']."</td>";
		echo "<td>".$Opymt['PaymentMethod']."</td>";
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
	echo "</div> </div> </div> </div> </div> </div> </div>";
	echo "</div>";
	echo "</div>";
}

function print_profile($Employee, $Account, $action) { 
    echo "<div id=\"content\">";
    echo "<div class=\"inner\">";
    echo "<div class=\"row\"> <div class=\"col-lg-12\"> <h2> Profile </h2> </div> </div>";
    echo "<hr />";
    echo "<div class=\"row\"> <div class=\"col-lg-9\">";
	echo "<div class=\"panel panel-default\">";
    echo "<div class=\"panel-heading\"> View Profile </div>";
    echo "<div class=\"panel-body\" >";
	echo "<div id= \"wizard\" >";
	echo "<h2> Personal </h2>";
	echo "<section>";
	echo "<form action=\"".$action."\" method=\"post\" role=\"form\">";
	echo "<div class=\"form-group\">";
	echo "<label> First Name </label> <input class=\"form-control\" value=\"".$Employee['EmpFirstName']."\"/>";
	echo "</div>";
	echo "<div class=\"form-group\">";
	echo "<label> Last Name </label> <input class=\"form-control\" value=\"".$Employee['EmpLastName']."\"/>";
    echo "</div>";
	echo "<div class=\"form-group\">";
	echo "<label> Position-POS </label> <input class=\"form-control\" value=\"".$Employee['Level']."\"/>";
    echo "</div>";
	echo "<div class=\"form-group\">"; 
	echo "<label> Date of Birth </label> <input class=\"form-control\" value=\"".$Employee['EmployeeDOB']."\"/>";
	echo "</div>";
	echo "</form> </section>";
	
	echo "<h2> Contact </h2>";
	echo "<section>";
	echo "<form role=\"form\">";
	echo "<div class=\"form-group\">";
	echo "<label> Email </label> <input class=\"form-control\" value=\"".$Employee['EmployeeEmail']."\"/>";
    echo "</div>";
	echo "<div class=\"form-group\">";
	echo "<label> Contact </label> <input class=\"form-control\" value=\"".$Employee['EmpContact']."\"/>";
    echo "</div>";
	echo "<div class=\"form-group\">";
	echo "<label> Address </label> <input class=\"form-control\" value=\"".$Employee['EmployeeAddress']."\"/>";
	echo "</div>";
	echo "<div class=\"form-group\">";
	echo "<label> Payment Method </label>";
	echo "<select class=\"form-control\">";
	if ($Employee['PaymentMethod']=="cash") {
		echo "<option value=\"cash\" selected>Cash</option>";
		echo "<option value=\"delver\">Delivered to Postal Address</option>";
		echo "<option value=\"trnsfr\">Transfer to Bank Account</option>";
	}
	else if ($Employee['PaymentMethod']=="delver") {
		echo "<option value=\"cash\">Cash</option>";
		echo "<option value=\"delver\" selected>Delivered to Postal Address</option>";
		echo "<option value=\"trnsfr\">Transfer to Bank Account</option>";
	}
	else if ($Employee['PaymentMethod']=="trnsfr") {
		echo "<option value=\"cash\">Cash</option>";
		echo "<option value=\"delver\">Delivered to Postal Address</option>";
		echo "<option value=\"trnsfr\" selected>Transfer to Bank Account</option>";
	}
	echo "</select>";
	echo "</div>";
	echo "<div class=\"form-group\">";
	if ($Employee['PaymentMethod']=="trnsfr") {
		echo "<label> Bank Account </label> <input class=\"form-control\" value=\"".$Employee['BankAccount']."\"/>";
	}
	else if ($Employee['PaymentMethod']=="cash"||$Employee['PaymentMethod']=="delver") {
		echo "<label> Bank Account </label> <input class=\"form-control\" />";
	}
	echo "</div>";
	echo "</form> </section>";

    echo "<h2>Extras </h2>";
    echo "<section>";
	echo "<form role=\"form\">";
	echo "<div class=\"form-group\">";
    echo "<div class=\"form-group\">";
	echo "<label> Qualification </label> <input class=\"form-control\" />";
	echo "</div>";
    echo "<div class=\"form-group\">";
	echo "<label> Career History </label> <textarea class=\"form-control\" rows=\"6\" >".$Employee['CareerHst']."</textarea>";
	echo "</div>";
	echo "</form> </section>";
	echo "</div> </div> </div> </div>";
                                  
    echo "<div class=\"row\"> <div class=\"col-lg-3\"> <div class=\"panel panel-default\">";
    echo "<div class=\"panel-heading\"> Edit Profile </div>";
    echo "<div class=\"panel-body\" > <div id= \"wizard\" >";
	echo "<section>";
	echo "<form role=\"form\">";
	echo "<div class=\"form-group\">";
	echo "<label>Password</label> <input type=\"password\" class=\"form-control\" value=\"".$Account['Password']."\"/>";
    echo "</div>"; 
	echo "<div class=\"form-group\">";
	echo "<label>Email</label> <input class=\"form-control\" value=\"".$Employee['EmployeeEmail']."\"/>";
	echo "</div>";
	echo "<div class=\"form-group\">";
	echo "<label>Contact</label> <input class=\"form-control\" value=\"".$Employee['EmpContact']."\"/>";
	echo "</div>";
	echo "<div class=\"form-group\">";
	echo "<label>Address</label> <input class=\"form-control\" value=\"".$Employee['EmployeeAddress']."\"/>";
	echo "</div>";
	echo "<div class=\"form-group\">";
	if ($Employee['PaymentMethod']=="trnsfr") {
		echo "<label> Bank Account </label> <input class=\"form-control\" value=\"".$Employee['BankAccount']."\"/>";
	}
	else if ($Employee['PaymentMethod']=="cash"||$Employee['PaymentMethod']=="delver") {
		echo "<label> Bank Account </label> <input class=\"form-control\" />";
	}
    echo "</div>";
	echo "<div class=\"form-group\">";
	echo "<label>Payment Method</label>";
	echo "<select>";
	if ($Employee['PaymentMethod']=="cash") {
		echo "<option value=\"cash\" selected>Cash</option>";
		echo "<option value=\"delver\">Delivered to Postal Address</option>";
		echo "<option value=\"trnsfr\">Transfer to Bank Account</option>";
	}
	else if ($Employee['PaymentMethod']=="delver") {
		echo "<option value=\"cash\">Cash</option>";
		echo "<option value=\"delver\" selected>Delivered to Postal Address</option>";
		echo "<option value=\"trnsfr\">Transfer to Bank Account</option>";
	}
	else if ($Employee['PaymentMethod']=="trnsfr") {
		echo "<option value=\"cash\">Cash</option>";
		echo "<option value=\"delver\">Delivered to Postal Address</option>";
		echo "<option value=\"trnsfr\" selected>Transfer to Bank Account</option>";
	}
	echo "</select>";
	echo "</div>";
	echo "</form>";
	echo "<button type=\"submit\" class=\"btn btn-primary\">Save changes</button>";
	echo "</section> </div>";
	echo "</div> </div> </div> </div> </div> </div>";
    echo "</div>";
	
	echo "<div class=\"panel-body\">";
	echo "<div class=\"col-lg-6\">";
	echo "<div class=\"modal fade\" id=\"newReg\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
	echo "<div class=\"modal-dialog\"> <div class=\"modal-content\"> <div class=\"modal-header\">";
	echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
	echo "<h4 class=\"modal-title\" id=\"H4\">Edit Profile</h4>";
	echo "</div>";
	echo "<div class=\"modal-body\"> <form role=\"form\">";
	echo "<div class=\"form-group\">";
	echo "<label>Password</label> <input class=\"form-control\" type=\"password\"value=\"".$Account['Password']."\"/>";
	echo "</div>";
	echo "<div class=\"form-group\">";
	echo "<label>Email</label> <input type=\"email\"class=\"form-control\" value=\"".$Employee['EmployeeEmail']."\"/>";
	echo "</div>";
	echo "<div class=\"form-group\">";
	echo "<label>Contact</label> <input class=\"form-control\" value=\"".$Employee['EmpContact']."\"/>";
	echo "</div>";
	echo "<div class=\"form-group\">";
	echo "<label>Address</label> <input class=\"form-control\" value=\"".$Employee['EmployeeAddress']."\"/>";
	echo "</div>";
	echo "<div class=\"form-group\">";
	echo "<label>Bank Account</label> <input class=\"form-control\" value=\"".$Employee['BankAccount']."\"/>";
	echo "</div>";
	echo "<div class=\"form-group\">";
	echo "<label>Payment Method</label> <input class=\"form-control\" value=\"".$Employee['PaymentMethod']."\"/>";
	echo "</div>";
	echo "</form> </div>";
	echo "<div class=\"modal-footer\">";
	echo "<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>";
	echo "<button type=\"button\" class=\"btn btn-primary\">Save changes</button>";
	echo "</div> </div> </div> </div> </div>";
	echo "</div>";
}

function print_pending($request) {
	echo "<div id=\"content\">";
	echo "<div class=\"inner\" >";
	echo "<div class=\"row\">";
	echo "<div class=\"col-lg-12\">";
	echo "<h2> Pending Requests </h2>";
	echo "</div>";
	echo "</div>";
	echo "<hr />";
	echo "<div class=\"panel-body\">";
    echo "<div class=\"panel-group\" id=\"accordion\" >";
   
	while ($pending=mysql_fetch_array($request)) {
		echo "<div class=\"panel panel-default\" >";
		echo "<div class=\"panel-heading\" >";
		echo "<h4 class=\"panel-title\">";
		echo "<a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseOne\">".$pending['Title']."</a>";
        echo "</h4>";
        echo "</div>";
        echo "<div id=\"collapseOne\" class=\"panel-collapse collapse in\">";
        echo "<div class=\"panel-body\">";
		echo $pending['Message'];
        echo "</div>";
        echo "<div class=\"panel-body\">";
        echo "<button class=\"btn btn-info\" data-toggle=\"modal\" data-target=\"#uiModal\"> Respond Request </button>";
        echo "</div></div></div></div></div></div></div>";
	}
}

function print_wfeedback($action) {
	echo "<div id=\"content\">";
	echo "<div class=\"inner\">";
	echo "<div class=\"row\"> <div class=\"col-lg-12\"> <h2> Send Feedback </h2> </div> </div>";
	echo "<hr />";
	echo "<div id=\"div-1\" class=\"body collapse in\"> <form action=\"".$action."\" method=\"post\">";
	echo "<label>Title of feedback: </label> <input class=\"form-control\" name=\"title\" /> <p> </p>";
	echo "<p>Write down your feedbacks you wish to tell your manager here.</p>";
	echo "<textarea id=\"wysihtml5\" class=\"form-control\" rows=\"10\" name=\"feedback\"></textarea>";
	echo "<div class=\"form-actions\"> <br />";
	echo "<input type=\"submit\" name=\"send\" value=\"Send Feedback\" class=\"btn btn-primary\" />";
	echo "</div> </form> </div> </div> </div> </div> </div> </div>";
}

function print_vfeedback($feedbacks) {
	echo "<div id=\"content\">";
	echo "<div class=\"inner\">";
	echo "<div class=\"row\"> <div class=\"col-lg-12\"> <h2> Manage Feedback </h2> </div> </div>";
	echo "<hr />";
	echo "<p>Here are feedbacks sent by your employees to you.</p>";
	echo "<div class=\"panel-body\">";
    echo "<div class=\"panel-group\" id=\"accordion\" >";
	while ($feedback=mysql_fetch_array($feedbacks)) {
		echo "<div class=\"panel panel-default\" >";
		echo "<div class=\"panel-heading\" >";
		echo "<h4 class=\"panel-title\">";
		echo "<a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseOne\">".$feedback['FeedbackTitle']."</a>";
        echo "</h4>";
        echo "</div>";
        echo "<div id=\"collapseOne\" class=\"panel-collapse collapse in\">";
        echo "<div class=\"panel-body\">";
		echo $feedback['EmployeeID']."<br />".$feedback['FeedbackMsg'];
        echo "</div>";
        echo "<div class=\"panel-body\">";
        echo "<button class=\"btn btn-info\" data-toggle=\"modal\" data-target=\"#uiModal\"> Respond Request </button>";
        echo "</div></div></div></div></div></div></div>";
	}
}

function print_employee() {
	
}
//End of printing contents

//Printing footer
function print_footer() {
	echo "<div id=\"footer\">";
	echo "<p>&copy; Enterprise Software Developer &nbsp;2015 &nbsp;</p>";
	echo "</div>";
	
	echo "<script src=\"assets/plugins/jquery-2.0.3.min.js\"></script>";
    echo "<script src=\"assets/plugins/bootstrap/js/bootstrap.min.js\"></script>";
    echo "<script src=\"assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js\"></script>";

	echo "<script src=\"assets/js/jquery-ui.min.js\"></script>";
	echo "<script src=\"assets/plugins/uniform/jquery.uniform.min.js\"></script>";
	echo "<script src=\"assets/plugins/inputlimiter/jquery.inputlimiter.1.3.1.min.js\"></script>";
	echo "<script src=\"assets/plugins/chosen/chosen.jquery.min.js\"></script>";
	echo "<script src=\"assets/plugins/colorpicker/js/bootstrap-colorpicker.js\"></script>";
	echo "<script src=\"assets/plugins/tagsinput/jquery.tagsinput.min.js\"></script>";
	echo "<script src=\"assets/plugins/validVal/js/jquery.validVal.min.js\"></script>";
	echo "<script src=\"assets/plugins/daterangepicker/daterangepicker.js\"></script>";
	echo "<script src=\"assets/plugins/daterangepicker/moment.min.js\"></script>";
	echo "<script src=\"assets/plugins/datepicker/js/bootstrap-datepicker.js\"></script>";
	echo "<script src=\"assets/plugins/timepicker/js/bootstrap-timepicker.min.js\"></script>";
	echo "<script src=\"assets/plugins/switch/static/js/bootstrap-switch.min.js\"></script>";
	echo "<script src=\"assets/plugins/jquery.dualListbox-1.3/jquery.dualListBox-1.3.min.js\"></script>";
	echo "<script src=\"assets/plugins/autosize/jquery.autosize.min.js\"></script>";
	echo "<script src=\"assets/plugins/jasny/js/bootstrap-inputmask.js\"></script>";
	echo "<script src=\"assets/js/formsInit.js\"></script>";
	echo "<script type=\"text/javascript\"> $(function () { formInit(); }); </script>";
	echo "<script src=\"assets/plugins/jquery-steps-master/lib/jquery.cookie-1.3.1.js\"></script>";
    echo "<script src=\"assets/plugins/jquery-steps-master/build/jquery.steps.js\"></script>";
    echo "<script src=\"assets/js/WizardInit.js\"></script>";
	echo "<script src=\"assets/plugins/jasny/js/bootstrap-fileupload.js\"></script>";
    echo "</body>";
	echo "</html>";
}

?>