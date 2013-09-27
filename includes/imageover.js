var offsetfrommouse=[20,15];
var displayduration=0;
var currentimageheight = 500;
var defaultimageheight = 40;
var defaultimagewidth = 40;
a=new Image(100,25); b=new Image(100,25); c=new Image(100,25);
a.src="product_ratings/loading.gif"; b.src="images/wen.gif"; c.src="images/bnow.gif";
document.write('<div style="display: none; position: absolute;z-index:110;" id="trailimageid"></div>');
function gettrailobj(){ 
if (document.getElementById) return document.getElementById("trailimageid").style
else if (document.all) return document.all.trailimagid.style
}
function gettrailobjnostyle(){
if (document.getElementById) return document.getElementById("trailimageid")
else if (document.all) return document.all.trailimagid
}
function truebody(){
return (!window.opera && document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}
function showtraildiscount(imagename,title,imagewidth,imageheight,ratingaverage,ratingnumber,showthumb,height,hres,word){
 height+=55
 defaultimageheight = currentimageheight
 defaultimagewidth = 500
 document.onmousemove=followmouse; cameraHTML = '';
 newHTML = '<div style="padding: 5px; width: 250px; height:250px; background-color: #FFF; border: 1px solid #888;">';
 if (ratingnumber == 0){ratingaverage = 0;}
 cameraHTML = '<img src="product_ratings/' + ratingaverage + '.gif">' + '(' + ratingnumber  + ')';
 newHTML = newHTML + '<span valign="middle" class="pagehead" style="color:#1D5B95;margin-top:10px;margin-left:3px;margin-bottom:10px;">' + title + '</span><br>';
 //newHTML = newHTML + '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><img src="images/0.gif" width="1" height="3"></td></tr><tr><td bgcolor="#D52229"><img src="images/0.gif" width="1" height="5"></td></tr><tr><td><img src="images/0.gif" width="1" height="3"></td></tr></table>';
 //newHTML = newHTML + '<table border="0" cellspacing="0" cellpadding="0"><tr><td nowrap align="right"><font class="ns2"> &nbsp; </font></td><td><b>' + word + '</b>;&nbsp;</td><td nowrap align="right"><font class="ns2"> &nbsp; </font></td><td><b>' + hres + '</b></td></tr></table><table border="0" cellspacing="0" cellpadding="0"><tr><td nowrap align="right"><font class="ns2"> &nbsp; Product Rating:&nbsp;</font></td><td height="20">' + cameraHTML + '</td></tr></table>';
 //newHTML = newHTML + '<p align=justify style="margin-bottom:0px;margin-top:3px;">' + description + '</p>';
 //newHTML = newHTML + '<p align=justify style="margin-bottom:0px;margin-top:3px;">&nbsp;&nbsp;' + discount + '</p><br/>';
 newHTML = newHTML + '<div align="center" style="padding: 8px 2px 2px 2px;"><img src="' + imagename + '" width="'+imagewidth+'" height="'+imageheight+'" border="0"></div>';

 newHTML = newHTML + '</div>';
 gettrailobjnostyle().innerHTML = newHTML; gettrailobj().visibility = "visible"; gettrailobj().display="block";
}
function showtrail(imagename,title,imagewidth,imageheight,ratingnumber,showthumb,height,hres,word){
 height+=0
 defaultimageheight = currentimageheight
 defaultimagewidth = 0
 document.onmousemove=followmouse; cameraHTML = '';
 newHTML = '<div style="padding: 5px; background-color: #FFF; border: 1px solid #888;">';
 if (ratingnumber == 0){ratingaverage = 0;}
 //cameraHTML = '<img src="product_ratings/' + ratingaverage + '.gif">' + '(' + ratingnumber  + ')';
 newHTML = newHTML + '<span valign="middle" class="pagehead" style="color:#1D5B95;margin-top:10px;margin-left:3px;margin-bottom:10px;">' + title + '</span><br>';
// newHTML = newHTML + '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><img src="images/0.gif" width="1" height="3"></td></tr><tr><td bgcolor="#D52229"><img src="images/0.gif" width="1" height="5"></td></tr><tr><td><img src="images/0.gif" width="1" height="3"></td></tr></table>';
// newHTML = newHTML + '<table border="0" cellspacing="0" cellpadding="0"><tr><td nowrap align="right"><font class="ns2"> &nbsp; </font></td><td><b>' + word + '</b>;&nbsp;</td><td nowrap align="right"><font class="ns2"> &nbsp; </font></td><td><b>' + hres + '</b></td></tr></table><table border="0" cellspacing="0" cellpadding="0"><tr><td nowrap align="right"><font class="ns2"> &nbsp; Product Rating:&nbsp;</font></td><td height="20">' + cameraHTML + '</td></tr></table>';
// newHTML = newHTML + '<p align=justify style="margin-bottom:0px;margin-top:3px;">' + description + '</p><br/>';
 newHTML = newHTML + '<div align="center" style="padding: 8px 2px 2px 2px;"><img src="' + imagename + '" border="0"></div>';
 newHTML = newHTML + '</div>';
 gettrailobjnostyle().innerHTML = newHTML; gettrailobj().visibility = "visible"; gettrailobj().display="block";
}
function hidetrail(){
 gettrailobj().visibility="hidden"; document.onmousemove=""; gettrailobj().left="-500px";
}
function followmouse(e){
var xcoord=offsetfrommouse[0]
var ycoord=offsetfrommouse[1]
var docwidth=document.all? truebody().scrollLeft+truebody().clientWidth : pageXOffset+window.innerWidth-15
var docheight=document.all? Math.min(truebody().scrollHeight, truebody().clientHeight) : Math.min(window.innerHeight)
if (typeof e != "undefined"){ if (docwidth - e.pageX < defaultimagewidth + 2*offsetfrommouse[0]){ xcoord = e.pageX - xcoord - defaultimagewidth;} else {xcoord += e.pageX;}
 if (docheight - e.pageY < defaultimageheight + 2*offsetfrommouse[1]){ycoord += e.pageY - Math.max(0,(2*offsetfrommouse[1] + defaultimageheight + e.pageY - docheight - truebody().scrollTop));} else {ycoord += e.pageY;}
} else if (typeof window.event != "undefined"){if (docwidth - event.clientX < defaultimagewidth + 2*offsetfrommouse[0]){xcoord = event.clientX + truebody().scrollLeft - xcoord - defaultimagewidth;} else {xcoord += truebody().scrollLeft+event.clientX}
 if (docheight - event.clientY < (defaultimageheight + 2*offsetfrommouse[1])){ycoord += event.clientY + truebody().scrollTop - Math.max(0,(2*offsetfrommouse[1] + defaultimageheight + event.clientY - docheight));} else {ycoord += truebody().scrollTop + event.clientY;}
} gettrailobj().left=xcoord+"px"; gettrailobj().top=ycoord+"px"}