var xmlHttp

function hr(str)
{ 
xmlHttp=GetXmlHttpObject()
//var a=document.form1.message.value
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
var url="horo_city_details.php"
url=url+"?dat="+str
url=url+"&sid="+Math.random()
xmlHttp.onreadystatechange=stateChanged 
xmlHttp.open("GET",url,true)
//document.form1.message.value=""
xmlHttp.send(null)
}

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 document.getElementById("hor").innerHTML=xmlHttp.responseText 
 } 
}


function mcom(str1)
{ 
xmlHttp=GetXmlHttpObject()
//var a=document.form1.message.value
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
var url="male_horo_city_details.php"
url=url+"?dat="+str1
url=url+"&sid="+Math.random()
//alert(url)
xmlHttp.onreadystatechange=stateChanged1 
xmlHttp.open("GET",url,true)
//document.form1.message.value=""
xmlHttp.send(null)
}

function stateChanged1() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 document.getElementById("datm").innerHTML=xmlHttp.responseText 
 } 
}


function fcom(str2)
{ 
xmlHttp=GetXmlHttpObject()
//var a=document.form1.message.value
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
var url="male_horo_city_details.php"
url=url+"?dat1="+str2
url=url+"&sid="+Math.random()
//alert(url)
xmlHttp.onreadystatechange=stateChanged2 
xmlHttp.open("GET",url,true)
//document.form1.message.value=""
xmlHttp.send(null)
}

function stateChanged2() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 document.getElementById("fdat").innerHTML=xmlHttp.responseText 
 } 
}



function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}