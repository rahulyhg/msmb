<? 
$k = 1;	 ?>
<? while ($member = mysql_fetch_array($searchRes)) { 
		
		include("photoslider1.php");		
	?>
	<style>
		#imgNum<?=$member[id]?>	{ margin:0px; padding:0px 5px 0px 5px; text-align:center;}
	</style>
<table width="560" <? if ($member[membership_type] > 1) { ?> bgcolor="#FF3366" <? } else { ?> bgcolor="#c0ba84" <? } ?> border="0" cellspacing="1" cellpadding="2"  align="center">
  <tr>
	<td width="22%" bgcolor="#FFFFFF">
		<table width="100%" border="0" align="center" cellspacing="0" cellpadding="0">
		  <tr><td colspan="3" height="30" align="center" valign="middle" tyle="padding-left:20px"><a href="view_member_profile.php?userid=<?=$member[username]?>" class="idclr"><?=$member[username]?></a></td></tr>
		  <tr><td colspan="3" align="center">
		  													
				<?
						//$resPhoto = Execute("select * from tbl_photo where userid = '".$id."' and approve = '1'");
						if ($member[id] == $config[userinfo][id]) {
							$resPhoto = Execute("select * from tbl_photo where userid = '".$member[id]."'");
						} else {
							$resPhoto = Execute("select * from tbl_photo where userid = '".$member[id]."' and approve = '1' ");
						}	
						$i = 0;
						
						if (mysql_num_rows($resPhoto) > 0) {
							while ($memPhoto = mysql_fetch_array($resPhoto)) { ?>
								<div id="divPrd<?=$member[id]?>" style="position:absolute;display:none; border:1px solid #333333;">
									 <table align="center" border="0" bordercolor="#990000" width="100%" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
								document.write('<img src="'+photos<?=$member[id]?>[0]+'" id="photoslider<?=$member[id]?>" name="photoslider<?=$member[id]?>" style="filter:revealTrans(duration=1,transition=2); border:#333333 1px solid;" border=0 width=75 height=75>')
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
		 <!-- <tr>
			<td colspan="3" align="center" class="orgin">Last Login : <br /><?=strftime("%d %b %Y",strtotime($member[lastLogin]));?></td>			
		  </tr>-->
		  
	  </table>
	</td>
	<td width="78%" valign="top" bgcolor="#FFFFFF">
		<table width="100%" border="0" cellspacing="5" cellpadding="0" class="btxt">			
		  <tr>
		  <td height="20" width="16%">Name </td>
		  <td width="2%">:</td>
		  <td width="42%"><?=$member[name]?></td>		 
		  <td width="20%" height="20" class="orgin">Last Login</td>
		  <td width="2%" class="orgin">:</td>
		  <td width="18%" class="orgin"><? echo strftime("%d %b %Y",strtotime($member[lastLogin]));?></td></tr>
		  <tr>
		  <?
			$year = substr($member[date_of_birth],0,4);
			$month = substr($member[date_of_birth],5,2);
			$date = substr($member[date_of_birth],8,2);												
		  ?>
		  	 <td height="20" width="16%">Age </td>
		  	 <td width="2%">:</td>
		     <td width="42%"><?=DOB2Age($year,$date,$month)?> Yrs</td>
		  </tr>
		  <? if ($member[height]) { ?>
		  <tr><td height="20">Height</td><td>:</td><td colspan="6"><?=$member[height]?> ft</td></tr>
		  <? } ?>
		  <tr><td height="20">Religion</td><td>:</td><td colspan="6">
			<?
				$mem_religion = GetSingleField("religion","tbl_religion_master","id",$member[religion]);
				echo $mem_religion;	
				if ($member[caste]) {
					echo "," . GetSingleField("caste","tbl_caste_master","id",$member[caste]);
				}				
				if ($member[gothram]) {
					echo "," . $member[gothram];
				}						
			?>
		  </td></tr>
		  <tr><td height="20">Location</td><td>:</td><td colspan="6">
			<? 
				if ($member[city]) {
					echo GetSingleField("city","tbl_city_master","id",$member[city]) . ', ' ;						
				}
				if ($member[state]) {
					echo GetSingleField("state","tbl_state_master","id",$member[state]) . ', ';
				}
				if ($member[country]) {
					echo GetSingleField("country","tbl_country_master","id",$member[country]);
				}
			?>		
		  </td></tr>
		  <tr><td height="20">Education</td><td>:</td><td colspan="6">
		  <?
			$mem_education = GetSingleField("education","tbl_education_master","id",$member[education]);
			echo $mem_education;	
			if ($member[educationDetail]) {
				echo "," . substr($member[educationDetail],0,15);
			}
		 ?>
		  </td></tr>
		  <tr><td height="20">Occupation</td>
		  <td>:</td><td colspan="6">
		  <?
				$mem_occupation = GetSingleField("occupation","tbl_occupation_master","id",$member[occupation]);
				echo $mem_occupation;
				if ($member[occupationDetail]) {
					echo "," . substr($member[occupationDetail],0,15);
				}
			?>	
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="view_member_profile.php?userid=<?=$member[username]?>" class="org"><b>more details...</b></a>
		   </td></tr>
		</table>							</td>
  </tr>
  <tr>
	<td colspan="2" bgcolor="#f0edd4">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		  	<td width="35" align="center"><input type="checkbox" name="chkPro[]" value="<?=$member[id]?>" /></td>
			<td width="35" align="center"><a onclick="fnCompare();"  style="cursor:pointer"><img src="images/search_icon_comparin.jpg" title="Compare any 3 Profiles " border="0"/></a></td>
			<td width="35" align="center"><a href="search.php?action=search&age=<?=$member[age]?>&caste=<?=$member[caste]?>&education=<?=$member[education]?>"><img src="images/icon_note.jpg" border="0" title="View Similar Profile"/></a></td>						
			<td width="35" align="center"><a href="forward_profile.php?mode=bookmark&id=<?=$member[id]?>"><img src="images/icon_boolin.jpg" border="0" title="Add this profile to your Book Mark List"/></a></td>						
			<? if ($member[horoscope]) {?>			
			<td width="35" align="center"><a class="mored"><img src="images/icon_astro.jpg" title="Horoscope" border="0" onclick="openHoroscope('<?=base64_encode("horoscope");?>','<?=base64_encode($member[id])?>')" style="cursor:pointer"/></a></td>	
			<?  } ?>
			<td width="35" align="center"><img src="images/search_icon_phon.gif" title="View Phone Number" border="0" onclick="javascript:openContact('phone','<?=base64_encode($member[id])?>')" style="cursor:pointer"/></td>			
			<td width="35" align="center"><img src="images/home_icon.gif" title="View Contact Address" border="0" onclick="javascript:openContact('address','<?=base64_encode($member[id])?>')" style="cursor:pointer"/></td>								
			<td width="35" align="center"><a href="forward_profile.php?id=<?=$member[id]?>&mode=forward" class="mored"><img src="images/icon_forin.jpg"  title="Forword  this profile " border="0"/></a></td><td width="32" valign="center"><a href="Personal_Message.php?id=<?=$member[id]?>&amp;mode=forward" class="mored"><img src="images/icon_forin.jpg"  title="Personal Message " border="0"/></a></td>						
			<td>&nbsp;</td>
            
			<td width="153" align="right"><div class="expressbg"><a href="javascript:<? if (!$config[userinfo][enable] && $config[userinfo]) { ?>alert('Your profile not yet activate');<? } else { ?>location.href='send_express_interest.php?action=send&id=<?=$member[id]?>'<? } ?>" class="orng1">Express Your Interest</a></div></td>						
		  </tr>
		</table>
	</td>
</tr>
</table>	


<? 	echo "<br>";	
		$k++; 
	} ?>
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

<SCRIPT type="text/javascript">

/***********************************************
* Link Floatie script- � Dynamic Drive DHTML code library (www.dynamicdrive.com)
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
//floatobj.style.border="#333333 0px solid"
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