<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
$linkid=db_connect();

$sql_details="select * from tbl_wedding_directory where directory_id='".$_REQUEST['id']."'";
$res_details=mysql_query($sql_details);


?>
<html>
	<head>
		<title>Matrmonial shaadi </title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="includes/style.css" rel="stylesheet" type="text/css"/>
	</head>  
	<body>			
		 <table cellpadding="0" cellspacing="0" border="0" width="99%" height="100%" align="center">		
			<tr bgcolor="#FFFFFF">
			<td valign="top" width="100%" height="100%" align="center">
				<form name="thisForm" method="post" >	
					<table cellpadding="5" cellspacing="0" bgcolor="#888349">										 	
						 <tr bgcolor="#FFFFFF">
							 <td valign="top" width="100%"align="center">					 						 						
							 	   <table width="480" cellpadding="4" cellspacing="0" bgcolor="#f0edd4" border="0" style="border-right:#888349 1px solid; " >
								    <tr  height="30">
										<td colspan="3" style="border-bottom:#888349 1px solid; border-top:#888349 1px solid; border-left:#888349 1px solid;><a class="dirpage">Shop Details</a></td></tr>		
								  		   <? if(mysql_num_rows($res_details)>0){ 
											        while($obj_details=mysql_fetch_object($res_details)){
											   ?>
											   <tr style="border-top:#888349 1px solid;">
											     <td style="border-bottom:#888349 1px solid; border-left:#888349 1px solid; background-color:#FFFFFF;"  width="142" class="">Shop Name</td>
												 <td style="border-bottom:#888349 1px solid; background-color:#FFFFFF;"> : </td>
												 <td style="border-bottom:#888349 1px solid; background-color:#FFFFFF;" width="306"><?=$obj_details->shop_name; ?></td>
											   </tr>
											   <? if($obj_details->description!="") { ?>
												<tr height="50" valign="top" style="border-top:#888349 1px solid;">
												    <td style="border-bottom:#888349 1px solid; border-left:#888349 1px solid; background-color:#FFFFFF;">Description</td>
												    <td style="border-bottom:#888349 1px solid; background-color:#FFFFFF;" height="30"> : </td>
													<td style="border-bottom:#888349 1px solid; background-color:#FFFFFF;"><?=nl2br($obj_details->description); ?></td>
												</tr>
												<? } ?>
											   <tr style="border-top:#888349 1px solid;">
											     <td style="border-bottom:#888349 1px solid; border-left:#888349 1px solid; background-color:#FFFFFF;" height="30">Shop Address</td>
 											     <td style="border-bottom:#888349 1px solid !important; background-color:#FFFFFF;" height="30"> : </td>
												 <td style="border-bottom:#888349 1px solid; background-color:#FFFFFF;" height="30"><?=$obj_details->shop_address; ?></td>
											   </tr>
											   <tr style="border-top:#888349 1px solid;">
											     <td style="border-bottom:#888349 1px solid; border-left:#888349 1px solid; background-color:#FFFFFF;">Contact Person</td>
 												 <td style="border-bottom:#888349 1px solid; background-color:#FFFFFF;" height="30"> : </td>
												 <td style="border-bottom:#888349 1px solid; border-top:#888349 1px solid; background-color:#FFFFFF;" height="30";><?=$obj_details->contact_person; ?></td>
											   </tr>
											   <tr style="border-top:#888349 1px solid;">
											     <td style="border-bottom:#888349 1px solid; border-left:#888349 1px solid; background-color:#FFFFFF;">Contact Number</td>
 												 <td style="border-bottom:#888349 1px solid; background-color:#FFFFFF;" height="30"> : </td>
												 <td style="border-bottom:#888349 1px solid; background-color:#FFFFFF;"><?=$obj_details->contact_phone; ?></td>
											   </tr>
											   <? if($obj_details->email_id!=""){ ?>
											   <tr>
											     <td style="border-bottom:#888349 1px solid; border-left:#888349 1px solid; background-color:#FFFFFF;">E-mail Address</td>
 												 <td style="border-bottom:#888349 1px solid; background-color:#FFFFFF;" height="30"> : </td>
												 <td style="border-bottom:#888349 1px solid; background-color:#FFFFFF;"><?=$obj_details->email_id; ?></td>
											   </tr>
											   <? } ?>
											   
											   <? if($obj_details->web_address!=""){ ?>
											   <tr>
											     <td style="border-bottom:#888349 1px solid; border-left:#888349 1px solid; background-color:#FFFFFF;">Web Site Address</td>
												 <td style="border-bottom:#888349 1px solid; background-color:#FFFFFF;" height="30"> : </td>
												 <td style="border-bottom:#888349 1px solid; background-color:#FFFFFF;"><?=$obj_details->web_address; ?></td>
											   </tr>
											   <? } ?>
											   
												<? 
												   }
												  }
												?>
										  </table>
									  </td>
									</tr>
							   </table>
				</form>
			</td>
			</tr>
		 <tr>
	 	<td><br>
	 	</td>
		</tr>
		</table>
 	</body>
</html>
