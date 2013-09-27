<? 
$k = 1;
$flag=1; ?>
<table width="500" border="0" cellspacing="1" cellpadding="2" align="center">
<? while ($member = mysql_fetch_array($searchRes)) {
	if($flag==1){
		echo "<tr valign=\"top\">";
		$flag=1;
	}
	echo "<td align=\"left\" bgcolor=\"#FFFFFF\" valign=\"top\">";
	include("photoslider1.php");
?>
	<style>
		#imgNum<?=$member[id]?>	{ margin:0px; padding:0px 5px 0px 5px; text-align:center;}
	</style>
<table width="300" border="0" cellspacing="1" cellpadding="2" bgcolor="#ffca4d" align="center" height="141">
  <tr>
	<td width="35%" bgcolor="#FFFFFF" valign="top">
		<table width="22%" border="0" align="center" cellspacing="0" cellpadding="0">
		  <tr><td colspan="3" height="25" valign="middle" align="center"><a href="view_member_profile.php?userid=<?=$member[username]?>" class="idclr"><?=$member[username]?></a></td></tr>
		  <tr><td colspan="3" valign="top">										
				<?
						//$resPhoto = Execute("select * from tbl_photo where userid = '".$id."' and approve = '1'");
						if ($member[id] == $config[userinfo][id]) {
							$resPhoto = Execute("select * from tbl_photo where userid = '".$member[id]."'");
						} else {
							$resPhoto = Execute("select * from tbl_photo where userid = '".$member[id]."' and approve = '1' ");
						}	
						$i = 0;
						
						if (mysql_num_rows($resPhoto) > 0) {
							while ($memPhoto = mysql_fetch_array($resPhoto)) { 	?>																							 								
									
								<div id="divPrd<?=$member[id]?>" style="position:absolute;display:none;">
									 <table align="center" border="0" bordercolor="#990000" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" width="160"  height="160">
										 <tr>
										   <td align="center"><img id="img<?=$member[id]?>" src="usernormal/<?=$memPhoto[photo]?>"></td>
										 </tr>
									 </table>
			    				</div>
								 	
							<?	if ($member[photo_password] && $member[id] != $config[userinfo][id]) { ?>	
								<script>
									photos<?=$member[id]?>["<?=$i?>"] = "images/protectedphoto.gif"; 
								</script>																			
							<?  
									break;
								} else { ?>
										<script>																			
											photos<?=$member[id]?>["<?=$i?>"] = "userthumbnail/<?=$memPhoto[photo]?>";
										</script>
									<?																															
									$i++;
								}		
							} 
						} else {
							if ($member[id] == $config[userinfo][id]) { 
								$resPhoto1 = Execute("select * from tbl_photo where userid = '".$user[id]."' and approve = 0");
								if (mysql_num_rows($resPhoto1) > 0) { ?>																		
									<script>
										photos<?=$member[id]?>["<?=$i?>"] = "images/pendpicture.png";
									</script>
							 <? } else { ?>											
									<script>
										photos<?=$member[id]?>["<?=$i?>"] = "images/addphoto.gif";
									</script>																		
								<!--<a href="add_photo.php" class="pagenum">Add Photo</a>-->
							 <? } ?>	
						<?	} else { ?>
							<script>
								photos<?=$member[id]?>["<?=$i?>"] = "images/nopicture.png";
							</script>																
						<?	}
						} ?>										
				<script>
					if (linkornot<?=$member[id]?>==0)																		
						if (photos<?=$member[id]?>[0] == 'images/addphoto.gif') {	
							document.write('<a href="add_photo.php"><img src="'+photos<?=$member[id]?>[0]+'" id="photoslider<?=$member[id]?>"  name="photoslider<?=$member[id]?>" style="filter:revealTrans(duration=1,transition=2); border:#333333 1px solid;" border=0 width=75 height=75></a>')
							document.write('<a href="add_photo.php" class="pagenum">Add Photo</a>')
						} else {
							if (photos<?=$member[id]?>[0] != 'images/nopicture.png') {
								document.write("<a href=\"javascript:PhotoManager('<?=$member[id]?>')\">")
							}
							if (photos<?=$member[id]?>[0] == 'images/protectedphoto.gif') {	
								document.write('<img src="'+photos<?=$member[id]?>[0]+'" id="photoslider<?=$member[id]?>" name="photoslider<?=$member[id]?>" style="filter:revealTrans(duration=1,transition=2); border:#333333 1px solid;" border=0 width=75 height=75')
							} else if (photos<?=$member[id]?>[0] != 'images/nopicture.png') {
								document.write('<img src="'+photos<?=$member[id]?>[0]+'" id="photoslider<?=$member[id]?>" name="photoslider<?=$member[id]?>" style="filter:revealTrans(duration=1,transition=2); border:#333333 1px solid;" border=0 width=75 height=75 onMouseOut=javascript:hidefloatie("<?=$member[id]?>") onMouseOver=javaScript:showfloatie(event,"<?=$member[id]?>","",150,160)>')
							} else {
								document.write('<img src="'+photos<?=$member[id]?>[0]+'" id="photoslider<?=$member[id]?>" name="photoslider<?=$member[id]?>" style="filter:revealTrans(duration=1,transition=2); border:#333333 1px solid;" border=0 width=75 height=75>')
							}	
						}	
					if (linkornot<?=$member[id]?>==0)
						document.write('</a>')
				</script>
				</td>
			</tr>
		  <? if (mysql_num_rows($resPhoto) > 1) { ?>	
		  <tr>
			<td align="right" class="btxt" height="30"><a style="cursor:pointer" onClick="backward<?=$member[id]?>();return false"><img src="images/arrow_left.jpg" border="0"/></a></td>
		  <td><a href="#" onClick="backward<?=$member[id]?>();return false" class="moreid"><div id="imgNum<?=$member[id]?>">1</div></a></td>
		  <td align="left"><a style="cursor:pointer" onClick="forward<?=$member[id]?>();return false"><img src="images/arrow_right.jpg" border="0"/></a></td></tr>
		  <? } ?>
	  </table>
	  </td>
	<td width="65%" valign="middle" bgcolor="#FFFFFF" align="left">
		<table width="100%" border="0" cellspacing="2" cellpadding="0" class="btxt" style="line-height:25px">
		  <tr style="padding-left:7px">
		  	
			  <td width="62%" colspan="3"><?=$member[name]?></td>
		  </tr>
		  <tr style="padding-left:7px">
		  
		  <?
			$year = substr($member[date_of_birth],0,4);
			$month = substr($member[date_of_birth],5,2);
			$date = substr($member[date_of_birth],8,2);												
		  ?>
		  	 <td height="20" width="2%">Age </td>
		  	 <td width="2%">:</td>
		     <td width="60%"><?=DOB2Age($year,$date,$month)?> Yrs</td>
		  </tr>
		  <tr style="padding-left:7px">
		  
			  <td colspan="3">
				<?
					$mem_religion = GetSingleField("religion","tbl_religion_master","id",$member[religion]);
					echo $mem_religion;
					if ($member[caste]) {
						echo ", " . GetSingleField("caste","tbl_caste_master","id",$member[caste]);
					}				
					/*if ($member[gothram]) {
						echo "," . $member[gothram];
					}*/	
				?>
			  </td>
		  </tr>
		  <tr style="padding-left:7px">
		  
		  <td colspan="3" width="90%">
		  <?
			$mem_education = GetSingleField("education","tbl_education_master","id",$member[education]);
			echo $mem_education;	
		 ?>
		  <?
				$mem_occupation = GetSingleField("occupation","tbl_occupation_master","id",$member[occupation]);
				echo ", ".$mem_occupation.".";
			?>	
		   </td>
		  </td></tr>
		</table>
	</td>
  </tr>
</table>	
<? 	if($flag==1){
		echo "<br></td>";
		$flag=0;
	}else{
		echo "<br></td></tr>";
		$flag=1;
	}
} ?>
</table>
<script language="javascript" type="text/javascript">

function deleteBookmark(id) {
	if (confirm("Are you sure want to delete")) {
		location.href = "view_bookmark.php?action=delete&bookmarked_id="+id;
	}
}

function deletePartner(id) {
	if (confirm("Are you sure want to delete")) {
		location.href = "partner_match.php?action=delete&matchid="+id;
	}	
}


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

<SCRIPT type="text/javascript">

/***********************************************
* Link Floatie script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

var floattext=new Array()
floattext[0]='- <a href="http://www.javascriptkit.com/cutpastejava.shtml">Free JavaScripts</a><br>- <a href="http://www.javascriptkit.com/javaindex.shtml">JavaScript Tutorials</a><br>- <a href="http://www.javascriptkit.com/dhtmltutors/index.shtml">DHTML/ CSS Tutorials</a><br>- <a href="http://www.javascriptkit.com/jsref/">JavaScript Reference</a><br><div align="right"><a href="javascript:hidefloatie()">Hide Box</a></div>'
floattext[1]='Some other floatie text'

var floatiewidth="100px" //default width of floatie in px
var floatieheight="auto" //default height of floatie in px. Set to "" to let floatie content dictate height.
//var floatiebgcolor="#47A7E0" //default bgcolor of floatie
var floatiebgcolor="#FFFFFF" //default bgcolor of floatie
var fadespeed=10 //speed of fade (5 or above). Smaller=faster.

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