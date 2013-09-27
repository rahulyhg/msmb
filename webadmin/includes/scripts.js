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
	str+="	 <td><img src='" + linkPath + "images/ilogo.jpg' border='0' title='Matrmonial shaadi '></td>";
	str+="	 <td align='right'><img src='" + linkPath + "images/webcontrolpanel.gif' border='0'></td>";
	str+=" </tr>";
	str+=" </table>";
	document.write(str);
	}

function fnMenu()
	{
	var str="";
	str+="	<table border=0 cellpadding=0 cellspacing=1 width=100% height=25 bgcolor='#FFFFFF'>";
	str+=" <tr class='menubg' height='20'>";	
	str+="		<td align=center><A href='" + linkPath + "home.php' title='Main page' class='menu'> Home Page</A></td>";
	str+="		<td align=center><A href='" + linkPath + "view_packages.php' title='View Packages' class='menu'> Manage Packages</A></td>";
	str+="		<td align=center><A href='" + linkPath + "view_successful_stories.php' title='View Successful stories' class='menu'> Manage Successful Stories</A></td>";
	str+="		<td align=center><A href='" + linkPath + "view_franchisee.php' title='View Franchisee' class='menu'> Manage Franchisees</A></td>";
	str+="		<td align=center><A href='" + linkPath + "change_password.php' title='Change my Password' class='menu'>Change my Password</A></td>";	
	str+=" </tr>";
	
	str+=" <tr class='menubg' height='20'>";	
	str+="		<td align=center><A href='" + linkPath + "view_wedding_category.php' title='View Wedding Category' class='menu'> Manage Wedding Category</A></td>";
	str+="		<td align=center><A href='" + linkPath + "view_wedding_directory.php' title='View Wedding Directory' class='menu'> Manage Wedding Directory </A></td>";	
	str+="		<td align=center><A href='" + linkPath + "view_subscribers.php' title='View Subscribers' class='menu'> Manage Subscribers</A></td>";
	str+="		<td align=center><A href='" + linkPath + "view_newsletters.php' title='View Newsletters' class='menu'> Manage Newsletters</A></td>";
	str+="		<td align=center><A href='" + linkPath + "logout.php' title='Logout' class='menu'>Logout</A></td>";	
	str+=" </tr>";
	
	str+=" <tr class='menubg' height='20'>";	
	str+="		<td align=center><A href='" + linkPath + "view_sub_admin.php' title='Manage Sub-Admins' class='menu'> Manage Sub-admins</A></td>";
	str+="		<td align=center><A href='" + linkPath + "view_religions.php' title='Manage Sub-Admins' class='menu'> Manage Religions</A></td>";	
	str+="		<td align=center>&nbsp;</td>";	
	str+="		<td align=center>&nbsp;</td>";	
	str+="		<td align=center>&nbsp;</td>";	
	str+=" </tr>";
	
	str+="	</table>";
	document.write(str);
	}
 