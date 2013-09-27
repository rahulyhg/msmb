function Trim(nStr){return nStr.replace(/(^\s*)|(\s*$)/g, "");}
function fnPaste(){event.returnValue=false;}
function isNull(obj,msg){
	if(msg!="Password")
		obj1=Trim(obj.value);
	else
		obj1=obj.value;
	if (obj1==""){
		alert("Please enter the " +msg);
		obj.focus();
		return true;
	}else
		return false;
}
function notChecked1(obj,msg){
	checked = false;
	if(obj.length){
		for(i=0;i<obj.length;i++){
			if(obj[i].checked){
				checked = true;break;
			}
		}
	}else if(obj.checked)
		checked = true;
	if(!(checked)){
		alert("Please select "+msg);
		/*if(obj.length)
			obj[0].focus();
		else
			obj.focus();*/
		return true;
	}
}
function isLen(obj,siz,msg){
	if(msg!="Password")
		obj1=Trim(obj.value);
	else
		obj1=obj.value;
	if(obj1!=""){
		var strLen=obj.value;
		if(strLen.length < siz){
			alert(msg+" should be atleast " + siz + " characters");
			obj.focus();
			return true;  
		} 
	}else
		return false;
}


function fnChkNum1(obj) {
	
  	//exp1 = /[^0-9]/;
	exp = /[^0-9]/;	
	if (exp.test(obj.value)) {
		alert("Only numbers(0-9) are allowed");
		//obj.value = "";
		obj.focus();
		return true;
	} else {
		return false;	
	}
}

function fnChkNum2(obj,msg) {
	exp = /[^0-9]/;
	if (exp.test(obj.value)) {
		alert("Please enter valid " + msg);
		obj.value = "";
		obj.focus();
		return true;
	} else 
		return false;
}

function isSame(obj1,obj2,msg1,msg2){
	if((Trim(obj1.value))==(Trim(obj2.value))){
		alert(msg1+" is matched with the "+msg2);
		obj2.focus();
		return true;
	}else
		return false;
}	
function isNotSame(obj1,obj2,msg1,msg2){
	if((Trim(obj1.value))!=(Trim(obj2.value))){
		alert(msg1+" does not match");
		obj2.focus();
		return true;
	}else
		return false;
}	
function isCorrect(obj1,obj2,msg1,msg2){
	if((Trim(obj1.value)) >= (Trim(obj2.value))){
		alert(msg1+" should be less than "+msg2);
		obj2.focus();
		return true;
	}else
		return false;
}	
function isTxtareaNull(obj,msg){
	if(Trim(obj.innerText) == ""){
		alert("Please enter " + msg);
		obj.focus();
		return true;
	}else
		return false;
}
function isTxtareaLen(obj,msg){
	if(obj.innerHTML.length > 255){
		alert("Please enter below 256 characters in " + msg);
		obj.focus();
		return true;
	}else
		return false;
}
function notEmail(obj,msg){
	var exp=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
	if (!exp.test(obj.value)){
		alert("Please enter valid "+msg);
		obj.focus();
		return true;
	}else
		return false;
}
function notZipcode(obj,msg){
	exp = /[a-zA-Z|\d]-{1}/;
	if (!exp.test(obj.value)){
		alert("Please enter valid "+msg);
		obj.focus();
		return true;
	}else
		return false;
}
function notChecked(obj,msg){
	checked = false;
	if(obj.length){
		for(i=0;i<obj.length;i++){
			if(obj[i].checked){
				checked = true;break;
			}
		}
	}else if(obj.checked)
		checked = true;
	if(!(checked)){
		alert("Please select the "+msg);
		if(obj.length)
			obj[0].focus();
		else
			obj.focus();
		return true;
	}
}

function notSelected(obj,msg){
	if (obj.options[obj.selectedIndex].value == ""){
		alert("Please select the "+ msg);
		obj.focus();
		return true;
	}else
		return false;
}
function notImageFile(obj,msg){
	var exp = /^.+\.(jpg|gif|jpeg|JPG|JPEG|GIF)$/;
	if (!exp.test((obj.value).toLowerCase())){
		alert("Please choose jpg or gif file for "+msg);
		obj.focus();
		return true;
	}else
		return false;
}
function notJpgFile(obj,msg){
	var exp = /^.+\.(jpg|jpeg|JPG|JPEG)$/;
	if (!exp.test((obj.value).toLowerCase())){
		alert("Please choose jpg file for "+msg);
		obj.focus();
		return true;
	}else
		return false;
}

function notDocFile(obj,msg){
	if(Trim(obj.value)!=""){
		var exp = /^.+\.(DOC|doc|TXT|txt)$/;
		if (!exp.test((obj.value).toLowerCase())){
			alert("Please choose doc or txt file for "+msg);
			obj.value="";
			obj.focus();
			return true;
		}else
			return false;	
	}else
		return false;
}
function notPdfDocFile(obj,msg){
	var exp = /^.+\.(pdf|doc|PDF|DOC)$/;
	if (!exp.test((obj.value).toLowerCase())){
		alert("Please choose pdf or doc file for "+msg);
		obj.value="";
		obj.focus();
		return true;
	}else
		return false;
}
function notPdfFile(obj,msg){
	var exp = /^.+\.(pdf|PDF)$/;
	if (!exp.test((obj.value).toLowerCase())){
		alert("Please choose pdf file for "+msg);
		obj.value="";
		obj.focus();
		return true;
	}else
		return false;
}
function notPrice(obj,msg){
	exp = /^[\d]*[\.]{0,1}[\d]{1,2}$/;
	if (!exp.test(obj.value)){
		alert("Please enter valid "+msg);
		obj.focus();
		return true;
	}else
		return false;
}
function fnChkNum(obj,msg){
	exp = /^[\d]/;
	if (!exp.test(obj.value)){
		alert("Please enter only numeric values in "+msg);
		obj.focus();
		return true;
	}else
		return false;
}
function fnChkAlpha(obj,msg)
{
	exp = (/(^([a-z]|[A-Z]|["."]|[\s])*$)/);
	if (!exp.test(obj.value))
	{
		alert("Please enter only alphabets in "+msg);
		obj.focus();
		return true;
	}
	else
		return false;
}	

function fnChkAlphaNum(obj,msg){
	exp = (/(^([a-z]|[A-Z]|[0-9])*$)/);
	if (!exp.test(obj.value)){
		alert("Please enter only alphanumeric in "+msg);
		obj.focus();
		return true;
	}else
		return false;
}
function fnChkAlphaNumeric(obj,msg){
	var alpha = /[a-zA-Z|]/;
	var Num = /[\d]/;
	if (!(Alpha.test(obj.value) && Num.test(obj.value))){
		alert("Please enter only alphanumeric in "+msg);
		obj.focus();
		return true;
	}else
		return false;
}
function isEditorNull(obj,msg){
	strTmp = obj.value;
	StrContent=strTmp.split("<BODY>");
	StrContent=StrContent[1];
	StrContent=StrContent.split("</BODY>");
	StrContent=StrContent[0];
	strLength=StrContent.length;
	if (strLength==0){
		alert (msg);
		return true;
	}else
		return false;
}
function fnChkFolderName(){
	if(((window.event.keyCode < 48) || (window.event.keyCode > 57)) && ((window.event.keyCode < 65) || (window.event.keyCode > 90)) && ((window.event.keyCode < 97) || (window.event.keyCode > 122)) && (window.event.keyCode != 95)){
		alert("Only Alphabets(A-Z, a-z), Numbers(0-9) and Underscore(_) are allowed");
		window.event.keyCode = 0;
		return true;
	}
}
function GetCountry(defaultValue,isNotWithSelect){
	var sCountry="Afghanistan,Albania,Algeria,American Samoa,Andorra,Angola,Anguilla,Antarctica,Antigua and Barbuda,Argentina,Armenia,Aruba,Australia,Austria,Azerbaidjan,Bahamas,Bahrain,Bangladesh,Barbados,Belarus,Belgium,Belize,Benin,Bermuda,Bolivia,Bosnia-Herzegovina,Botswana,Bouvet Island,Brazil,British Indian O. Terr.,Brunei Darussalam,Bulgaria,Burkina Faso,Burundi,Bhutan,Cambodia,Cameroon,Canada,Cape Verde,Cayman Islands,Central African Rep.,Chad,Chile,China,Christmas Island,Cocos (Keeling) Isl.,Colombia,Comoros,Congo,Cook Islands,Costa Rica,Croatia,Cuba,Cyprus,Czech Republic,Czechoslovakia,Denmark,Djibouti,Dominica,Dominican Republic,East Timor,Ecuador,Egypt,El Salvador,Equatorial Guinea,Estonia,Ethiopia,Falkland Isl.(Malvinas),Faroe Islands,Fiji,Finland,France,France (European Ter.),French Southern Terr.,Gabon,Gambia,Georgia,Germany,Ghana,Gibraltar,Great Britain (UK),Greece,Greenland,Grenada,Guadeloupe (Fr.),Guam (US),Guatemala,Guinea,Guinea Bissau,Guyana,Guyana (Fr.),Haiti,Heard & McDonald Isl.,Honduras,Hong Kong,Hungary,Iceland,India,Indonesia,Iran,Iraq,Ireland,Israel,Italy,Ivory Coast,Jamaica,Japan,Jordan,Kazakhstan,Kenya,kyrgyzstan,Kiribati,Korea (North),Korea (South),Kuwait,Laos,Latvia,Lebanon,Lesotho,Liberia,Libya,Liechtenstein,Lithuania,Luxembourg,Macau,Madagascar,Malawi,Malaysia,Maldives,Mali,Malta,Marshall Islands,Martinique (Fr.),Mauritania,Mauritius,Mexico,Micronesia,Moldavia,Monaco,Mongolia,Montserrat,Morocco,Mozambique,Myanmar,Namibia,Nauru,Nepal,Netherland Antilles,Netherlands,Neutral Zone,New Caledonia (Fr.),New Zealand,Nicaragua,Niger,Nigeria,Niue,Norfolk Island,Northern Mariana Isl.,Norway,Oman,Pakistan,Palau,Panama,Papua New,Paraguay,Peru,Philippines,Pitcairn,Poland,Polynesia (Fr.),Portugal,Puerto Rico (US),Qatar,Reunion (Fr.),Romania,Russian Federation,Rwanda,Saint Lucia,Samoa,San Marino,Saudi Arabia,Senegal,Seychelles,Sierra Leone,Singapore,Slovak Republic,Slovenia,Solomon Islands,Somalia,South Africa,Spain,Sri Lanka,St. Helena,St. Pierre & Miquelon,St. Tome and Principe,St.Kitts Nevis Anguilla,St.Vincent & Grenadines,Sudan,Suriname,Svalbard & Jan Mayen Is,Swaziland,Sweden,Switzerland,Syria,Tadjikistan,Taiwan,Tanzania,Thailand,Togo,Tokelau,Tonga,Trinidad & Tobago,Tunisia,Turkey,Turkmenistan,Turks & Caicos Islands,Tuvalu,Uganda,Ukraine,United Arab Emirates,United Kingdom,United States,Uruguay,US Minor outlying Isl.,Uzbekistan,Vanuatu,Vatican City State,Venezuela,Vietnam,Virgin Islands (British)";
	var xCountry=sCountry.split(",");
	var str="";
	if (!isNotWithSelect)str+="<option value='' selected>Select Country</option>\n";else str+="<option value='' selected>Doesn't Matter</option>\n";
	for(i=0;i<xCountry.length; i++)
	if(xCountry[i]==defaultValue)str+="<option value='"+xCountry[i]+"' selected>"+xCountry[i]+"</option>\n";else str+="<option value='"+xCountry[i]+"'>"+xCountry[i]+"</option>\n";
	document.write(str);
}
function fnShowDate(obj,msg){
	var retdate=window.showModalDialog("includes/calender.htm","","dialogHeight: 219px; dialogWidth: 273px;  center: Yes; help: No; resizable: No; status: No;titlebar:No");
	obj.value=retdate;
}
	
function isNullMulti(obj,msg){
	if (Trim(obj.value)==""){
		alert("Please select the " + msg);
		obj.focus();
		return true;
	}else
		return false;
}
function fnProfile(v1){
	ref=window.open("employee_profile.php?Id="+v1,"Profile","Left=180, Top=90, height=500,width=650,toolbar=no,scrollbars=yes,menubar=no,resize=false");
}
function notJPGImageFile(obj,msg){
	var exp = /^.+\.(jpg|gif|GIF|jpeg|JPG|JPEG)$/;
	if (!exp.test((obj.value).toLowerCase())){
		alert("Please choose jpg/gif file for "+msg);
		obj.focus();
		return true;
	}else
		return false;
}
