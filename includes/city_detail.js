var xmlHttp1

function cit(str1)
{ 
xmlHttp1=GetXmlHttpObject1()
//var a=document.form1.message.value
if (xmlHttp1==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
var url="city_details.php"
url=url+"?d="+str1
url=url+"&sid="+Math.random()
//alert(url)
xmlHttp1.onreadystatechange=stateChanged1 
xmlHttp1.open("GET",url,true)
//document.form1.message.value=""
xmlHttp1.send(null)
}

function stateChanged1() 
{ 
if (xmlHttp1.readyState==4 || xmlHttp1.readyState=="complete")
 { 
 document.getElementById("cc").innerHTML=xmlHttp1.responseText 
 } 
}


function GetXmlHttpObject1()
{
var xmlHttp1=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp1=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlHttp1=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp1=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp1;
}