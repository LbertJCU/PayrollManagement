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
	?>
        <link href="assets/plugins/jquery-steps-master/demo/css/jquery.steps.css" rel="stylesheet" />
        <link href="assets/css/jquery-ui.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/plugins/uniform/themes/default/css/uniform.default.css" />
        <link rel="stylesheet" href="assets/plugins/inputlimiter/jquery.inputlimiter.1.0.css" />
        <link rel="stylesheet" href="assets/plugins/chosen/chosen.min.css" />
        <link rel="stylesheet" href="assets/plugins/colorpicker/css/colorpicker.css" />
        <link rel="stylesheet" href="assets/plugins/tagsinput/jquery.tagsinput.css" />
        <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker-bs3.css" />
        <link rel="stylesheet" href="assets/plugins/datepicker/css/datepicker.css" />
        <link rel="stylesheet" href="assets/plugins/timepicker/css/bootstrap-timepicker.min.css" />
        <link rel="stylesheet" href="assets/plugins/switch/static/stylesheets/bootstrap-switch.css" />
        <link rel="stylesheet" href="assets/css/fileinput.css" />
	<?php
	echo "<link rel=\"stylesheet\" href=\"assets/css/bootstrap-fileupload.min.css\" />";
	
	echo "<link href=\"assets/plugins/dataTables/dataTables.bootstrap.css\" rel=\"stylesheet\" />";
	
	echo "<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->";
    echo "<!--[if lt IE 9]>";
    echo "<script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>";
    echo "<script src=\"https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js\"></script>";
    echo "<![endif]-->";
}
//End of document initialization

//Printing header
function print_top($level, $fbdata, $rqdata) {
	echo "</head>";
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
		echo "<li> <a href=\"manage.php\"><i class=\"icon-lock\"></i> Administration</a> </li>";
		echo "<li> <a href=\"#\"><i class=\"icon-usd\"></i> Proceed Payment</a> </li>";
		echo "</ul>";
	echo "</li>";
	}
	
	if ($level=="Manager"||$level=="Admin") {
     echo "<li class=\"dropdown\">";
     echo "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">";
	 if (((count($fbdata)+count($rqdata))-1)>0) echo "<span class=\"label label-success\">".(count($fbdata)+count($rqdata)-1)."</span> <i class=\"icon-envelope-alt\"></i>&nbsp; <i class=\"icon-chevron-down\"></i>";
	 else echo "<span class=\"label label-success\"></span> <i class=\"icon-envelope-alt\"></i>&nbsp; <i class=\"icon-chevron-down\"></i>";
     echo "</a>";
	 echo "<ul class=\"dropdown-menu dropdown-messages\">";
	 $i=0; $j=0;
	 while ($fdbdtl=mysql_fetch_array($fbdata) AND $i<2) {
		 echo "<li>";
		 echo "<a href=\"#\">";
		 echo "<div>";
		 echo "<strong>".$fdbdtl['EMP_NAME']."</strong>";
		 echo "</div>";
         echo "<div>".$fdbdtl['TITLE']."<br /> <span class=\"label label-primary\">Feedback</span> </div>";
         echo "</a>";
         echo "</li>";
         echo "<li class=\"divider\"></li>";
		 $i=$i+1;
	 }
	 while ($rqsdtl=mysql_fetch_array($rqdata)AND $j<2) {
		 echo "<li>";
		 echo "<a href=\"#\">";
		 echo "<div>";
		 echo "<strong>".$rqsdtl['EmployeeName']."</strong>";
         echo "<span class=\"pull-right text-muted\">";
         echo "<em>".$rqsdtl['date']."</em>";
         echo "</span>";
		 echo "</div>";
         echo "<div>".$msgdtl['Request']."<br /> <span class=\"label label-primary\">Request</span> </div>";
         echo "</a>";
         echo "</li>";
         echo "<li class=\"divider\"></li>";
		 $j=$j+1;
	 }
	echo "<li>";
	echo "<a class=\"text-center\" href=\"response.php\">";
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
		echo "<li><a href=\"#newReg\" data-toggle=\"modal\"  data-target=\"#newReg\"><i class=\"icon-gear\"></i> Edit </a> </li>";
		echo "<li class=\"divider\"></li>";
        echo "<li><a href=\"logout.php\"><i class=\"icon-signout\"></i> Logout </a></li>";
        echo "</ul>";
		echo "</li>";

        echo "</ul>";

        echo "</nav>";

        echo "</div>";
}

function print_modal($Employee) {
	echo "<div class=\"panel-body\">";
	echo "<div class=\"col-lg-6\">";
	echo "<div class=\"modal fade\" id=\"newReg\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
	echo "<div class=\"modal-dialog\"> <div class=\"modal-content\"> <div class=\"modal-header\">";
	echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
	echo "<h4 class=\"modal-title\" id=\"H4\">Edit Profile</h4>";
	
	echo "</div>";
	echo "<div class=\"modal-body\"> <form action=\"editemployee.php\" method=\"post\" role=\"form\">";
	
	echo "<div class=\"form-group\">";
	echo "<label>New Password</label> <input class=\"form-control\" type=\"password\" name=\"npswd\"/>";
	echo "</div>";
	
	echo "<div class=\"form-group\">";
	echo "<label>Confirm Password</label> <input class=\"form-control\" type=\"password\" name=\"cnpsw\"/>";
	echo "</div>";
	
	echo "<div class=\"form-group\">";
	echo "<label>Email</label> <input type=\"email\" name=\"e-mail\" class=\"form-control\" />";
	echo "</div>";
	
	echo "<div class=\"form-group\">";
	echo "<label>Contact</label> <input class=\"form-control\" name=\"contact\"/>";
	echo "</div>";
	
	echo "<div class=\"form-group\">";
	echo "<label>Address</label> <input class=\"form-control\" name=\"address\" />";
	echo "</div>";
		
	echo "<div class=\"form-group\">";
    echo "</div>";
	echo "<div class=\"form-group\">";
	echo "<label>Payment Method</label>";
		echo "<select name=\"method\" class=\"form-control\">";
		echo "<option selected value=\"\"> </option>";
		echo "<option value=\"cash\">Cash</option>";
		echo "<option value=\"delver\">Delivered to Postal Address</option>";
		echo "<option value=\"trnsfr\">Transfer to Bank Account</option>";
	echo "</select>";
	echo "</div>";
	if ($Employee['PaymentMethod']=="trnsfr") echo "<label> Bank Account </label> <input class=\"form-control\" name=\"bankacc\" value=\"".$Employee['BankAccount']."\"/>";
	else echo "<label> Bank Account </label> <input class=\"form-control\" name=\"bankacc\" />";
	echo "<div class=\"modal-footer\">";
	echo "<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>";
	echo "<button type=\"submit\" name=\"change\" class=\"btn btn-primary\">Save changes</button>";
	echo "</form> </div>";
	echo "</div> </div> </div> </div> </div>";
	echo "</div>";
}
//End of printing header

//Printing navigational menus
function print_menu($title,$level,$EMP_ID,$firstName) {
	echo "<div id=\"left\">";
	echo "<div class=\"media user-media well-small\">";
	echo "<a class=\"user-link\" href=\"#\">";
	echo "<img class=\"media-object img-thumbnail user-img\" alt=\"User Picture\" src=\"assets/img/".$EMP_ID.".png\" width=\"85\" height=\"\" />";
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
			echo "<ul id=\"blank-nav\">";
            echo "<li class=\"panel active\"><a href=\"upload.php\"><i class=\"icon-upload\"></i> Post File  </a></li>";
            echo "<li><a href=\"writeFeedback.php\"><i class=\"icon-edit\"></i> Feedback  </a></li>";
			echo "</ul> </li>";
		}
		else if ($title=="Express Feedback") {
			echo "<li class=\"panel active\" class=\"panel\">";
			echo "<a href=\"#\" data-parent=\"#menu\" data-toggle=\"collapse\" class=\"accordion-toggle\" data-target=\"#blank-nav\">";
			echo "<i class=\"icon-pencil\"></i> Requests";
			echo "<span class=\"pull-right\"> <i class=\"icon-angle-left\"></i> </span>";
			echo "&nbsp; <span class=\"label label-success\"></span>&nbsp; </a>";
			echo "<ul id=\"blank-nav\">";
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
			echo "<ul class=\"collapse\" id=\"blank-nav\">";
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
            echo "<li class=\"panel active\"><a href=\"upload.php\"><i class=\"icon-upload\"></i> Post File  </a></li>";
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
			echo "<ul class=\"collapse\" id=\"blank-nav\">";
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
		if ($title=="View Colleague Profile") echo "<li class=\"panel active\"> <a href=\"colleague.php\"> <i class=\"icon-sitemap\"></i> Colleagues </a> </li>";
		else echo "<li class=\"panel\"> <a href=\"colleague.php\"> <i class=\"icon-sitemap\"></i> Colleagues </a> </li>";
		if ($title=="Team Management") echo "<li class=\"panel active\"> <a href=\"team.php\"> <i class=\"icon-group\"></i> Manage Team </a> </li>";
		else echo "<li class=\"panel\"> <a href=\"team.php\"> <i class=\"icon-group\"></i> Manage Team </a> </li>";
		if ($title=="Respond to Request") echo "<li class=\"panel active\"> <a href=\"response.php\"> <i class=\"icon-question-sign\"></i> Pending Requests </a> </li>";
		else echo "<li class=\"panel\"> <a href=\"response.php\"> <i class=\"icon-question-sign\"></i> Pending Requests </a> </li>";
		if ($title=="View Employee's Feedback") echo "<li class=\"panel active\"> <a href=\"viewFeedBack.php\" > <i class=\"icon-comments-alt\"></i> View Feedback </a> </li>";
		else echo "<li class=\"panel\"> <a href=\"viewFeedBack.php\" > <i class=\"icon-comments-alt\"></i> View Feedback </a> </li>";
		if ($title=="Manage Employee") echo "<li class=\"panel active\"> <a href=\"manage.php\"> <i class=\"icon-group\"></i> Manage Employee </a> </li>";
		else {
			echo "<li class=\"panel\"> <a href=\"manage.php\">";
			echo "<i class=\"icon-group\"></i> Manage Employee </a></li>";
		}
		if ($title=="View Payment History") echo "<li class=\"panel active\"> <a href=\"history.php\"> <i class=\"icon-list\"></i> Payment History </a> </li>";
		else echo "<li class=\"panel\"> <a href=\"history.php\"> <i class=\"icon-list\"></i> Payment History </a> </li>";
	}
	echo "</ul>";
	echo "</div>";
}
//End of printing menu

//Printing footer
function print_footer() {
	echo "<div id=\"footer\">";
	echo "<p>&copy; Enterprise Software Developer &nbsp;2015 &nbsp;</p>";
	echo "</div>";
	
	echo "<script src=\"assets/plugins/jquery-2.0.3.min.js\"></script>";
    echo "<script src=\"assets/plugins/bootstrap/js/bootstrap.min.js\"></script>";
    echo "<script src=\"assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js\"></script>";

	echo "<script src=\"assets/plugins/jquery-steps-master/lib/jquery.cookie-1.3.1.js\"></script>";
    echo "<script src=\"assets/plugins/jquery-steps-master/build/jquery.steps.js\"></script>";
    echo "<script src=\"assets/js/WizardInit.js\"></script>";
}

function print_end() {
    echo "</body>";
	echo "</html>";
}

?>