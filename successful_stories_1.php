<?php
ob_start();
session_start();
include("includes/lib.php");
include("includes/paging.php");

$linkid=db_connect();

$sql_year="select date_format(current_date(),'%Y') as currentyear";
$res_year=mysql_query($sql_year);
$obj_year=mysql_fetch_object($res_year);
$start_year=$obj_year->currentyear;
$end_year=2000;

if($_REQUEST['year']!=""){
$sql_success="select * from tbl_successful_stories where marriage_year='".$_REQUEST['year']."'";
} else {
$sql_success="select * from tbl_successful_stories where display_status='Y' and marriage_year='".$start_year."'";
}
if($_REQUEST['bride']!="")
$sql_success="select * from tbl_successful_stories where display_status='Y' and bride='".$_REQUEST["bride"]."'";
$res_success=mysql_query($sql_success);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" type="text/css" rel="stylesheet"/>
<link href="includes/payment.css" type="text/css" rel="stylesheet"/>
<script language="JavaScript" src="includes/validate.js"></script>
<script language="JavaScript" src="includes/functions.js"></script>	
<SCRIPT language=JavaScript src="includes/imageover.js"></SCRIPT>
<script type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>

<SCRIPT type="text/javascript">

/***********************************************
* Link Floatie script- � Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

var floattext=new Array()
floattext[0]='- <a href="http://www.javascriptkit.com/cutpastejava.shtml">Free JavaScripts</a><br>- <a href="http://www.javascriptkit.com/javaindex.shtml">JavaScript Tutorials</a><br>- <a href="http://www.javascriptkit.com/dhtmltutors/index.shtml">DHTML/ CSS Tutorials</a><br>- <a href="http://www.javascriptkit.com/jsref/">JavaScript Reference</a><br><div align="right"><a href="javascript:hidefloatie()">Hide Box</a></div>'
floattext[1]='Some other floatie text'

var floatiewidth="200px" //default width of floatie in px
var floatieheight="auto" //default height of floatie in px. Set to "" to let floatie content dictate height.
var floatiebgcolor="#47A7E0" //default bgcolor of floatie
var fadespeed=300 //speed of fade (5 or above). Smaller=faster.

var baseopacity=0
function slowhigh(which2){
imgobj=which2
browserdetect=which2.filters? "ie" : typeof which2.style.MozOpacity=="string"? "mozilla" : ""
instantset(baseopacity)
highlighting=setInterval("gradualfade(imgobj)",fadespeed)
}

function instantset(degree){
cleartimer()
if (browserdetect=="mozilla")
imgobj.style.MozOpacity=degree/100
//else if (browserdetect=="ie")
//imgobj.filters.alpha.opacity=degree
}

function cleartimer(){
if (window.highlighting) clearInterval(highlighting)
}

function gradualfade(cur2){
if (browserdetect=="mozilla" && cur2.style.MozOpacity<1)
cur2.style.MozOpacity=Math.min(parseFloat(cur2.style.MozOpacity)+0.1, 0.99)
//else if (browserdetect=="ie" && cur2.filters.alpha.opacity<100)
//cur2.filters.alpha.opacity+=10
else if (window.highlighting)
clearInterval(highlighting)
}

function ietruebody(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function paramexists(what){
return(typeof what!="undefined" && what!="")
}

function showfloatie(e,imgIndex, optbgColor, optWidth, optHeight){
var floatobj=document.getElementById("divPrd"+imgIndex)
floatobj.style.left="-900px"
floatobj.style.display="block"
floatobj.style.border="#333333 1px solid"
floatobj.style.backgroundColor=paramexists(optbgColor)? optbgColor : floatiebgcolor
floatobj.style.width=paramexists(optWidth)? optWidth+"px" : floatiewidth
floatobj.style.height=paramexists(optHeight)? optHeight+"px" : floatieheight!=""? floatieheight : ""
var floatWidth=floatobj.offsetWidth>0? floatobj.offsetWidth : floatobj.style.width
var floatHeight=floatobj.offsetHeight>0? floatobj.offsetHeight : floatobj.style.width
	var posx = 0;
	var posy = 0;
	if (!e) var e = window.event;
	if (e.pageX || e.pageY) 	{
		posx = e.pageX;
		posy = e.pageY;
	}
	else if (e.clientX || e.clientY) 	{
		posx = e.clientX + document.body.scrollLeft
			+ document.documentElement.scrollLeft;
		posy = e.clientY + document.body.scrollTop
			+ document.documentElement.scrollTop;
	}
floatobj.style.left=posx+10+"px"
floatobj.style.top=posy-25+"px"
slowhigh(floatobj)
}

function hidefloatie(imgIndex){
var floatobj=document.getElementById("divPrd"+imgIndex)
floatobj.style.display="none"
}

</SCRIPT>

<script language="javascript" type="text/javascript">
function fnDisplay(){
 document.thisForm.action="successful_stories.php?Mode=Submit";
 document.thisForm.submit();
}
function fnSubscribe()
{ 
	if(isNull(document.SubscribeForm.txtSubscriber,"Email Address")){return false;}	
	if(notEmail(document.SubscribeForm.txtSubscriber,"Email Address")){return false;}	
}

</script>
<style>
         .thdrcell {
            background:#F3F0E7;
            font-family:arial;
            font-size:12px;
            font-weight:bold;
            padding:5px;
            border-bottom:1px solid #C8BA92;
         }
         
         .tdatacell {
            font-family:arial;
            font-size:12px;
            padding:5px;
            background:#FFFFFF
         }
         
         .dvhdr1 {
            background:#F3F0E7;
            font-family:arial;
            font-size:12px;
            font-weight:bold;
            border:1px solid #C8BA92;
            padding:5px;
            width:150px;
         }
         
         .dvbdy1 {
            background:#FFFFFF;
            font-family:arial;
            font-size:12px;
            border-left:1px solid #C8BA92;
            border-right:1px solid #C8BA92;
            border-bottom:1px solid #C8BA92;
            padding:5px;
            width:150px;
         }
         
         p {
         margin-top:20px;
         }
         
         h1 {
         font-size:13px;
         }
         
         .dogvdvhdr {
            width:300;
            background:#C4D5E3;
            border:1px solid #C4D5E3;
            font-weight:bold;
            padding:10px;
         }
         
         .dogvdvbdy {
            width:300;
            background:#FFFFFF;
            border-left:1px solid #C4D5E3;
            border-right:1px solid #C4D5E3;
            border-bottom:1px solid #C4D5E3;
            padding:10px;
         }
         
         .pgdiv {
         width:320;
         height:250;
         background:#E9EFF4;
         border:1px solid #C4D5E3;
         padding:10px;
         margin-bottom:20;
         font-family:arial;
         font-size:12px;
         }
      </style>

</head>
<body class="homeinbody" onLoad="MM_preloadImages('images/menu_assam_ovr.jpg','images/menu_benga_ovr.jpg','images/menu_guja_ovr.jpg','images/menu_hind_ovr.jpg','images/menu_kanad_ovr.jpg','images/menu_malay_ovr.jpg','images/menu_marat_ovr.jpg','images/menu_marw_ovr.jpg','images/menu_punj_ovr.jpg','images/menu_tamil_ovr.jpg','images/menu_telug_ovr.jpg','images/menu_urdu_ovr.jpg')">
<div class="menuleftimg">
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="105"><a href="index.php"><img src="images/logo.jpg" vspace="10" border="0"/></a></td>
    <td align="right"><? fnBannerImage('  ','top')  ?></td>
  </tr>
  <tr>
    <td colspan="2" class="homemenu"><? include("includes/menu.php") ?></td>
  </tr>  
  <tr>
    <td colspan="2" valign="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td>
			<? include("includes/side_menu.php"); ?>
		</td>
		<td valign="top">
			<div style="padding:10px 20px 0px 0px; width:573px; float:right;" >
				<table width="561" border="0" cellspacing="0" cellpadding="0" >
				  <tr>
					<td valign="top">
						<div class="titlebg"><h1 class="title">Successful Stories</h1>
						</div>
					</td>
				  </tr>
				  <tr>
				 	<td>&nbsp;</td>
				 </tr>
				  <tr>
					<td class="weddir">Success Storywas working in Chandigarh. Initially we exchanged mails. We started chatting over messenger. Soon we found ourselves comfortable enough to talk over phone. After taking </td>
			 	 </tr>
				 <tr>
				 	<td>&nbsp;</td>
				 </tr>
				 <tr><td align="right"><a href="register_successful.php"  class="more" >Add Successful Stories</a><br><br></td></tr>
			  <tr>
			  	<td><img src="images/wedcur_top.jpg"  border="0"></td>
			  </tr>
			  <form name="thisForm" method="get" >
			  <tr>
			  	<td  bgcolor="#ef8d31">
					<table cellpadding="0" align="center" cellspacing="0" width="100%" border="0">
						<tr>
							<td align="center" height="19"><font color="#fdda89">Success story :</font></td>
							<? for($i=$start_year;$i>=$start_year-10;$i--) { ?>
						 	<td><a href="successful_stories.php?year=<?=$i?>" class="sucyear" id="OnPage"><?=$i?></a></td>
							<? } ?>
						</tr>
					</table>	
				</td>
			  </tr>
			  <tr>
			  	<td><img src="images/wedcur_bottom.jpg"  border="0"></td>
			  </tr>
			  <tr><td height="19">
			  			<? if ($_SESSION['_msg']) {?>
							<table width="90%"><tr><td colspan="3" align="center"><div style="float:center; padding-top:23px;"><? if($_SESSION['_msg']!=""){?> <font class=""><?=$_SESSION['_msg']; $_SESSION['_msg']="";?></font>&nbsp;&nbsp;<? }?></div></td></tr></table>
						<? } ?>	
			 </td></tr>
			 <tr>
			  	<td>
			 			<?
						$res=mysql_query($sql_success);	
						echo mysql_error();
						$no=mysql_num_rows($res);
							//pager starts Here
						if($_REQUEST['page']=="")
							$page =1;
						else
							$page=$_REQUEST['page'];
							$total	=	$no;
							$limit	=	3;
							$pager	=	Pager::getPagerData($total, $limit, $page);
							$offset	=	$pager->offset;
							$limit	=	$pager->limit;
							$page	= 	$pager->page;
						//pager ends Here
						$res_success=mysql_query($sql_success." limit  $offset, $limit"); 
								 if($no>0){
									$rCnt=1;	
								//if(mysql_num_rows($res_success)>0){
								if ($page!=1){
									$rCnt = ($limit*($page-1)+1);
								} else {
									$rCnt=1;
								}
						        ?>
                                <?
								$iCount = 1;
								?>
                                <? while($obj_success=mysql_fetch_object($res_success)){
										$sql_bride="select * from tbl_register where id='".$obj_success->bride."'";
										$res_bride=mysql_query($sql_bride);
										if(mysql_num_rows($res_bride)>0){
										$obj_bride=mysql_fetch_object($res_bride);
										}
										$sql_groom="select * from tbl_register where id='".$obj_success->groom."'";
										$res_groom=mysql_query($sql_groom);
										if(mysql_num_rows($res_groom)>0){
										$obj_groom=mysql_fetch_object($res_groom);
									    }
                               ?>
						
						
			  		<a name="<?=$obj_success->auto_id; ?>"></a>	   
					<table cellpadding="0" cellspacing="0" width="561" border="0" style="border:1px solid #888349;">
						<tr> 
							<td style="padding:10px; border-right:1px solid #b2aaaa;" width="125">
									<div class="photo1" align="center">
									  <div id="divPrd<?=$iCount ?>" style="position:absolute;display:none;">
									 <table align="center" border="0" bordercolor="#990000" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" width="200"  height="200">
									 <tr>
									   <td align="center"><img id="img1" width="180" eight="180" src="successful_stories_images/<?=$obj_success->image?>"></td>
									 </tr>
									 </table>
									 </div>										   
									 <? if(file_exists("successful_stories_images/thumb_".$obj_success->image)){
									 	$image_dias=getimagesize("successful_stories_images/thumb_".$obj_success->image);
										$image_width= $image_dias[0];
										$image_height= $image_dias[1];
										echo $image_width."-".$image_height;
									 
									 ?>
									 	 <img src="successful_stories_images/thumb_<?=$obj_success->image?>"  onmouseout=hidetrail();  style="cursor:hand" onmouseover="showtraildiscount('<?php echo "successful_stories_images/thumb_".$obj_success->image ;?> ','<?=$obj_success->title?>','<? echo $image_width;?>','<? echo $image_height;?>','','','5','1','1',0,'','');" height="110" >
									  <? }?>
									  
									  
<!--									   onMouseOut="hidefloatie('<?=$iCount ?>')" onMouseOver="javaScript:showfloatie(event,'<?=$iCount?>');" style="cursor:hand" width="120" height="88">
-->								</div>		
								
							
							</td>
							<td style="padding:8px;" valign="top" class="weddir" align="left" width="80%">
							<? $fd=fopen("successful_stories/".$obj_success->file_name,"r");
							   $content=fread($fd,filesize("successful_stories/".$obj_success->file_name));
							   fclose($fd);
							   echo $content;
						  ?>&nbsp;&nbsp;<!--<br><a href="#" class="readstr">Read Full Story  >>></a>--></td>
						</tr>
						<tr>
							<td height="38" colspan="2" bgcolor="#f0edd4" class="weddir">
								<table cellpadding="0" cellspacing="0" border="0" width="100%">
									<tr>
										<td align="center" width="22%"><b>Matrimony ID</b><br><font class="sums"> <?=$obj_bride->username." & ".$obj_groom->username; ?></font></td>
										<td><img src="images/succs_grd.jpg"  border="0"></td>
										<td align="center" width="22%"><b>Bride</b><br><font class="sums"><?=$obj_bride->name; ?></font></td>
										<td><img src="images/succs_grd.jpg"  border="0"></td>
										<td align="center" width="22%"><b>Groom</b><br><font class="sums"> <?=$obj_groom->name; ?></font></td>
										<td><img src="images/succs_grd.jpg"  border="0"></td>
										<td align="center" width="22%"><b>Marriage Date</b><br><font class="sums"><?=$obj_success->marriage_date; ?></font></td>
									</tr>
								</table>
							</td>
						</tr>
					</table> <br>
					<?    $iCount++;
					    $count1=$iCount-1;
						$rCnt++;
					
					  }  }else { ?>
						<table align="center"><tr><td class="story" align="center" >Successful stories not available for this year</td></tr></table>
						<? } ?>
				</td>
			<tr><td height="27" bgcolor="#e48931" class="weddir" style="padding-left:5px;"><font color="#FFCC00"><? getpageNumbers($pager->numPages,$page,"successful_stories.php","year",$_REQUEST['year'],"bride",$_REQUEST["bride"]);?> </td></tr>
			</tr>
			<tr><td>&nbsp;</td></tr>
			</table>
		   </div>
       </td>
	  </tr>
	</table>
	</td> 
  </tr>
  <tr>
  <td colspan="2">
  	<? 
		  		include("includes/fotter.php") ?>
  </td>
  </tr>
</table>
<div>
</body>
</html>
