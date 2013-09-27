<script language="JavaScript">
// JavaScript Document : Menu
function poptastic(url){
	var newwindow;
	newwindow=window.open(url,'name','height=500,width=280,left=20,top=20,toolbar=no,menubar=no,directories=no,location=no,scrollbars=yes,status=no,resizable=yes,fullscreen=no');
	if (window.focus) {newwindow.focus()}
	}

function fnHeader()
	{
	var str="";
	str+=" <table cellpadding='0' cellspacing='0' border='0' width='98%' height='65' align='center'>";
	str+=" <tr>";
	str+="	 <td><img src='" + linkPath + "images/ilogo.gif' border='0' title='Matrmonial shaadi '></td>";
	str+="	 <td align='right'><img src='" + linkPath + "images/webcontrolpanel.gif' border='0'></td>";
	str+=" </tr>";
	str+=" </table>";
	document.write(str);
	}
<? //if($_SESSION['superAdmin']=="Yes"){?>
			function fnMenu()
				{
				var str="";
				str+="	<table border=0 cellpadding=1 cellspacing=1 width=100% height=25 bgcolor='#FFFFFF'>";
				str+=" <tr class='menubg' height='25'>";	
				str+="		<td align=center><A href='" + linkPath + "home.php' title='Main page' class='menu'> Home Page</A></td>";
				str+="		<td align=center><A href='" + linkPath + "view_members.php?membership_type=1' title='Main page' class='menu'>Free Members</A></td>";
				str+="		<td align=center><A href='" + linkPath + "view_members.php?membership_type=2' title='Main page' class='menu'>Paid Members</A></td>";				
				str+="		<td align=center><A href='" + linkPath + "view_packages.php' title='View Packages' class='menu'>Packages</A></td>";
				str+="		<td align=center><A href='" + linkPath + "view_successful_stories.php' title='View Successful stories' class='menu'>Successful Stories</A></td>";									
				str+=" </tr>";
				
				str+=" <tr class='menubg' height='20'>";	
				str+="		<td align=center><A href='" + linkPath + "view_franchisee.php' title='View Franchise' class='menu'>Franchises</A></td>";	
				str+="		<td align=center><A href='" + linkPath + "change_password.php' title='Change my Password' class='menu'>Change my Password</A></td>";
				str+="		<td align=center><A href='" + linkPath + "view_wedding_category.php' title='View Wedding Category' class='menu'>Wedding Category</A></td>";
				str+="		<td align=center><A href='" + linkPath + "view_wedding_directory.php' title='View Wedding Directory' class='menu'>Wedding Directory </A></td>";	
				str+="		<td align=center><A href='" + linkPath + "view_subscribers.php' title='View Subscribers' class='menu'> Subscribers</A></td>";																						

				str+=" </tr>";
				
				str+=" <tr class='menubg' height='20'>";					
				str+="		<td align=center><A href='" + linkPath + "view_upgrade_request.php' title='View Upgrade' class='menu'> View Upgrade Request members</A></td>";
				str+="		<td align=center><A href='" + linkPath + "view_newsletters.php' title='View Newsletters' class='menu'> Newsletters</A></td>";
				str+="		<td align=center><A href='" + linkPath + "view_sub_admin.php' title='Manage Sub-Admins' class='menu'> Sub-admins</A></td>";
				str+="		<td align=center><A href='" + linkPath + "view_religions.php' title='Manage Religions' class='menu'> Religions</A></td>";	
				str+="		<td align=center><A href='" + linkPath + "view_caste.php' title='Manage Caste' class='menu'> Caste</A></td>";				
																					
				
				str+=" </tr>";
				
				str+=" <tr class='menubg' height='20'>";
				str+="		<td align=center><A href='" + linkPath + "view_country.php' title='Manage Caste' class='menu'> Country</A></td>";
				str+="		<td align=center><A href='" + linkPath + "view_state.php' title='Manage Caste' class='menu'> State</A></td>";
				str+=" 		<td align=center><A href='" + linkPath + "view_city.php' title='Manage City' class='menu'> City</A></td>";
				str+="		<td align=center><A href='" + linkPath + "view_advertisements.php' title='Manage Advertisements' class='menu'> Advertisements</A></td>";
				str+="		<td align=center><A href='" + linkPath + "update_express_interest.php' title='Manage Express Interest Message' class='menu'> Express Interest Message</A></td>";								
			    <!--str+="		<td align=center><A href='" + linkPath + "#' title='Manage Advertisements' class='menu'>&nbsp;</A></td>";-->	
				
				str+=" </tr>";
				
				str+=" <tr class='menubg' height='20'>";
				str+="		<td align=center><A href='" + linkPath + "member_sales_report.php' title='Manage Caste' class='menu'>Sales Report of Member</A></td>";
				str+="		<td align=center><A href='" + linkPath + "franchises_sales_report.php' title='Sales report of Franchises' class='menu'>Sales Report of Franchises</A></td>";
				//str+="		<td align=center><A href='" + linkPath + "rem_con_newsletter.php' title='Confirmation and Reminder' class='menu'>Confirmation and Reminder</A></td>";
				str+="		<td align=center><A href='" + linkPath + "report_rem_con.php' title='Report Confirmation and Reminder' class='menu'>Report Confirmation and Reminder</A></td>";								
				
str+="		<td align=center><A href='" + linkPath + "#' title='Manage Advertisements' class='menu'>Manage Advertisements</A></td>";
				str+=" <td align=center><A href='" + linkPath + "logout.php' title='Logout' class='menu'>Logout</A></td>";
				str+=" </tr>";
				str+="	</table>";
				document.write(str);
				}
 <? //}else{?>
 			
		/*	function fnMenu()
				{
				var str="";
				str+="	<table border=0 cellpadding=0 cellspacing=1 width=100% height=25 bgcolor='#FFFFFF'>";
				str+=" <tr class='menubg' height='20'>";	
				str+="		<td align=center><A href='" + linkPath + "home.php' title='Main page' class='menu'> Home Page</A></td>";
				str+="		<td align=center><A href='" + linkPath + "view_members.php' title='Main page' class='menu'>Manage Members Registration</A></td>";				
				str+="		<td align=center><A href='" + linkPath + "view_packages.php' title='View Packages' class='menu'> Manage Packages</A></td>";
				str+="		<td align=center><A href='" + linkPath + "view_successful_stories.php' title='View Successful stories' class='menu'> Manage Successful Stories</A></td>";
				str+="		<td align=center><A href='" + linkPath + "view_franchisee.php' title='View Franchise' class='menu'> Manage Franchises</A></td>";					
				str+=" </tr>";
				
				str+=" <tr class='menubg' height='20'>";	
				str+="		<td align=center><A href='" + linkPath + "change_password.php' title='Change my Password' class='menu'>Change my Password</A></td>";
				str+="		<td align=center><A href='" + linkPath + "view_wedding_category.php' title='View Wedding Category' class='menu'> Manage Wedding Category</A></td>";
				str+="		<td align=center><A href='" + linkPath + "view_wedding_directory.php' title='View Wedding Directory' class='menu'> Manage Wedding Directory </A></td>";	
				str+="		<td align=center><A href='" + linkPath + "view_subscribers.php' title='View Subscribers' class='menu'> Manage Subscribers</A></td>";
				str+="		<td align=center>&nbsp;</td>";
				str+=" </tr>";
				
				str+=" <tr class='menubg' height='20'>";					
				str+="		<td align=center><A href='" + linkPath + "view_newsletters.php' title='View Newsletters' class='menu'> Manage Newsletters</A></td>";
				str+="		<td align=center><A href='" + linkPath + "view_religions.php' title='Manage Religions' class='menu'> Manage Religions</A></td>";	
				str+="		<td align=center><A href='" + linkPath + "view_caste.php' title='Manage Caste' class='menu'> Manage Caste</A></td>";	
				str+="		<td align=center>&nbsp;</td>";	
				str+="		<td align=center><A href='" + linkPath + "logout.php' title='Logout' class='menu'>Logout</A></td>";
				str+=" </tr>";
				
				str+="	</table>";
				document.write(str);
				}
				*/
 
 <? //}?>
 
</script>