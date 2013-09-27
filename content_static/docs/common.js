/* 
    MONyog - MySQL Monitor and Advisor
    Copyright (c) 2008 Webyog Softworks Private Limited (http://www.webyog.com)
*/

var LINECOLOR    = ['767575', '448EBB', '98F5FF', 'FFB90F', 'DC143C', 'AA639F', '0D3235', '634509',  'ffffff'];  // possible bug! dataset morethan 8?
var ANCHORCOLOR  = ['00E88F', 'FF0000', '0000FF', '000000', 'AA639F', '0D3235', '634509',  'ffffff'];  // possible bug! dataset morethan 8?
var ONOFFHEIGHT  = 170;
var LINELEN      = 8;
var HISTORY      = "history";
var ALLTIME      = "alltime";
var LATEST       = "latest";
var HISTORY_ALLTIME = "historyalltime";
var REAL_TIME_GRAPH_DISPLAY_SETS = 15;

var TOOLTIP_WIDTH               = 375;
var TOOLTIP_DELAY               = 200;
var TOOLTIP_BGCOLOR             = '#ffc';

var ONOFF       = "onoff";
var PERCENTAGE  = "Percent";
var DEFAULT_CAHRT_TYPE = "RealTimeLine.swf";
var CAHRT_EXT   = ".swf";
var CHART_XAXISCAPTIONHEIGHT = 50;

var CHART_SMALL  = 1;
var CHART_MEDIUM = 2;// default
var CHART_LARGE  = 3;
var CHART_EXTRA_LARGE = "4";
var CHART_DEFAULT_SHOW_COLLECTION_COUNT = 15;
var CHART_DEFAULT_SHOW_X_AXIS_VALUE = 0;
var CHART_DEFAULT_SHOW_X_AXIS_LABELS_COUNT = 12;
   
var WINDOW_CUSTOMDIALOG_HEIGHT  = 300;
var WINDOW_CUSTOMDIALOG_WIDTH   = 510;
   
function yXMLHttpRequest()
{
	var r;
	
	try 
	{
		r = new ActiveXObject("Msxml2.XMLHTTP");    
	}		
	catch(e)
	{
        r = new XMLHttpRequest();
	}
	
	if(!r)
	{
	    try 
	    {
		    r = new ActiveXObject("Microsoft.XMLHTTP");    
	    }
	    catch(e)
	    {
	        r = null;
	    }
	}
    
    if(!r)
        alert("XMLHttpRequest not supported by your browser. Please upgrade your browser.");       
    
    return r;
}

function yById(pElem)
{
    if(typeof(pElem) == 'string')
    {
        if(document.getElementById)
            pElem = document.getElementById(pElem);
        else 
            pElem = null;
    }
    return pElem;
}

// note: this method returns a collection of objects with the specified NAME(pElem)
function yByName(pName)
{
    if(typeof(pName) == 'string')
    {
        if(document.getElementsByName)
            pName = document.getElementsByName(pName);
        else 
            pName = null;
    }
    return pName;
}

function yAddListener(pEvent, pEType, pEListener, pUseCapture)
{
    pEvent = yById(pEvent);   
    
    if(pEvent.addEventListener)
    {
        pEvent.addEventListener(pEType, pEListener, pUseCapture);
    }
    else
        pEvent.attachEvent('on' + pEType, pEListener);
}


function HandleCloseWindow()
{
    // on unload we want to issue the "CloseWindow" function so that the http thread we can colse if any!
    if(window.attachEvent) 
    {
        window.attachEvent("onunload", CloseWindow);
    } 
    else 
    {
        if(window.addEventListener) 
        {
            window.addEventListener("unload", CloseWindow, false); 
        } 
        else
        {
            window.onunload = CloseWindow;
        }
    }
}

function yRemoveListener(pEvent, pEType, pEListener, pUseCapture)
{
    pEvent = yById(pEvent);

    if(pEvent.removeEventListener)
        pEvent.removeEventListener(pEType, pEListener, pUseCapture);
    else
        pEvent.detachEvent('on' + pEType, pEListener);
}

function xEncodePair(pName, pValue)
{
	var	ret;
	var	regexp = /%20/g;
	
	ret = encodeURIComponent(pName).replace(regexp,"+")+'='+encodeURIComponent(pValue).replace(regexp,"+");
	return ret;
}

function SetMONyogVersion(pSubTitle)
{
	var http;
	var response;
	
	http = yXMLHttpRequest();
	
	http.open("POST", "/", false);
	http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");	
	http.setRequestHeader("Req-Type", "ajax");
	formdata    = xEncodePair("_object", "VersionMgr")+ "&";
	formdata   += xEncodePair("_action", "Version");
	
	http.send(formdata);
	
	if(http.status == 200)
	{
	    if(IsSessionError(http.responseText) == true)// checks whether session(trial) expired or not
		    HandleSessionError(http.responseText);
		else
		{
		    // no check for session expired is required because we will allow version retreival everytime!
	        response                        = eval(http.responseText);
		    document.title                  = "MONyog " + response[0].Version + " " + pSubTitle;
		    yById("lyr_version").innerHTML  = response[0].Version;
		
		    if(response[0].ExtraInfo) // etra info containing remaining days to expire is shown using this
	            yById("lyr_version").innerHTML += "<span class = 'trialmsg'> - " + response[0].ExtraInfo + "</span>";
	            
            if(response[0].FeedBackInfo) // feedback link only in Trial
	            yById("monyog_feedback").innerHTML = response[0].FeedBackInfo;
        }
        
        http = null;
    }
}


function SetGraphTitle(pTitle)
{
	document.title = pTitle;
}

function HandleHttpSend(pHttp, pFormData)
{
	pHttp.open("POST", "/", true);
	pHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	pHttp.setRequestHeader("Req-Type", "ajax");
	
	pHttp.send(pFormData);
	
	window.http = pHttp; // keep the pointer in the window level so it will get detroyed in the window close
	
	pFormData = null;
}

// common function to create a ddocument element
// it will take three argument,  tag, classname, and id
function CreateElement(pTag, pClass, pId)
{
	var elem = null;
	
	if(!pTag)
		return elem;
		
	elem = document.createElement(pTag);
	
	if(pClass)
		elem.className = pClass;

	if(pId)
		elem.id = pId;
		
	return elem;
}

// Sets the group warnmode (red, yellow or white)
function SetWarnMode(pGroupId, pVal)
{
	var groupwarn = xGetElementById(pGroupId +"_warn");
	
	if(groupwarn)
	{
	    if(pVal == "groupyellow" && xHasClass(groupwarn, "groupred"))
	        return;
	        
		groupwarn.className = pVal;
    }
}


// Helps to sync the table row height, so every server details will show with the sme height
function SyncColumnHeights()
{	   
	var tablecount;
	var topmost;
	var alltables;
	var alltableslength;
	var currtable;
	var table;
	var row;
	var rowcount; 
	var heights = [];
	
	// get the topmost table
	topmost		= yById("topmost");
	alltables	= topmost.getElementsByTagName("table")
	alltableslength = alltables.length;
	
	// skip the first table..start from second
	for(tablecount = 1; tablecount < alltableslength; tablecount++)
	{
		// get the table for each server
		table = alltables[tablecount];
		
		/*for(rowcount = 0; rowcount < table.rows.length; rowcount++)
		{			
			if(xDisplay(table.rows[rowcount]) != 'none')
			{
				var rowheight = xHeight(table.rows[rowcount]);
				
				if((heights[rowcount] == null)|| heights[rowcount] < rowheight)
					heights[rowcount] = rowheight;
			}
		}*/
		
		
		rowcount = table.rows.length;
		if(rowcount > 0)
		{
		    do
		    {
		        var cnt = rowcount - 1;
		        if(xDisplay(table.rows[cnt]) != 'none')
			    {
				    var rowheight = xHeight(table.rows[cnt]);
    				
				    if((heights[cnt] == null)|| heights[cnt] < rowheight)
					    heights[cnt] = rowheight;
			    }
		        
		    }while(--rowcount);
		}
	}		
	
	
	// get the topmost table
	//topmost		= yById("topmost");
	//alltables	= topmost.getElementsByTagName("table")
	
	for(tablecount = 1; tablecount < alltableslength; tablecount++)
	{
		// get the table for each server
		table = alltables[tablecount];
		
		/*for(rowcount = 0; rowcount < table.rows.length; rowcount++)
		{
			if(xDisplay(table.rows[rowcount]) != 'none')
			{
				if(xHeight(table.rows[rowcount]) < heights[rowcount])
					xHeight(table.rows[rowcount], heights[rowcount]);
			}
		}*/
		
		rowcount = table.rows.length;
		if(rowcount > 0)
		{
		    do
		    {
		        var cnt = rowcount - 1;
		        if(xDisplay(table.rows[cnt]) != 'none')
			    {
				    if(xHeight(table.rows[cnt]) < heights[cnt])
					    xHeight(table.rows[cnt], heights[cnt]);
			    }
		        
            }while(--rowcount);
		}		
				
	}		
}

// It will initiate the ShowAll page, first it will get all the selected server details,
// and helps to populate seperate ajax request for each server to get details
function GetShowAllDetails()
{
	var http = yXMLHttpRequest();
	var response;
	
	http.onreadystatechange = function()
	{
		if(http.readyState == 4)
		{      
			if(http.status == 200)
			{
				response = http.responseText;
				
		        if(IsSessionError(response) == true) // checks whether session(trial) expired or not
		            HandleSessionError(response);
		        else
		        {
		            // instantiate a ShowAll class which willhandle all functions affect to all servers
				    var showall = new Webyog.MONyog.ShowAll();
    				
    				// initilizes the listeners
    				showall.InitContextOption();
    				
				    showall.vServerDetails = eval(response);
    				
				    // Got server details ; now populate the tables and ask for server variables
				    showall.PopulateServerTables();
    				
    				// while resizing the page we need to take care the row heights
				    yAddListener(window, "resize", SyncColumnHeights, false);
                }
				
				http = null;
			}
		}
	}
	
	formdata = xEncodePair("_object", "ConnectionMgr")+ "&";
    formdata += xEncodePair("_action", "GetSelectedServerDetails");
	    
	HandleHttpSend(http, formdata);
}

// It will initiate the DashBoard page, first it will get all the selected server details,
// and helps to populate seperate ajax request for each server to get details(for mysql as well as for system)
function GetDashBoardDetails()
{
	var http = yXMLHttpRequest();
	var response;	
	
	http.onreadystatechange = function()
	{
		if(http.readyState == 4)
		{      
			if(http.status == 200)
			{
				response = http.responseText;
		
		        if(IsSessionError(response) == true)// checks whether session(trial) expired or not
		            HandleSessionError(response);
		        else
		        {
		            // instantiate a DashBoard class which will handle all functions affect to all servers
				    var dashboard= new Webyog.MONyog.DashBoard();
				    dashboard.Init();
				
				    dashboard.vServerDetails = eval(response);
				
				    dashboard.GetChartDetails(false);
                }
				
				http			= null;
			}
		}
	}
	
	formdata = xEncodePair("_object", "ConnectionMgr")+ "&";
    formdata += xEncodePair("_action", "GetSelectedServerDetails");
    
    HandleHttpSend(http, formdata);
}

// It will initiate the ProcessList page, first it will get all the selected server details,
// and helps to populate seperate ajax request for each server to get details(for mysql as well as for system)
function GetProcessListDetails()
{
	var http = yXMLHttpRequest();
	var response;	
	
	http.onreadystatechange = function()
	{
		if(http.readyState == 4)
		{      
			if(http.status == 200)
			{
				response = http.responseText;
		
		        if(IsSessionError(response) == true)// checks whether session(trial) expired or not
		            HandleSessionError(response);
		        else
		        {
		            // instantiate a DashBoard class which will handle all functions affect to all servers
				    var pslist = new Webyog.MONyog.ProcessList();
				
				    pslist.vServerDetails = eval(response);
				    
				    pslist.PopulateProcessList();
                }
				
				http			= null;
			}
		}
	}
	
	formdata = xEncodePair("_object", "ConnectionMgr")+ "&";
    formdata += xEncodePair("_action", "GetSelectedServerDetails");
    
    HandleHttpSend(http, formdata);
}



function InitLogAnalyzer()
{
    var http = yXMLHttpRequest();
	var response;	
	http.onreadystatechange = function()
	{
		if(http && http.readyState == 4)
		{      
			if(http && http.status == 200)
			{
			    response = http.responseText;
		        
		        if(IsSessionError(response) == true)// checks whether session(trial) expired or not
		            HandleSessionError(response);
		        else
		        {
		            // instantiate a Slowquery log  class which will handle all functions 
				    var pslist = new Webyog.MONyog.LogAnalyzer();
				
					pslist.Init();
				    pslist.vServerDetails = eval(response);
				    pslist.ShowDetails();
                }
				
				http			= null;
			}
		}
	}
	
	formdata = xEncodePair("_object", "ConnectionMgr")+ "&";
    formdata += xEncodePair("_action", "GetSelectedServerDetails");
    
    HandleHttpSend(http, formdata);
}

function SetValue(pObjFlash, pIntValue)
{
    //This function sets the updated value of the chart.
    //Get a reference to the movie
    //var FCObject = GetObject(pObjFlash);
    var FCObject = getChartFromId(pObjFlash);
    
    if(!FCObject)
        return;
    //Set the data
    FCObject.SetVariable("_root.Value", pIntValue);
    //Go to the required frame
    FCObject.TGotoLabel("/", "NewDataHandler"); 
    //alert(pObjFlash + " --- " + pIntValue);
}

/*function GetObject(pObjectName) 
{
    if(navigator.appName.indexOf ("Microsoft") !=-1 ) 
        return window[pObjectName];
    else 
        return document.embeds[pObjectName];
}
*/
// helps to kill the http thread
function CloseWindow()
{
    AbortHttp(window.http);
}

function AbortHttp(pHttp)
{
    if(pHttp)
   {
		pHttp.onreadystatechange = function() {};
        pHttp.abort();
        pHttp = null;
   }
}

// This function gets the details required to draw the counter graph
// pServerName -- servername
// pServerIndex -- server index in the collection of servers
// pCaptureInterval -- server capture interval( diff for each server )
// pCatalogName -- counter catalog name (system/mysql)
// pRowId -- counter row id
// pAllTime -- counter is alltime based or not (1 -- current/alltime, 0 -- latest)

function GetGraphInfo(pServerName, pServerIndex, pCaptureInterval, pCatalogName, pFileRowId, pFileName, pAllTime)
{
	var http = yXMLHttpRequest();
	var response;	
	var result;
	
	http.onreadystatechange = function()
	{
		if(http.readyState == 4)
		{      
			if(http.status == 200)
			{
				response = http.responseText;
				
				if(IsSessionError(response) == true)// checks whether session(trial) expired or not
		            HandleSessionError(response);
		        else
		        {
			        // instantiate a CounterGraph class which will handle all functions affect to a counter graph!
			        var graph = new Webyog.MONyog.CounterGraph(pServerName, pServerIndex, 
			                                                   pCaptureInterval, pCatalogName, 
			                                                   pFileRowId, pFileName, pAllTime);	
				
				    graph.DrawGraph(eval(response));
				    graph = null;
				}
				
				http = null;
			}
		}
	}
	
	http.open("POST", "/", true);
	http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	http.setRequestHeader("Req-Type", "ajax");
	
	// send some params
	formdata = xEncodePair("_object", "Graph")+ "&";
	formdata += xEncodePair("_action", "GetGraphInfo") + "&";
	formdata += xEncodePair("_filerowid", pFileRowId) + "&";
	formdata += xEncodePair("_filename", pFileName);
	
	//alert(formdata);
	
	http.send(formdata);
	
	window.http = http;
	formdata    = null;
}


// instantiates the fushionchart

// check for the session(Trial) expired or not
// if it is expired the first 6 chars should be "<script>"
function IsSessionError(pResponse)
{
    var start;
    
    if(pResponse)
    {
        start = pResponse.substr(0, 8);
        
        if(start == "<script>")
            return true;
    }
        
       return false;
}

// check for the Trial expired or not
// if it is expired the first 6 chars should be "<script>"
// and expired.html should be there in the innerHTML part
function IsTrialExpired(pResponse)
{
    var start;
    
    if(pResponse)
    {
        start = pResponse.substr(0, 8);
        
        if(start == "<script>")
        {
            found = pResponse.indexOf("expired.html", 0);
            
            if(found != -1)
                return true;
        }
    }
        
    return false;
}

// diagnoses the whether trial or session expired
function HandleSessionError(pResponse)
{
    if(IsTrialExpired(pResponse) == true)
	    window.location="/expired.html"; // trial expired!
    else
	    window.location="/login.html"; // session expired!
}


// common function to send the http request
function SendRequest(pFormData)
{
	var http;
	var formdata;

	http = yXMLHttpRequest();
	
	http.open("POST", "/", false);
	http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	http.setRequestHeader("Req-Type", "ajax");
	
	http.send(pFormData);
	
	return http;
	
}


// this function helps to parse all the parameters send along with the url

function GetURLParameters( pName )
{  
    pName = pName.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");  
    var regexS = "[\\?&]"+pName+"=([^&#]*)";  
    var regex = new RegExp( regexS );  
    var results = regex.exec(window.location.href);  
    
    if(results == null)    
        return "";  
    else    
        return results[1];
}

/*function GetURLParameters(pName) 
{
	var sURL = window.document.URL.toString();
	
	if(!pName)
	    return null;
	
	if (sURL.indexOf("?") > 0)
	{
		var arrParams = sURL.split("?");
			
		var arrURLParams = arrParams[1].split("&");
		
		var arrParamNames = new Array(arrURLParams.length);
		var arrParamValues = new Array(arrURLParams.length);
		
		var i = 0;
		
		for (i=0;i<arrURLParams.length;i++)
		{
			var sParam =  arrURLParams[i].split("=");
			arrParamNames[i] = sParam[0];
			if (sParam[1] != "" && sParam[0] == pName)
			{
				arrParamValues[i] = unescape(sParam[1]);
				return arrParamValues[i];
            }
			else
				arrParamValues[i] = "No Value";
		}
		
		if(arrURLParams.length)
			return arrParamValues[0];
	}
	
	return null;
}
*/

// helps to htmlize the the string
function Htmlize(pStr)
{
    pStr = pStr.replace(/\&/g,"&amp;");
    pStr = pStr.replace(/\</g,"&lt;");
    pStr = pStr.replace(/\>/g,"&gt;");
    pStr = pStr.replace(/\"/g,"&quot;");
    pStr = pStr.replace(/\n/g,"<br/>\n");
    pStr = pStr.replace(/ /g,"&nbsp;");

    return pStr;
}

// helps to handle the Custom timeframe radio button in showall page
function HandleHistoryOptions()
{
    var customoption= yById("history_value");
    var historymsg1 = yById("history_msg1");
    var historymsg2 = yById("history_msg2");
    var historyfrom = yById("history_from");
    var historyto   = yById("history_to");
    var historyedit = yById("history_edit");
    
    var active      = true;
    var visible     = false;
    
    if(customoption.checked == true)
    {
        active  = false;
        visible = true;
    }
        
    historyedit.disabled = active;
    historyfrom.disabled  = active;
    historyto.disabled    = active;
    historymsg1.disabled  = active;
    historymsg2.disabled  = active;
    
    xVisibility(historyedit, visible)
    xVisibility(historyto, visible)
    xVisibility(historyfrom, visible)
    xVisibility(historymsg1, visible)
    xVisibility(historymsg2, visible)
        
    return true;
}

function CheckCookiesEnabled()
{
    // remember, these are the possible parameters for Set_Cookie:
    // name, value, expires, path, domain, secure
    SetCookie( 'test', 'none', 1, '/', '', '' );
    // if Get_Cookie succeeds, cookies are enabled, since 
    //the cookie was successfully created.
    if(GetCookie('test'))
    {
	    DeleteCookie('test', '/', '');
	    return true;
    }
    else
    {
        alert("MONyog requires that your web browser accept cookies in order to tell that you are logged in. " +
              "\nThere are a couple of reasons why your web browser might not be accepting cookies: " + 
              "\n1. You are using a web browser that doesn't support them." + 
              "\n2. Your browser is set to not accept cookies. Please enable cookies in your browser.");        
              
        return false;
    }
}

function GetTextContent(pElem)
{
    var textvalue = null;
    
    if(typeof pElem.textContent != "undefined")
        textvalue = pElem.textContent;
    else
        textvalue = pElem.innerText;
        
    return textvalue;
}


function SetTextContent(pElem, pTextValue)
{
    if(typeof pElem.textContent != "undefined")
        pElem.textContent = pTextValue;
    else
        pElem.innerText = pTextValue;
}

// this function gets the cookie, if it exists
function GetCookie(pName) 
{
	var start = document.cookie.indexOf(pName + "=" );
	var len = start + pName.length + 1;
	
	if((!start) && (pName != document.cookie.substring(0, pName.length)))
		return null;
	
	if(start == -1) 
	    return null;
	    
	var end = document.cookie.indexOf(";", len);
	
	if(end == -1) 
	    end = document.cookie.length;
	    
	return unescape(document.cookie.substring(len, end));
}


function SetCookie(pName, pValue, pExpires, pPath, pDomain, pSecure) 
{
	// set time, it's in milliseconds
	var today = new Date();
	today.setTime( today.getTime() );
	// if the expires variable is set, make the correct expires time, the
	// current script below will set it for x number of days, to make it
	// for hours, delete * 24, for minutes, delete * 60 * 24
	if(pExpires)
	{
		pExpires = pExpires * 1000 * 60 * 60 * 24;
	}
	var expiresdate = new Date(today.getTime() + (pExpires) );

	document.cookie = pName + "=" + escape(pValue) +
		((pExpires) ? "; expires=" + expiresdate.toGMTString() : "" ) + 
		((pPath)    ? "; path=" + pPath : "" ) + 
		((pDomain)  ? "; domain=" + pDomain : "" ) +
		((pSecure)  ? "; secure" : "" );
}

// this deletes the cookie when called
function DeleteCookie(pName, pPath, pDomain) 
{
	if(GetCookie(pName))
	    document.cookie = pName + "=" + ((pName) ? "; path=" + pPath : "") + ((pDomain)? "; domain=" + pDomain : "") + ";expires=Thu, 01-Jan-1970 00:00:01 GMT";
}

function HandleKeyPress(pEvent)
{
    if(pEvent.keyCode == 27) // escape key
        //hidePopWin(false);
        ClosePopWin();
}


// helps to close the special popup window(div) used for custom timeframe as well as counter details
function ClosePopWin()
{
    var popupmask;
    var popupcontainer;
    var allselects;
    
    parent.document.getElementById('popupFrame').style.display = 'none';
    parent.document.getElementById('popupFrame').src = "/loading.html";
    
    popupmask       = parent.document.getElementById("popupMask");
	popupcontainer  = parent.document.getElementById("popupContainer");
	
	popupmask.style.display = "none";
	popupcontainer.style.display = "none";
	// Show all select elements if hidden
	allselects = parent.document.getElementsByTagName("select");
  for(var i = 0; i < allselects.length; i++)
  {
   allselects[i].style.visibility="visible";
  }
}


// used to adjust the special window position(div)
function GetViewportHeight() 
{
	if(window.innerHeight!=window.undefined) 
	    return window.innerHeight;
	    
	if(document.compatMode=='CSS1Compat') 
	    return document.documentElement.clientHeight;
	    
	if(document.body) 
	    return document.body.clientHeight; 

	return window.undefined; 
}

// used to adjust the special window position(div)
function GetViewportWidth() 
{
	var offset = 17;
	var width = null;
	
	if(window.innerWidth!=window.undefined) 
	    return window.innerWidth; 
	    
	if(document.compatMode=='CSS1Compat') 
	    return document.documentElement.clientWidth; 
	    
	if(document.body) 
	    return document.body.clientWidth; 
}

// used to adjust the special window position(div)
function GetViewportWidth() 
{
	var offset = 17;
	var width = null;
	
	if(window.innerWidth!=window.undefined) 
	    return window.innerWidth; 
	    
	if(document.compatMode=='CSS1Compat') 
	    return document.documentElement.clientWidth; 
	    
	if(document.body) 
	    return document.body.clientWidth; 
}

// used to adjust the special window position(div)
function GetScrollTop() 
{
	if(self.pageYOffset) // all except Explorer
		return self.pageYOffset;
	else if(document.documentElement && document.documentElement.scrollTop)
		return document.documentElement.scrollTop;
	else if(document.body) // all other Explorers
		return document.body.scrollTop;
}

// used to adjust the special window position(div)
function GetScrollLeft() 
{
	if(self.pageXOffset) // all except Explorer
		return self.pageXOffset;
	else if(document.documentElement && document.documentElement.scrollLeft)
		return document.documentElement.scrollLeft;
	else if(document.body) // all other Explorers
		return document.body.scrollLeft;
}

// handle the logout confirmation
function Logout()
{
    if(confirm("Are you sure you want to log out?") == false)
	    return false;
	else
	{
	    window.location = "/?_object=Login&_action=Logout";
	    return true;
    }
}   

// Calculates the server uptime from the server start time
function GetServerUptime(pServerStartTime)
{
    var today           = new Date();
	var serverstarttime = new Date(pServerStartTime * 1000);
	
	return ((today - serverstarttime)/1000);
}

// converts seconds to minutes/hours/days accordingly
function SetTimeFromSec(pSec, pValueElem, pUnitElem)
{
    var sec      = 1;
    var minute   = 60 * sec;
    var hour     = 60 * minute;
    var day      = 24 * hour;
    var limit    = 0;
    var unit     = "";
    
    if(pSec%day == 0)
    {
        limit = pSec/day;
        unit  = 0;
    }
    else if(pSec%hour == 0)
    {
        limit = pSec/hour;
        unit  = 1;
    }
    else if(pSec%minute == 0)
    {
        limit = pSec/minute;
        unit  = 2;
    }
    else
    {
        limit = pSec;
        unit  = 3;
    }
    
    pValueElem.value = limit;
    pUnitElem.options[unit].selected = true;
}


// used to validate the text input box for number
function CheckForNumber(pEvent) 
{
    var evt = pEvent;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : 
        ((evt.which) ? evt.which : 0));
    
    // Allow numbers and DELETE and BACKSPACE keys only
    if((charCode >= 48 && charCode <= 57) || (charCode == 127 || charCode == 8 || charCode == 9 || charCode == 46 || charCode == 37 || charCode == 39))
        return true;
    else
        return false;
            
   /* if (charCode > 31 
        && (charCode < 48 || charCode > 57) 
        && (charCode < 112 || charCode > 123) 
        && (charCode < 33 || charCode > 40) 
        && charCode != 46) 
    {
    return false;
}
    return true;*/
}

function FC_Rendered(DOMId)
{
	return;
}

function SetClipBoardData(pText)
{   //http://www.krikkit.net/howtos/copy_text_to_clipboard_with_javascript.html

    if(window.clipboardData) 
   {
        // IE
        window.clipboardData.setData("Text", pText);
   }
   else if (window.netscape) 
   { 
        // you have to sign the javascript the code to enable this, or see notes below 
        //http://www.mozilla.org/projects/security/components/signed-scripts.html
        netscape.security.PrivilegeManager.enablePrivilege('UniversalXPConnect');
   
        // amke an interface for clipboard
        var clip = Components.classes['@mozilla.org/widget/clipboard;1']
                        .createInstance(Components.interfaces.nsIClipboard);
        if(!clip) 
            return;
   
        // make an transferable 
        var trans = Components.classes['@mozilla.org/widget/transferable;1']
                  .createInstance(Components.interfaces.nsITransferable);
        if (!trans) 
            return;
   
        // set content type
        trans.addDataFlavor('text/unicode');
           
        var str = new Object();
        var len = new Object();
           
        var str = Components.classes["@mozilla.org/supports-string;1"]
                        .createInstance(Components.interfaces.nsISupportsString);
           
        var copytext = pText;
           
        str.data = copytext;
           
        trans.setTransferData("text/unicode", str,copytext.length*2);
           
        var clipid=Components.interfaces.nsIClipboard;
           
        if(!clip) 
            return false;
           
        clip.setData(trans, null, clipid.kGlobalClipboard);
   }
   
   return false;
}

function IsValidJSONText(pJSONText)
{
    var jsonobject = !(/[^,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t]/.test(pJSONText.replace(/"(\\.|[^"\\])*"/g, ''))) && eval('(' + pJSONText + ')');
    
    return jsonobject;
}

function FindPos(pObj, pIsIframe) 
{
	var curleft = curtop = 0;
	
	if(pObj.offsetParent) 
	{
		curleft = pObj.offsetLeft;
		curtop = pObj.offsetTop;
		
		while (pObj = pObj.offsetParent) 
		{
			curleft += pObj.offsetLeft;
			curtop += pObj.offsetTop;
		}
	}
	
    if(pIsIframe == true)
    {
        var thebody = parent.document.getElementsByTagName("BODY")[0];
        var thewindow =  parent.window;
        
        var left;
        var top;
        
        left = thewindow.screenLeft;
        top = thewindow.screenTop;
        
        if(isNaN(left))
            left = thewindow.screenX;
        
        if(isNaN(top))
            top = thewindow.screenY;
        
        curleft += left;
        curtop  += top;
        
        curleft += thebody.offsetWidth/2;
        curtop  += thebody.offsetHeight/2;
    }

    return [curleft,curtop];
}


function ShowTrendInfo()
{
    var rowid   = GetURLParameters("_rowid"); 
    var filerowid = GetURLParameters("_filerowid"); 
    var filename = GetURLParameters("_filename"); 
    var group   = GetURLParameters("_group"); 
    var server  = GetURLParameters("_server");
    var catalog = GetURLParameters("_catalog")
    var alltime = GetURLParameters("_alltime")
    var from    = GetURLParameters("_from");
    var to      = GetURLParameters("_to");
    var rowname = GetURLParameters("_rowname");
    var groupfunction = GetURLParameters("_groupfunction");
    var title   = unescape(server) + " - " + unescape(rowname) + " (" + unescape(group) + ")"; // frame window title
            
    var trend = new Webyog.MONyog.Trend(unescape(server), rowid, filerowid, unescape(filename), unescape(group), catalog, alltime, from, to, groupfunction);
    
    document.title = yById("history_graph_title").innerHTML = title; // set the window title
    
    trend.Init();
}

function FC_ChartUpdated(DOMId)
{
    //alert("Graph updated!");
    
    //var chartRef = getChartFromId(DOMId);
    //alert(DOMId + " -- "  + chartRef.getNamedItem("yAxisMaxValue"));
    return;
    
}

function IsIE()
{
    var agt    = navigator.userAgent.toLowerCase();
    var is_ie  = ((agt.indexOf("msie") != -1) && (agt.indexOf("opera") == -1));
    
    return is_ie;
}

function ResetLinks()
{
    var param = GetURLParameters("action");
    
    if(param &&  param == "no")
    {
        var navbar    = yById("navbar");
        var subnavbar = yById("navbarsub");
        var linkon    = yById("link_on");
        var pref;
        var cust;
        var log;
        
        navbar.removeChild(navbar.firstChild.nextSibling);
        navbar.removeChild(navbar.firstChild.nextSibling); // process list
        navbar.removeChild(navbar.firstChild.nextSibling);
        navbar.removeChild(navbar.firstChild.nextSibling); // show all
        navbar.removeChild(navbar.firstChild.nextSibling);
        navbar.removeChild(navbar.firstChild.nextSibling); // log analyzer
        navbar.removeChild(navbar.firstChild.nextSibling);
        navbar.removeChild(navbar.firstChild.nextSibling); // dash board
        
        pref = subnavbar.firstChild;
        cust = pref.nextSibling.nextSibling;
        log  = cust.nextSibling.nextSibling;
        
        pref.href = pref.href + "?action=no";
        cust.href = cust.href + "?action=no";
        log.href = log.href + "?action=no";
        linkon.href = linkon.href + "?action=no";
    }
    
    yById("captionbar").style.visibility = "visible";
}

function GetRadioButtonChecked(pNameOfRadioGroup)
{
	var i = 0;
	var arrayofbuttons;
	arrayofbuttons = yByName(pNameOfRadioGroup);
	
	for(i = 0; i < arrayofbuttons.length; i++)
	{
		if(arrayofbuttons[i].checked == true)
		{
			return arrayofbuttons[i].value;
		}
	}
}

function CreateGraph(pChart)
{
	var flashvars   = "";
	var chartid     = "Chart_" + pChart.serverid + "_" + pChart.chartid;
	var chart;
	var url;
	
	var s = "[{\"height\":\"150\",\"width\":\"250\",\"showxaxisvalue\":\"0\",\"yaxispadding\":\"0\",\"showyaxisvalues\":\"0\",\"basefontsize\":\"9\",\"linethickness\":\"1\",\"anchorradius\":\"2\",\"onoffheight\":\"90\",\"onoffanchorradius\":\"3\"}]";
	var m = "[{\"height\":\"190\",\"width\":\"375\",\"showxaxisvalue\":\"0\",\"yaxispadding\":\"55\",\"showyaxisvalues\":\"1\",\"basefontsize\":\"10\",\"linethickness\":\"2\",\"anchorradius\":\"3\",\"onoffheight\":\"100\",\"onoffanchorradius\":\"4\"}]";
	var l = "[{\"height\":\"280\",\"width\":\"450\",\"showxaxisvalue\":\"1\",\"yaxispadding\":\"55\",\"showyaxisvalues\":\"1\",\"basefontsize\":\"10\",\"linethickness\":\"3\",\"anchorradius\":\"4\",\"onoffheight\":\"110\",\"onoffanchorradius\":\"5\"}]";
	var e = "[{\"height\":\"440\",\"width\":\"675\",\"showxaxisvalue\":\"1\",\"yaxispadding\":\"55\",\"showyaxisvalues\":\"1\",\"basefontsize\":\"10\",\"linethickness\":\"3\",\"anchorradius\":\"4\",\"onoffheight\":\"110\",\"onoffanchorradius\":\"5\"}]";
	
	if(!pChart.charttype)
	    pChart.charttype = DEFAULT_CAHRT_TYPE;// default chart type
	else
	    pChart.charttype += CAHRT_EXT;
	    
	    
	if(!pChart.chartsize || pChart.chartsize == 0)
	    pChart.chartsize = CHART_LARGE;
	    
	switch(pChart.chartsize)
	{
	    case CHART_SMALL:
            pChart.sizeconfig = eval(s)[0];
	        break;

        case CHART_MEDIUM:
            pChart.sizeconfig = eval(m)[0];
	        break;
        
        case CHART_EXTRA_LARGE:
	        pChart.sizeconfig = eval(e)[0];
	        break;
	        
	    case CHART_LARGE:
	    default:
	        pChart.chartsize = CHART_LARGE;
	        pChart.sizeconfig = eval(l)[0];
	        break;
    };
	    
	url = pChart.charttype;
	
	
	if(pChart.yaxistype && pChart.yaxistype.toLocaleLowerCase() == ONOFF)
	{
	    if(pChart.showxaxisvalue == true && pChart.sizeconfig.showxaxisvalue == true)
	        pChart.sizeconfig.height = parseInt(pChart.sizeconfig.onoffheight) + CHART_XAXISCAPTIONHEIGHT;//ONOFFHEIGHT; // onoff graph height
	    else
	        pChart.sizeconfig.height = pChart.sizeconfig.onoffheight;
	        
    }
	
	// helps to buid all the fushion chart params
    flashvars = GetFlashVariables(pChart);
    
    // instantiates the fushion chart
    chart = new FusionCharts(url, chartid, pChart.sizeconfig.width, pChart.sizeconfig.height, "0", true);
    // sets the graph parm
	chart.setDataXML(flashvars);		   
    chart.render(pChart.div);
    chart = null;    
}

// builds the flashchart param
function GetFlashVariables(pChart)
{
    var flashvars;
    var stepfactor;
    
    flashvars  = "&chartWidth=";            flashvars += pChart.sizeconfig.width;
    flashvars += "&chartHeight=";           flashvars += pChart.sizeconfig.height;
    flashvars += "&dataXML=<chart ";
    //flashvars += "imageSave=";              flashvars += "'1' ";
    flashvars += "animation=";              flashvars += "'0' ";
    flashvars += "palette=";                flashvars += "'2' ";
    flashvars += "showFCMenuItem=";         flashvars += "'0' ";
    flashvars += "adjustDiv=";              flashvars += "'1' "; 
    
    flashvars += "defaultNumberScale=";     flashvars += "'' ";
    flashvars += "numberScaleValue=";       flashvars += "'1024,1024,1024,1024' ";
    flashvars += "numberScaleUnit='";       flashvars += "K,M,G,T' ";
    flashvars += "baseFontColor=";          flashvars += "'000000' ";
    flashvars += "baseFontSize=";           flashvars += "'" + pChart.sizeconfig.basefontsize + "' ";
    
    flashvars += "canvasBorderThickness=";  flashvars += "'1' ";
    flashvars += "chartBottomMargin=";      flashvars += "'10' ";
    flashvars += "chartLeftMargin=";        flashvars += "'10' ";
    
    flashvars += "yAxisValueDecimals=";     flashvars += "'3' ";
    flashvars += "decimals=";               flashvars += "'3' ";
    flashvars += "formatNumberScale=";      flashvars += "'1' ";
    flashvars += "seriesNameInToolTip=";    flashvars += "'1' ";
    
    flashvars += "numDisplaySets=";         flashvars += "'" +  pChart.numdisplaysets + "' ";
    
    stepfactor = parseInt(pChart.numdisplaysets)/CHART_DEFAULT_SHOW_X_AXIS_LABELS_COUNT;
    
    flashvars += "labelStep=";              flashvars += "'" +  stepfactor + "' ";
    flashvars += "rotateNames=";            flashvars += "'1' ";
    flashvars += "showLegend=";             flashvars += "'1' ";
    flashvars += "showRealTimeValue=";      flashvars += "'0' ";
    flashvars += "setAdaptiveYMin=";        flashvars += "'1' ";
    flashvars += "canvasBgColor=";          flashvars += "'DEEAF6, ADD6EC' ";
    flashvars += "bgColor=";                flashvars += "'DEEAF6, ADD6EC' ";
    
    
    flashvars += "slantLabels=";            flashvars += "'1' ";
    flashvars += "xAxisName=";              flashvars += "'' ";
    
    flashvars += "shownames=";              
    
    if(pChart.showxaxisvalue == true && pChart.sizeconfig.showxaxisvalue == true)
        flashvars += "'1' ";
    else
        flashvars += "'0' ";
    
    flashvars += "showLegend=";             flashvars += "'0' ";
    
    if(pChart.yaxistype && pChart.yaxistype.toLocaleLowerCase() == ONOFF)
    {
        flashvars += "numdivlines=";            flashvars += "'0' ";
        flashvars += "numVDivLines=";           flashvars += "'0' ";
    }
    else
    {
        flashvars += "numdivlines=";            flashvars += "'9' ";
        flashvars += "numVDivLines=";           flashvars += "'13' ";
    }
    
    flashvars += "yAxisName=";              
        
    if((pChart.barchart && pChart.barchart == true) ||
        (pChart.yaxistype && pChart.yaxistype.toLocaleLowerCase() == PERCENTAGE))
    {
        flashvars += "'%25age' "
        flashvars += "yAxisMaxValue=";      flashvars += "'100' ";
        flashvars += "yAxisMinValue=";      flashvars += "'0' ";
    }
    else if(pChart.yaxistype && pChart.yaxistype.toLocaleLowerCase() == ONOFF)
    {
        flashvars += "' ' "
        flashvars += "yAxisMaxValue=";      flashvars += "'2' ";
        flashvars += "yAxisMinValue=";      flashvars += "'0' ";
        flashvars += "yAxisValueDecimals=";   flashvars += "'0' ";
    }
    else if(pChart.uptime == true && pChart.isonvaluepersec == true)
        flashvars += "'Value/sec' ";
    else
        flashvars += "'Value' ";
        
    
    if(pChart.yaxistype && pChart.yaxistype.toLocaleLowerCase() == ONOFF)
    {
        pChart.sizeconfig.showyaxisvalues = 0;
        pChart.sizeconfig.anchorradius = pChart.sizeconfig.onoffanchorradius;
    }
    else
        pChart.sizeconfig.yaxispadding = pChart.sizeconfig.yaxispadding * 55/100; // make it 60%
    
    
    flashvars += "showYAxisValues=";    flashvars += "'"+ pChart.sizeconfig.showyaxisvalues+"' "
    flashvars += "yAxisNamePadding=";    flashvars += "'"+ pChart.sizeconfig.yaxispadding+"' "
    
    flashvars += "yAxisValueDecimals=";     flashvars += "'3' ";
    flashvars += "caption=";                flashvars += "'"; flashvars += pChart.caption; flashvars += "' >";
    flashvars += "<categories><category name='Initial Time'/></categories>";
    
    for(cnt = 0; cnt < pChart.dataset.length && cnt < LINELEN; cnt++)
    {
        flashvars += "<dataset ";
        
        if(pChart.yaxistype && pChart.yaxistype.toLocaleLowerCase() == ONOFF)
        {
            flashvars += "alpha=";          flashvars += "'1' ";
            flashvars += "anchorAlpha=";    flashvars += "'100' ";
            flashvars += "anchorSides=";    flashvars += "'20' ";
            flashvars += "anchorBgColor=";  flashvars += "'"; flashvars += ANCHORCOLOR[cnt]; flashvars += "' "; 
            flashvars += "color=";          flashvars += "'"; flashvars += ANCHORCOLOR[cnt]; flashvars += "' "; 
        }
        else
        {
            flashvars += "alpha=";          flashvars += "'100' ";
            flashvars += "anchorAlpha=";    flashvars += "'100' ";
            flashvars += "color=";          flashvars += "'"; flashvars += LINECOLOR[cnt]; flashvars += "' "; 
        }
        
        flashvars += "anchorRadius=";   flashvars += "'" + pChart.sizeconfig.anchorradius + "' ";
            
        flashvars += "lineThickness=";  flashvars += "'" + pChart.sizeconfig.linethickness + "' ";
        flashvars += "areaAlpha=";      flashvars += "'50' ";
        flashvars += "seriesName=";     flashvars += "'" + pChart.dataset[cnt] + "' ";
        flashvars += "showValues=";     flashvars += "'0' >";
        flashvars += "<set value=";     flashvars += "'' />";
        flashvars += "</dataset>";
    }
    
   flashvars += "</chart>";
    
    return flashvars;
}
function serialize(data) 
{
    var namevalue = "";
    for (var el in data) 
    {
        namevalue += "&" + escape(el) + "=" + escape(data[el]);
    }
    return namevalue.substring(1);
}

function unserialize(data) 
{
  var object = new Array();
  var pairs = data.split(/&/g);
  for (var i = 0; i < pairs.length; i++)
  {
    if (pairs[i].indexOf("=") > -1) 
    {
        object[unescape(pairs[i].substring(0, pairs[i].indexOf("=")))] = unescape(pairs[i].substring(pairs[i].indexOf("=") + 1));
    }
  }
  return object;
}
