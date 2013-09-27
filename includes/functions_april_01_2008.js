// JavaScript Document
// update the hidden form field so the popup calendar
// can pre-select the right date
		var st1 = 0;	
		
		function fnOpenEmail() {
			window.open("emailtofriend.php","Email","Left=30, Top=5, Height=700,width=625,toolbar=no,scrollbars=yes,menubar=no,resize=false");
		}
		
		function fnForward1() {
			
			f1 = document.proForm;			
			if(notChecked(f1.elements["chkPro[]"],"profiles to forward")) {
			} else {			
				f1.mode.value = "forward";
				//f1.action = "forward_profile.php?mode=forward";
				f1.submit();
			}
		}
		
		function selCitizenshipOthers() {
				
			f1 = document.thisForm;			
			if (f1.citizenship.value == 'Others') {
				document.getElementById("div_citizenship").style.display = 'block';
			} else {
				document.getElementById("div_citizenship").style.display = 'none';	
			}			
		}
		
		function selNationalityOthers() {
				
			f1 = document.thisForm;			
			if (f1.nationality.value == 'Others') {
				document.getElementById("div_nationality").style.display = 'block';
			} else {
				document.getElementById("div_nationality").style.display = 'none';	
			}			
		}		
		
		function fnCompare() {
			
			f1 = document.proForm;
			if(notChecked1(f1.elements["chkPro[]"],"more than one profiles to compare")) {
			} else {
				var j = 0;			
				for (i = 0; i < f1.elements["chkPro[]"].length; i++) {					
					if (f1.elements["chkPro[]"][i].checked == true) {						
						j++;
					}
				}
				if (j > 3) {
					alert("Please don't select more than 3 profiles to compare");	
				} else {
					if (j == 1)	{
						alert("Please select more than one profiles to compare");	
					} else {
						f1.mode.value = "compare";	
						//f1.action = "forward_profile.php?mode=compare";	
						f1.submit();
					}
				}
			}			
		}
		
		function fnBookmark() {
			
			f1 = document.proForm;
			if(notChecked(f1.elements["chkPro[]"],"profiles to bookmark")) {
			} else {				
				f1.mode.value = "bookmark";	
				//f1.action = "forward_profile.php?mode=compare";	
				f1.submit();					
			}			
		}
		
		function rem() {
			
			if (st1 == 0) {
				st1 = 1;
				document.thisForm.mydateD.options.length = document.thisForm.mydateD.options.length - 1;
				document.thisForm.mydateM.options.length = document.thisForm.mydateM.options.length - 1;
				document.thisForm.mydateY.options.length = document.thisForm.mydateY.options.length - 1;
			}				
		}
		
		function hasChildren() {
			
			f1 = document.thisForm;				
			if (f1.no_of_Children.value == "" || f1.no_of_Children.value == "None") {				
				for (j = 0; j < f1.childrenLivingStatus.length; j++) {
					f1.childrenLivingStatus[j].disabled = true;	
				}	
			} else {
				for (j = 0; j < f1.childrenLivingStatus.length; j++) {
					f1.childrenLivingStatus[j].disabled = false;	
				}	
			}
		}
		
		function ChangePrefix() {
			f1 = document.thisForm;
			for(i = 0; i < f1.gender.length; i++) {
				if (f1.gender[i].checked == true) {	
					if (f1.gender[i].value == "M") {
						document.getElementById("prefix").innerHTML = "M_";	
						f1.txtPrefix.value = "M_";
					} else {
						document.getElementById("prefix").innerHTML = "F_";	
						f1.txtPrefix.value = "M_";						
					}
				}
			}
		}
		
		function openHoroscope(action,id) {
			window.open('member_verify.php?action=' + action + '&id=' + id,'','width=600,height=458,scrollbars=1,status=yes,toolbar=yes,resizable=yes,top=20,left=50');	
		}
		
		function isMarried() {
			f1 = document.thisForm;				
			for(i = 0; i < f1.maritalStatus.length; i++) {
				if (f1.maritalStatus[i].checked) {	
					if (f1.maritalStatus[i].value == "Unmarried") {
						f1.no_of_Children.value="";
						f1.no_of_Children.disabled = true;
						for (j = 0; j < f1.childrenLivingStatus.length; j++) {
							f1.childrenLivingStatus[j].checked = false;
							f1.childrenLivingStatus[j].disabled = true;
						}	
					} else { 
						f1.no_of_Children.disabled = false;
					}
				}
			}			
		}
		
		function updateHiddenDate() {				
				
			var y = new String( mydate.getSelYear() );
			var m = padZero( mydate.getSelMonth() );
			var d = padZero( mydate.getSelDay() );			
			document.thisForm.mydateHid.value = y + '-' + m + '-' + d;				
		}
		
		// callback for the popup calendar
		function myCallback( year, month, day ) {
			// update the date selector boxes
			mydate.setDateParts( year, month, day );
		}
		
		function SetDefaultDate() {
			
			var opt = new Option();
			opt.value ="";
			opt.text = 'Date';
			opt.selected = true;
			document.thisForm.mydateD.options[document.thisForm.mydateD.options.length] = opt;
			var opt1 = new Option();
			opt1.value = "";
			opt1.text = 'Month';
			opt1.selected = true;
			document.thisForm.mydateM.options[document.thisForm.mydateM.options.length] = opt1;
			var opt2 = new Option();
			opt2.value = "";
			opt2.text = 'Year';
			opt2.selected = true;
			document.thisForm.mydateY.options[document.thisForm.mydateY.options.length] = opt2;
			document.thisForm.mydateD.value = "";
			document.thisForm.mydateM.value = "";
			document.thisForm.mydateY.value = "";
		}
		
		function DOB2Age() {
			
			f1 = document.thisForm; 
			year = f1.mydateY.value;
			month = f1.mydateM.value;
			date = f1.mydateD.value;			
			if ((f1.mydateD.value != "" && f1.mydateM.value != "") && (f1.mydateY.value != "")) {	
				var ajaxRequest; 						
				try {
					ajaxRequest = new XMLHttpRequest();
				} catch (e) {
					try {
						ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					} catch (e) {
						try{
							ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (e) {
							alert("Your browser does not support ajax!");
							return false;
						}
					}
				}
				ajaxRequest.onreadystatechange = function() {
					f1 = document.thisForm;	
					if (ajaxRequest.readyState == 4) {					
						result = ajaxRequest.responseText;							
						f1.age.value = Trim(result);						
					}
				}
				ajaxRequest.open("GET","includes/fill_religion_caste_ajax.php?action=DOB&year=" + year + "&month=" + month + "&date=" + date, true);
				ajaxRequest.send(null); 
			}
		}
		
		function PhotoManager(member_id) {
			window.open("image_view.php?memid="+member_id,'','width=565,height=690,scrollbars=yes,status=no,toolbar=no,top=0,left=0');
		}
		function GetLargeImage(id, path) {			
			document.getElementById(id).src = path;			
		}
		function GetUserImage(id, path, k, path1) {			
			document.getElementById(id).src = path;
			document.getElementById("img"+k).src = path1;				
		}	
		function GetUserImage1(id, path, k, path1) {			
			document.getElementById(id).src = path1;						
		}
		function occupation() {
				document.write("<option value=''>--Select--</option><option value='' disabled>---ADMIN---</option><option value='1'>Manager</option><option value='2'>Supervisors</option><option value='3'>Supervisors</option><option value='4'>Officer</option><option value='5'>Administrative Professional</option><option value='6'>Executive</option><option value='7'>Clerk</option><option value='' disabled>Manager</option><option value='8'>Agriculture & Farming Professional</option><option value='' disabled>----AIRLINE----</option><option value='9'>Pilot</option><option value='10'>Air Hostess</option><option value='11'>Airline Professional</option><option value='' disabled>----ARCHITECT & DESIGN----</option><option value='12'>Architect</option><option value='13'>Interior Designer</option><option value='' disabled>----BANKING & FINANCE----</option><option value='14'>Chartered Accountant</option><option value='15'>Company Secretary</option><option value='16'>Accounts / Finance Professional</option><option value='17'>Banking Service Professional</option><option value='18'>Auditor</option><option value='' disabled>----BEAUTY & FASHION----</option><option value='19'>Fashion Designer</option><option value='20'>Beautician</option><option value='' disabled>----CIVIL SERVICES----</option><option value='21'>Civil Services (IAS/IPS/IRS/IES/IFS)</option><option value='' disabled>----EDUCATION----</option><option value='22'>Professor / Lecturer</option><option value='23'>Teaching / Academician</option><option value='24'>Education Profession</option><option value='25'>College Student</option><option value='' disabled>----HOSPITALITY----</option><option value='26'>Hotel / Hospitality Professional</option><option value='' disabled>----IT & ENGINEERING----</option><option value='27'>Software Professional</option><option value='28'>Hardware Professional</option><option value='29'>Engineer – Non IT</option><option value='' disabled>----LEGAL----</option><option value='30'>Lawyer & Legal Professional</option><option value='' disabled>----LAW ENFORCEMENT----</option><option value='31'>Law Enforcement Officer</option><option value='' disabled>----MEDICAL----t</option><option value='32'>Doctor</option><option value='33'>Health Care Professional</option><option value='34'>Paramedical Professional</option><option value='35'>Nurse</option><option value='' disabled>----MEDIA & ENTERTAINMENT----</option><option value='36'>Journalist</option><option value='37'>Media Professional</option><option value='38'>Entertainment Professional</option><option value='39'>Event Management Professional</option><option value='40'>Advertising / PR Professional</option><option value='' disabled>----MERCHANT NAVY----</option><option value='41'>Mariner / Merchant Navy</option><option value='' disabled>----SCIENTIST----</option><option value='42'>Scientist / Researcher</option><option value='' disabled>----TOP MANAGEMENT----</option><option value='43'>CXO / President, Director, Chairman</option><option value='' disabled>----OTHERS----</option><option value='44'>Archakar</option><option value='45'>Arts & Craftsman</option><option value='46'>Central Government</option><option value='47'>Cheft</option><option value='48'>Consultantt</option><option value='49'>Customer Care Professional</option><option value='50'>Paster</option><option value='51'>Private Sector</option><option value='52'>Quality Control</option><option value='53'>Sales / Marketing</option><option value='54'>Self-Employed /  Business</option><option value='55'>Service / Customer Support</option><option value='56'>Social Worker</option><option value='57'>Sportsman</option><option value='58'>Technician</option><option value='59'>Shipping</option><option value='60'>State Government</option><option value='61'>Technical / Engineering</option><option value='62'>Unemployed</option><option value='63'>Others</option>");
		}
		/*function EducationCategory() {
				document.write("<option value='1'>Less than High School</option><option value='High School'>High School</option><option value='Higher Secondary'>Higher Secondary</option><option value='Diploma'>Diploma</option><option value='I.T.I'>-I.T.I</option><option value='Bachelors-Engineering/Computers'>Bachelors-Engineering/Computers</option><option value='Masters-Engineering/Computers'>Masters-Engineering/Computers</option><option value='Bachelors-Arts/Science/Commerce/Others'>Bachelors-Arts/Science/Commerce/Others</option><option value='Master-Arts/Science/Commerce/Others'>Master-Arts/Science/Commerce/Others</option><option value='Chartered Accountant'>Chartered Accountant</option><option value='Management-BBA/MBA/Others'>Management-BBA/MBA/Others</option><option value='Medicine-General/Dental/Surgeon/Others'>Medicine-General/Dental/Surgeon/Others</option><option value='A.M.I.E'>A.M.I.E</option><option value='ACS'>ACS</option><option value='Legal-BL/ML/LLB/LLM/Others'>Legal-BL/ML/LLB/LLM/Others</option><option value='Service-IAS/IPS/Others'>Service-IAS/IPS/Others</option><option value='PhD'>PhD</option><option value='Other'>Other</option><option value='None'>None</option>");
		}*/
		function CurrencyType() {
			document.write("<option value='' selected>- Select currency -</option><option value='Afghanistan - AFA'>Afghanistan - AFA</option><option value='Albania - ALL'>Albania - ALL</option><option value='Algeria - DZD'>Algeria - DZD</option><option value='American Samoa - USD'>American Samoa - USD</option><option value='Andorra - EUR'>Andorra - EUR</option><option value='Angola - AON'>Angola - AON</option><option value='Anguilla - XCD'>Anguilla - XCD</option><option value='Antarctica - XCD'>Antarctica - XCD</option><option value='Antigua and Barbuda - XCD'>Antigua and Barbuda - XCD</option><option value='Argentina - ARS'>Argentina - ARS</option><option value='Armenia - AMD'>Armenia - AMD</option><option value='Aruba - AWG'>Aruba - AWG</option><option value='Australia - AUD'>Australia - AUD</option><option value='Austria - EUR'>Austria - EUR</option><option value='Azerbaijan - AZM'>Azerbaijan - AZM</option><option value='Bahamas - BSD'>Bahamas - BSD</option><option value='Bahrain - BHD'>Bahrain - BHD</option><option value='Bangladesh - BDT'>Bangladesh - BDT</option><option value='Barbados - BBD'>Barbados - BBD</option><option value='Belarus - BYB'>Belarus - BYB</option><option value='Belgium - EUR'>Belgium - EUR</option><option value='Belize - BZD'>Belize - BZD</option><option value='Benin - XOF'>Benin - XOF</option><option value='Bermuda - BMD'>Bermuda - BMD</option><option value='Bhutan - BTN'>Bhutan - BTN</option><option value='Bolivia - BOB'>Bolivia - BOB</option><option value='Bosnia and Herzegovina - BAM'>Bosnia and Herzegovina - BAM</option><option value='Botswana - BWP'>Botswana - BWP</option><option value='Bouvet Island - NOK'>Bouvet Island - NOK</option><option value='Brazil - BRL'>Brazil - BRL</option><option value='British Indian Ocean Territory - USD'>British Indian Ocean Territory - USD</option><option value='British Virgin Islands - USD'>British Virgin Islands - USD</option><option value='Brunei - BND'>Brunei - BND</option><option value='Bulgaria - BGL'>Bulgaria - BGL</option><option value='Burkina Faso - XOF'>Burkina Faso - XOF</option><option value='Burundi - BIF'>Burundi - BIF</option><option value='Cambodia - KHR'>Cambodia - KHR</option><option value='Cameroon - XAF'>Cameroon - XAF</option><option value='Canada - CAD'>Canada - CAD</option><option value='Cape Verde - CVE'>Cape Verde - CVE</option><option value='Cayman Islands - KYD'>Cayman Islands - KYD</option><option value='Central African Republic - XAF'>Central African Republic - XAF</option><option value='Chad - XAF'>Chad - XAF</option><option value='Chile - CLP'>Chile - CLP</option><option value='China - CNY'>China - CNY</option><option value='Christmas Island - AUD'>Christmas Island - AUD</option><option value='Cocos Islands - AUD'>Cocos Islands - AUD</option><option value='Colombia - COP'>Colombia - COP</option><option value='Comoros - KMF'>Comoros - KMF</option><option value='Congo - XAF'>Congo - XAF</option><option value='Cook Islands - NZD'>Cook Islands - NZD</option><option value='Costa Rica - CRC'>Costa Rica - CRC</option><option value='Croatia - HRK'>Croatia - HRK</option><option value='Cuba - CUP'>Cuba - CUP</option><option value='Cyprus - CYP'>Cyprus - CYP</option><option value='Czech Republic - CZK'>Czech Republic - CZK</option><option value='Denmark - DKK'>Denmark - DKK</option><option value='Djibouti - DJF'>Djibouti - DJF</option><option value='Dominica - XCD'>Dominica - XCD</option><option value='Dominican Republic - DOP'>Dominican Republic - DOP</option><option value='East Timor - TPE'>East Timor - TPE</option><option value='Ecuador - ECS'>Ecuador - ECS</option><option value='Egypt - EGP'>Egypt - EGP</option><option value='El Salvador - SVC'>El Salvador - SVC</option><option value='Equatorial Guinea - XAF'>Equatorial Guinea - XAF</option><option value='Eritrea - ERN'>Eritrea - ERN</option><option value='Estonia - EEK'>Estonia - EEK</option><option value='Ethiopia - ETB'>Ethiopia - ETB</option><option value='Falkland Islands - FKP'>Falkland Islands - FKP</option><option value='Faroe Islands - DKK'>Faroe Islands - DKK</option><option value='Fiji - FJD'>Fiji - FJD</option><option value='Finland - EUR'>Finland - EUR</option><option value='France - EUR'>France - EUR</option><option value='French Guiana - EUR'>French Guiana - EUR</option><option value='French Polynesia - XPF'>French Polynesia - XPF</option><option value='French Southern Territories - EUR'>French Southern Territories - EUR</option><option value='Gabon - XAF'>Gabon - XAF</option><option value='Gambia - GMD'>Gambia - GMD</option><option value='Georgia - GEL'>Georgia - GEL</option><option value='Germany - EUR'>Germany - EUR</option><option value='Ghana - GHC'>Ghana - GHC</option><option value='Gibraltar - GIP'>Gibraltar - GIP</option><option value='Greece - EUR'>Greece - EUR</option><option value='Greenland - DKK'>Greenland - DKK</option><option value='Grenada - XCD'>Grenada - XCD</option><option value='Guadeloupe - EUR'>Guadeloupe - EUR</option><option value='Guam - USD'>Guam - USD</option><option value='Guatemala - QTQ'>Guatemala - QTQ</option><option value='Guinea - GNF'>Guinea - GNF</option><option value='Guinea-Bissau - GWP'>Guinea-Bissau - GWP</option><option value='Guyana - GYD'>Guyana - GYD</option><option value='Haiti - HTG'>Haiti - HTG</option><option value='Heard and McDonald Islands - AUD'>Heard and McDonald Islands - AUD</option><option value='Honduras - HNL'>Honduras - HNL</option><option value='Hong Kong - HKD'>Hong Kong - HKD</option><option value='Hungary - HUF'>Hungary - HUF</option><option value='Iceland - ISK'>Iceland - ISK</option><option value='India - Rs.' selected>India - Rs.</option><option value='Indonesia - IDR'>Indonesia - IDR</option><option value='Iran - IRR'>Iran - IRR</option><option value='Iraq - IQD'>Iraq - IQD</option><option value='Ireland - EUR'>Ireland - EUR</option><option value='Israel - ILS'>Israel - ILS</option><option value='Italy - EUR'>Italy - EUR</option><option value='Ivory Coast - XOF'>Ivory Coast - XOF</option><option value='Jamaica - JMD'>Jamaica - JMD</option><option value='Japan - JPY'>Japan - JPY</option><option value='Jordan - JOD'>Jordan - JOD</option><option value='Kazakhstan - KZT'>Kazakhstan - KZT</option><option value='Kenya - KES'>Kenya - KES</option><option value='Kiribati - AUD'>Kiribati - AUD</option><option value='Korea, North - KPW'>Korea, North - KPW</option><option value='Korea, South - KRW'>Korea, South - KRW</option><option value='Kuwait - KWD'>Kuwait - KWD</option><option value='Kyrgyzstan - KGS'>Kyrgyzstan - KGS</option><option value='Laos - LAK'>Laos - LAK</option><option value='Latvia - LVL'>Latvia - LVL</option><option value='Lebanon - LBP'>Lebanon - LBP</option><option value='Lesotho - LSL'>Lesotho - LSL</option><option value='Liberia - LRD'>Liberia - LRD</option><option value='Libya - LYD'>Libya - LYD</option><option value='Liechtenstein - CHF'>Liechtenstein - CHF</option><option value='Lithuania - LTL'>Lithuania - LTL</option><option value='Luxembourg - EUR'>Luxembourg - EUR</option><option value='Macau - MOP'>Macau - MOP</option><option value='Macedonia, Former Yugoslav Republic of - MKD'>Macedonia, Former Yugoslav Republic of - MKD</option><option value='Madagascar - MGF'>Madagascar - MGF</option><option value='Malawi - MWK'>Malawi - MWK</option><option value='Malaysia - MYR'>Malaysia - MYR</option><option value='Maldives - MVR'>Maldives - MVR</option><option value='Mali - XOF'>Mali - XOF</option><option value='Malta - MTL'>Malta - MTL</option><option value='Marshall Islands - USD'>Marshall Islands - USD</option><option value='Martinique - EUR'>Martinique - EUR</option><option value='Mauritania - MRO'>Mauritania - MRO</option><option value='Mauritius - MUR'>Mauritius - MUR</option><option value='Mayotte - EUR'>Mayotte - EUR</option><option value='Mexico - MXN'>Mexico - MXN</option><option value='Micronesia, Federated States of - USD'>Micronesia, Federated States of - USD</option><option value='Moldova - MDL'>Moldova - MDL</option><option value='Monaco - EUR'>Monaco - EUR</option><option value='Mongolia - MNT'>Mongolia - MNT</option><option value='Montserrat - XCD'>Montserrat - XCD</option><option value='Morocco - MAD'>Morocco - MAD</option><option value='Mozambique - MZM'>Mozambique - MZM</option><option value='Myanmar - MMK'>Myanmar - MMK</option><option value='Namibia - NAD'>Namibia - NAD</option><option value='Nauru - AUD'>Nauru - AUD</option><option value='Nepal - NPR'>Nepal - NPR</option><option value='Netherlands - EUR'>Netherlands - EUR</option><option value='Netherlands Antilles - ANG'>Netherlands Antilles - ANG</option><option value='New Caledonia - XPF'>New Caledonia - XPF</option><option value='New Zealand - NZD'>New Zealand - NZD</option><option value='Nicaragua - NIC'>Nicaragua - NIC</option><option value='Niger - XOF'>Niger - XOF</option><option value='Nigeria - NGN'>Nigeria - NGN</option><option value='Niue - NZD'>Niue - NZD</option><option value='Norfolk Island - AUD'>Norfolk Island - AUD</option><option value='Northern Mariana Islands - USD'>Northern Mariana Islands - USD</option><option value='Norway - NOK'>Norway - NOK</option><option value='Oman - OMR'>Oman - OMR</option><option value='Pakistan - PKR'>Pakistan - PKR</option><option value='Palau - USD'>Palau - USD</option><option value='Panama - PAB'>Panama - PAB</option><option value='Papua New Guinea - PGK'>Papua New Guinea - PGK</option><option value='Paraguay - PYG'>Paraguay - PYG</option><option value='Peru - PEN'>Peru - PEN</option><option value='Philippines - PHP'>Philippines - PHP</option><option value='Pitcairn Island - NZD'>Pitcairn Island - NZD</option><option value='Poland - PLZ'>Poland - PLZ</option><option value='Portugal - EUR'>Portugal - EUR</option><option value='Puerto Rico - USD'>Puerto Rico - USD</option><option value='Qatar - QAR'>Qatar - QAR</option><option value='Reunion - EUR'>Reunion - EUR</option><option value='Romania - ROL'>Romania - ROL</option><option value='Russia - RUR'>Russia - RUR</option><option value='Rwanda - RWF'>Rwanda - RWF</option><option value='S. Georgia and S. Sandwich Isls. - GBP'>S. Georgia and S. Sandwich Isls. - GBP</option><option value='Saint Kitts & Nevis - XCD'>Saint Kitts & Nevis - XCD</option><option value='Saint Lucia - XCD'>Saint Lucia - XCD</option><option value='Saint Vincent and The Grenadines - XCD'>Saint Vincent and The Grenadines - XCD</option><option value='Samoa - WST'>Samoa - WST</option><option value='San Marino - ITL'>San Marino - ITL</option><option value='Sao Tome and Principe - STD'>Sao Tome and Principe - STD</option><option value='Saudi Arabia - SAR'>Saudi Arabia - SAR</option><option value='Senegal - XOF'>Senegal - XOF</option><option value='Seychelles - SCR'>Seychelles - SCR</option><option value='Sierra Leone - SLL'>Sierra Leone - SLL</option><option value='Singapore - SGD'>Singapore - SGD</option><option value='Slovakia - SKK'>Slovakia - SKK</option><option value='Slovenia - SIT'>Slovenia - SIT</option><option value='Somalia - SOD'>Somalia - SOD</option><option value='South Africa - ZAR'>South Africa - ZAR</option><option value='Spain - EUR'>Spain - EUR</option><option value='Sri Lanka - LKR'>Sri Lanka - LKR</option><option value='St. Helena - '>St. Helena - </option><option value='St. Pierre and Miquelon - EUR'>St. Pierre and Miquelon - EUR</option><option value='Sudan - SDD'>Sudan - SDD</option><option value='Suriname - SRG'>Suriname - SRG</option><option value='Svalbard and Jan Mayen Islands - NOK'>Svalbard and Jan Mayen Islands - NOK</option><option value='Swaziland - SZL'>Swaziland - SZL</option><option value='Sweden - SEK'>Sweden - SEK</option><option value='Switzerland - CHF'>Switzerland - CHF</option><option value='Syria - SYP'>Syria - SYP</option><option value='Taiwan - TWD'>Taiwan - TWD</option><option value='Tajikistan - TJR'>Tajikistan - TJR</option><option value='Tanzania - TZS'>Tanzania - TZS</option><option value='Thailand - THB'>Thailand - THB</option><option value='Togo - XOF'>Togo - XOF</option><option value='Tokelau - NZD'>Tokelau - NZD</option><option value='Tonga - TOP'>Tonga - TOP</option><option value='Trinidad and Tobago - TTD'>Trinidad and Tobago - TTD</option><option value='Tunisia - TND'>Tunisia - TND</option><option value='Turkey - TRL'>Turkey - TRL</option><option value='Turkmenistan - TMM'>Turkmenistan - TMM</option><option value='Turks and Caicos Islands - USD'>Turks and Caicos Islands - USD</option><option value='Tuvalu - AUD'>Tuvalu - AUD</option><option value='Uganda - UGS'>Uganda - UGS</option><option value='Ukraine - UAG'>Ukraine - UAG</option><option value='United Arab Emirates - AED'>United Arab Emirates - AED</option><option value='United Kingdom - GBP'>United Kingdom - GBP</option><option value='United States of America - USD'>United States of America - USD</option><option value='Uruguay - UYP'>Uruguay - UYP</option><option value='Uzbekistan - UZS'>Uzbekistan - UZS</option><option value='Vanuatu - VUV'>Vanuatu - VUV</option><option value='Vatican City - EUR'>Vatican City - EUR</option><option value='Venezuela - VUB'>Venezuela - VUB</option><option value='Vietnam - VND'>Vietnam - VND</option><option value='Virgin Islands - USD'>Virgin Islands - USD</option><option value='Wallis and Futuna Islands - XPF'>Wallis and Futuna Islands - XPF</option><option value='Western Sahara - MAD'>Western Sahara - MAD</option><option value='Yemen - YER'>Yemen - YER</option><option value='Yugoslavia (Former) - YUN'>Yugoslavia (Former) - YUN</option><option value='Zaire - CDF'>Zaire - CDF</option><option value='Zambia - ZMK'>Zambia - ZMK</option><option value='Zimbabwe - ZWD'>Zimbabwe - ZWD</option>");	 	
		}
		
		function Language1() { 
			document.write("<option value='Aka'>Aka</option><option value='Arabic'>Arabic</option><option value='Arunachali'>Arunachali</option><option value='Assamese'>Assamese</option><option value='Awadhi'>Awadhi</option><option value='Baluchi'>Baluchi</option><option value='Bengali'>Bengali</option><option value='Bhojpuri'>Bhojpuri</option><option value='Bhutia'>Bhutia</option><option value='Bihari'>Bihari</option><option value='Brahui'>Brahui</option><option value='Brij'>Brij</option><option value='Burmese'>Burmese</option><option value='Chattisgarhi'>Chattisgarhi</option><option value='Chinese'>Chinese</option><option value='Coorgi'>Coorgi</option><option value='Dogri'>Dogri</option><option value='English'>English</option><option value='French'>French</option><option value='Garhwali'>Garhwali</option><option value='Garo'>Garo</option><option value='Gujarati'>Gujarati</option><option value='Haryanavi'>Haryanavi</option><option value='Himachali/Pahar'>Himachali/Pahar</option><option value='Hindi'>Hindi</option><option value='Hindko'>Hindko</option><option value='Kakbark'>Kakbark</option><option value='Kanauji'>Kanauji</option><option value='Kannada'>Kannada</option><option value='KashmiriL'>Kashmiri</option><option value='Khandesi'>Khandesi</option><option value='Khasi'>Khasi</option><option value='Konkani'>Konkani</option><option value='Koshali'>Koshali</option><option value='Kumaoni'>Kumaoni</option><option value='Kutchi'>Kutchi</option><option value='Ladacki'>Ladacki</option><option value='Lepcha'>Lepcha</option><option value='Magahi'>Magahi</option><option value='Maithili'>Maithili</option><option value='Malay'>Malay</option><option value='Malayalam'>Malayalam</option><option value='Manipuri'>Manipuri</option><option value='Marathi'>Marathi</option><option value='Marwari'>Marwari</option><option value='Miji'>Miji</option><option value='Mizo'>Mizo</option><option value='Monpa'>Monpa</option><option value='Nicobarese'>Nicobarese</option><option value='Nepali'>Nepali</option><option value='Oriya'>Oriya</option><option value='Pashto'>Pashto</option><option value='Persian'>Persian</option><option value='Punjabi'>Punjabi</option><option value='Rajasthani'>Rajasthani</option><option value='Russian'>Russian</option><option value='Sanskrit'>Sanskrit</option><option value='Santhali'>Santhali</option><option value='Seraiki'>Seraiki</option><option value='Sindhi'>Sindhi</option><option value='Sourashtra'>Sourashtra</option><option value='Sourashtra'>Sourashtra</option><option value='Sourashtra'>Sourashtra</option><option value='Sinhala'>Sinhala</option><option value='Spanish'>Spanish</option><option value='Swedish'>Swedish</option><option value='Tagalog'>Tagalog</option><option value='Tamil'>Tamil</option><option value='Telugu'>Telugu</option><option value='Tripuri'>Tripuri</option><option value='Tulu'>Tulu</option><option value='Urdu'>Urdu</option><option value='Other'>Other</option>");
		}
		
		function Language() { 
			document.write("<option value='' selected>- Select -</option><option value='Aka'>Aka</option><option value='Arabic'>Arabic</option><option value='Arunachali'>Arunachali</option><option value='Assamese'>Assamese</option><option value='Awadhi'>Awadhi</option><option value='Baluchi'>Baluchi</option><option value='Bengali'>Bengali</option><option value='Bhojpuri'>Bhojpuri</option><option value='Bhutia'>Bhutia</option><option value='Bihari'>Bihari</option><option value='Brahui'>Brahui</option><option value='Brij'>Brij</option><option value='Burmese'>Burmese</option><option value='Chattisgarhi'>Chattisgarhi</option><option value='Chinese'>Chinese</option><option value='Coorgi'>Coorgi</option><option value='Dogri'>Dogri</option><option value='English'>English</option><option value='French'>French</option><option value='Garhwali'>Garhwali</option><option value='Garo'>Garo</option><option value='Gujarati'>Gujarati</option><option value='Haryanavi'>Haryanavi</option><option value='Himachali/Pahar'>Himachali/Pahar</option><option value='Hindi'>Hindi</option><option value='Hindko'>Hindko</option><option value='Kakbark'>Kakbark</option><option value='Kanauji'>Kanauji</option><option value='Kannada'>Kannada</option><option value='KashmiriL'>Kashmiri</option><option value='Khandesi'>Khandesi</option><option value='Khasi'>Khasi</option><option value='Konkani'>Konkani</option><option value='Koshali'>Koshali</option><option value='Kumaoni'>Kumaoni</option><option value='Kutchi'>Kutchi</option><option value='Ladacki'>Ladacki</option><option value='Lepcha'>Lepcha</option><option value='Magahi'>Magahi</option><option value='Maithili'>Maithili</option><option value='Malay'>Malay</option><option value='Malayalam'>Malayalam</option><option value='Manipuri'>Manipuri</option><option value='Marathi'>Marathi</option><option value='Marwari'>Marwari</option><option value='Miji'>Miji</option><option value='Mizo'>Mizo</option><option value='Monpa'>Monpa</option><option value='Nicobarese'>Nicobarese</option><option value='Nepali'>Nepali</option><option value='Oriya'>Oriya</option><option value='Pashto'>Pashto</option><option value='Persian'>Persian</option><option value='Punjabi'>Punjabi</option><option value='Rajasthani'>Rajasthani</option><option value='Russian'>Russian</option><option value='Sanskrit'>Sanskrit</option><option value='Santhali'>Santhali</option><option value='Seraiki'>Seraiki</option><option value='Sindhi'>Sindhi</option><option value='Sourashtra'>Sourashtra</option><option value='Sourashtra'>Sourashtra</option><option value='Sourashtra'>Sourashtra</option><option value='Sinhala'>Sinhala</option><option value='Spanish'>Spanish</option><option value='Swedish'>Swedish</option><option value='Tagalog'>Tagalog</option><option value='Tamil'>Tamil</option><option value='Telugu'>Telugu</option><option value='Tripuri'>Tripuri</option><option value='Tulu'>Tulu</option><option value='Urdu'>Urdu</option><option value='Other'>Other</option>");
		}
		
		function selState1() {	
			
			f1 = document.thisForm;
			f1.residingState.length = 1;
			f1.residingCity.length = 1;			
			k = 1;
			
			if (f1.residingCountry.value != 'Others') {
				document.getElementById("div_residingCountry_1").style.display = "none";	
				for (i = 0; i < f1.country_vs_state1.length; i++) {					
					if (f1.country_vs_state1.options[i].text == f1.residingCountry.value) {					
						var opt = new Option();
						opt.value = f1.country_vs_state.options[i].value;
						opt.text = f1.country_vs_state.options[i].text;							
						f1.residingState.options[k] = opt;
						k++;
					}
				}
				var opt = new Option();
				opt.value = "Others";
				opt.text = "Others";							
				f1.residingState.options[k] = opt;
				
				var opt = new Option();
				opt.value = "Others";
				opt.text = "Others";							
				f1.residingCity.options[k] = opt;
				
				if (document.getElementById("div_residingState_1").style.display == "block") {
					f1.residingState.value = "Others";
				}
				if (document.getElementById("div_residingCity_1").style.display == "block") {
					f1.residingCity.value = "Others";
				}
				
			} else {
				var opt = new Option();
				opt.value = "Others";
				opt.text = "Others";							
				f1.residingState.options[k] = opt;
				var opt = new Option();
				opt.value = "Others";
				opt.text = "Others";							
				f1.residingCity.options[k] = opt;
				document.getElementById("div_residingCountry_1").style.display = "block";	
			}
		}
		
		function selState() {
			
			f1 = document.thisForm;
			f1.state.length = 1;
			f1.city.length = 1;			
			if (f1.country.value != 'Others') {
				document.getElementById("div_country_1").style.display = "none";
				//document.getElementById("div_state_1").style.display = "none";
				//document.getElementById("div_city_1").style.display = "none";
				
				k = 1;	
				for (i = 0; i < f1.country_vs_state1.length; i++) {					
					if (f1.country_vs_state1.options[i].text == f1.country.value) {					
						var opt = new Option();
						opt.value = f1.country_vs_state.options[i].value;
						opt.text = f1.country_vs_state.options[i].text;							
						f1.state.options[k] = opt;
						k++;
					}
				}
				var opt = new Option();
				opt.value = "Others";
				opt.text = "Others";							
				f1.state.options[k] = opt;
				var opt = new Option();
				opt.value = "Others";
				opt.text = "Others";							
				f1.city.options[k] = opt;
				
				if (document.getElementById("div_state_1").style.display == "block") {
					f1.state.value = "Others";
				}
				if (document.getElementById("div_city_1").style.display == "block") {
					f1.city.value = "Others";
				}
				
			} else {
				var opt = new Option();
				opt.value = "Others";
				opt.text = "Others";							
				f1.state.options[1] = opt;
				var opt = new Option();
				opt.value = "Others";
				opt.text = "Others";							
				f1.city.options[1] = opt;
				document.getElementById("div_country_1").style.display = "block";				
			}
		}
		
		function selCity() {
			
			f1 = document.thisForm;
			f1.city.length = 1;			
			k = 1;
			if (f1.state.value != 'Others') {
				document.getElementById("div_state_1").style.display = "none";	
				for (i = 0; i < f1.state_vs_city1.length; i++) {					
					if (f1.state_vs_city1.options[i].text == f1.state.value) {					
						var opt = new Option();
						opt.value = f1.state_vs_city.options[i].value;
						opt.text = f1.state_vs_city.options[i].text;							
						f1.city.options[k] = opt;
						k++;
					}
				}
				var opt = new Option();
				opt.value = "Others";
				opt.text = "Others";						
				f1.city.options[k] = opt;
				
				if (document.getElementById("div_city_1").style.display == "block") {
					f1.city.value = "Others";
				}
				
			} else {
				var opt = new Option();
				opt.value = "Others";
				opt.text = "Others";							
				f1.city.options[1] = opt;
				document.getElementById("div_state_1").style.display = "block";	
			}
		}
		
		function selCity1() {
			
			f1 = document.thisForm;
			f1.residingCity.length = 1;	
			k = 1;
			if (f1.residingState.value != 'Others') {
				
				document.getElementById("div_residingState_1").style.display = "none";	
				for (i = 0; i < f1.state_vs_city1.length; i++) {					
					if (f1.state_vs_city1.options[i].text == f1.residingState.value) {					
						var opt = new Option();
						opt.value = f1.state_vs_city.options[i].value;
						opt.text = f1.state_vs_city.options[i].text;							
						f1.residingCity.options[k] = opt;
						k++;
					}
				}				
				var opt = new Option();
				opt.value = "Others";
				opt.text = "Others";							
				f1.residingCity.options[k] = opt;
				
				if (document.getElementById("div_residingCity_1").style.display == "block") {
					f1.residingCity.value = "Others";
				}
				
			} else {
				
				var opt = new Option();
				opt.value = "Others";
				opt.text = "Others";				
				f1.residingCity.options[k] = opt;				
				document.getElementById("div_residingState_1").style.display = "block";
			}
		}
		
		function selCityOthers() {
			
			f1 = document.thisForm;			
			if (f1.city.value == "Others") {
				document.getElementById("div_city_1").style.display = "block";	
			} else {
				document.getElementById("div_city_1").style.display = "none";	
			}
		}
		
		function selCityOthers1() {
			
			f1 = document.thisForm;			
			if (f1.residingCity.value == "Others") {
				document.getElementById("div_residingCity_1").style.display = "block";	
			} else {
				document.getElementById("div_residingCity_1").style.display = "none";	
			}
		}
			
		
		function SelectCaste() {
			f1 = document.thisForm;
			f1.caste.length = 1;
			var opt = new Option();						
			opt.value = "";	
			opt.text = "Caste no bar";
			f1.caste.options[1] = opt;
			j = 2;			
			for (i = 0; i < f1.religion_vs_caste.length; i++) {
				if (f1.religion_vs_caste.options[i].text == f1.religion.value) {
					var opt = new Option();						
				   	opt.value = f1.religion_vs_caste.options[i].value;	
					opt.text = f1.religion_vs_caste.options[i].value;
					f1.caste.options[j] = opt;
					j++;
				}
			}
		}
		
		function SelectSearchCaste_Search() {
			
			f1 = document.thisForm;
			f1.caste.length = 1;
			var opt = new Option();						
			opt.value = "";	
			opt.text = "Caste no bar";
			f1.caste.options[1] = opt;
			j = 2;			
			for (i = 0; i < f1.religion_vs_caste.length; i++) {
				if (f1.religion_vs_caste.options[i].text == f1.religion.value) {
					var opt = new Option();						
				   	opt.value = f1.caste_vs_caste.options[i].value;	
					opt.text = f1.religion_vs_caste.options[i].value;
					f1.caste.options[j] = opt;
					j++;
				}
			}
		}
		
		function selMultipleDomainCaste_Search() { 
		
			f1 = document.thisForm;
			f1.caste.length = 1;
			var opt = new Option();						
			opt.value = "";	
			opt.text = "Caste no bar";
			f1.caste.options[1] = opt;						
			k = 2;
			for (i = 0; i < f1.domain_vs_religion.length; i++) {				
				if (f1.domain_vs_religion.options[i].text == f1.domain.value) {						
					for (j = 0; j < f1.domain_vs_religion1.length; j++) {
						if (f1.domain_vs_religion1.options[j].value == f1.domain_vs_religion.options[i].value) {	
							for (l = 0; l < f1.religion_vs_caste.length; l++) {
								if (f1.religion_vs_caste.options[l].text == f1.domain_vs_religion1.options[j].value) {
									var opt = new Option();						
									opt.value = f1.caste_vs_caste.options[l].value;	
									opt.text = f1.religion_vs_caste.options[l].value;
									f1.caste.options[k] = opt;
									k++;
								}
							}
						}
					}
				}
			}
		}
		
		function SelectSearchCaste() {
			
			f1 = document.searchForm;
			f1.caste.length = 1;
			var opt = new Option();						
			opt.value = "";	
			opt.text = "Caste no bar";
			f1.caste.options[1] = opt;
			j = 2;			
			for (i = 0; i < f1.religion_vs_caste.length; i++) {
				if (f1.religion_vs_caste.options[i].text == f1.religion.value) {
					var opt = new Option();						
				   	opt.value = f1.caste_vs_caste.options[i].value;	
					opt.text = f1.religion_vs_caste.options[i].value;
					f1.caste.options[j] = opt;
					j++;
				}
			}
		}
		
		function selMultipleDomainCaste1() {
			
			f1 = document.searchForm;			
			f1.caste.length = 0;
			if (f1.domain.value != "") {
				
				var opt = new Option();						
				opt.value = "";	
				opt.text = "Any";
				f1.caste.options[0] = opt;
				var opt = new Option();						
				opt.value = "";	
				opt.text = "Caste no bar";
				f1.caste.options[1] = opt;
				
				var ajaxRequest; 
				var val = 0;
				val = f1.domain.value;						
				if (val == "") { val = 0; }	
				var result;
				var newOption;
				try {
					ajaxRequest = new XMLHttpRequest();
				} catch (e) {
					try {
						ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					} catch (e) {
						try{
							ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (e) {
							alert("Your browser does not support ajax!");
							return false;
						}
					}
				}
				ajaxRequest.onreadystatechange = function() {
					
					f1 = document.searchForm;	
					if (ajaxRequest.readyState == 4) {					
						result = ajaxRequest.responseText;
						
						string1 = result.split("/");							
						
						//remove the previous items
						var len = f1.caste.length;
						
						for ( var i = 0; i < string1.length - 1; i++) {						
							string2 = string1[i].split("_");						
							newOption = document.createElement("OPTION");					
							f1.caste.options.add(newOption);
							newOption.text = string2[1];
							newOption.value = string2[0];
							//alert(f1.elements["partnerReligion[]"][i].value);
						}//for i						
					}
				}
				ajaxRequest.open("GET","includes/fill_religion_caste_ajax.php?action=GetCaste2&domainid=" + val, true);
				ajaxRequest.send(null);
			}
		}	
		
		function GetCaste_Ajax(religion,caste1) {
			
			f1 = document.thisForm;			
			f1.caste.length = 1;
			if (religion != "") {
				
				var ajaxRequest; 
				var val = 0;
				val = religion;						
				if (val == "") { val = 0; }	
				var result;
				var newOption;
				try {
					ajaxRequest = new XMLHttpRequest();
				} catch (e) {
					try {
						ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					} catch (e) {
						try{
							ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (e) {
							alert("Your browser does not support ajax!");
							return false;
						}
					}
				}
				ajaxRequest.onreadystatechange = function() {
					
					f1 = document.thisForm;	
					if (ajaxRequest.readyState == 4) {					
						result = ajaxRequest.responseText;					
						string1 = result.split("/");
										
						for ( var i = 0; i < string1.length - 1; i++) {						
							string2 = string1[i].split("_");						
							newOption = document.createElement("OPTION");					
							f1.caste.options.add(newOption);
							newOption.text = string2[1];
							newOption.value = string2[0];
							//alert(f1.elements["partnerReligion[]"][i].value);
						}//for i												
						
						if (caste1) {								
							f1.caste.value = caste1;						
						}
					}					
				}
				ajaxRequest.open("GET","includes/fill_religion_caste_ajax.php?action=GetCaste3&religionid=" + religion, true);
				ajaxRequest.send(null);
			}
			
		}

		
		function selMultipleDomainCaste_Search1() {	
		
			f1 = document.thisForm;			
			f1.caste.length = 0;
			if (f1.domain.value != "") {
				
				var opt = new Option();						
				opt.value = "";	
				opt.text = "Any";
				f1.caste.options[0] = opt;
				var opt = new Option();						
				opt.value = "";	
				opt.text = "Caste no bar";
				f1.caste.options[1] = opt;
				
				var ajaxRequest; 
				var val = 0;
				val = f1.domain.value;						
				if (val == "") { val = 0; }	
				var result;
				var newOption;
				try {
					ajaxRequest = new XMLHttpRequest();
				} catch (e) {
					try {
						ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					} catch (e) {
						try{
							ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (e) {
							alert("Your browser does not support ajax!");
							return false;
						}
					}
				}
				ajaxRequest.onreadystatechange = function() {
					
					f1 = document.thisForm;	
					if (ajaxRequest.readyState == 4) {					
						result = ajaxRequest.responseText;
						
						string1 = result.split("/");							
						
						//remove the previous items
						var len = f1.caste.length;
						
						for ( var i = 0; i < string1.length - 1; i++) {						
							string2 = string1[i].split("_");						
							newOption = document.createElement("OPTION");					
							f1.caste.options.add(newOption);
							newOption.text = string2[1];
							newOption.value = string2[0];
							//alert(f1.elements["partnerReligion[]"][i].value);
						}//for i						
					}
				}
				ajaxRequest.open("GET","includes/fill_religion_caste_ajax.php?action=GetCaste2&domainid=" + val, true);
				ajaxRequest.send(null);
			}
		}
		
		function selMultipleDomainCaste() {
			
			f1 = document.searchForm;
			f1.caste.length = 1;
			var opt = new Option();						
			opt.value = "";	
			opt.text = "Caste no bar";
			f1.caste.options[1] = opt;						
			k = 2;
			for (i = 0; i < f1.domain_vs_religion.length; i++) {				
				if (f1.domain_vs_religion.options[i].text == f1.domain.value) {						
					for (j = 0; j < f1.domain_vs_religion1.length; j++) {
						if (f1.domain_vs_religion1.options[j].value == f1.domain_vs_religion.options[i].value) {	
							for (l = 0; l < f1.religion_vs_caste.length; l++) {
								if (f1.religion_vs_caste.options[l].text == f1.domain_vs_religion1.options[j].value) {
									var opt = new Option();						
									opt.value = f1.caste_vs_caste.options[l].value;	
									opt.text = f1.religion_vs_caste.options[l].value;
									f1.caste.options[k] = opt;
									k++;
								}
							}
						}
					}
				}
			}
		}
		
		function FillSelectedDomain() {
			
			f1 = document.thisForm;	
			//remove the previous items
			var len = f1.elements["partnerDomain[]"].length;
			for ( var k = len; k > 0; k--) {
				f1.elements["partnerDomain[]"].remove(k);
			}
			for(i = 0; i <  f1.elements["partnerDomain1[]"].length; i++) {
				if (f1.elements["partnerDomain1[]"][i].selected) {
													
					newOption = document.createElement("OPTION");						
					f1.elements["partnerDomain[]"].options.add(newOption);					
					newOption.text = f1.elements["partnerDomain1[]"][i].text;
					newOption.value = f1.elements["partnerDomain1[]"][i].value;		
					
				}
			}
		}	
		
		function RemoveSelectedDomain() {
			
			f1 = document.thisForm;			
		}
		
		function selPartnerInidanState() {
			
			f1 = document.thisForm;
			f1.elements["partnerResidingState[]"].length = 0;
			f1.elements["partnerResidingCity[]"].length = 0;
			var val;
			for (i = 0; i <  f1.elements["partnerResidingCountry[]"].length; i++) {
				if (f1.elements["partnerResidingCountry[]"][i].selected && f1.elements["partnerResidingCountry[]"][i].text == "India") {
					val = f1.elements["partnerResidingCountry[]"][i].text;
					break;
				}
			}
			if (val == "India") {
				for ( i = 0; i < f1.india_vs_state.length; i++) {
					newOption = document.createElement("OPTION");
					f1.elements["partnerResidingState[]"].options.add(newOption);
					newOption.text = f1.india_vs_state.options[i].text;
					newOption.value = f1.india_vs_state.options[i].value;
				} //for i
			}
		}
		
		function selPartnerInidanState1() {
			
			f1 = document.thisForm;
			f1.elements["partnerResidingState[]"].length = 0;
			f1.elements["partnerResidingCity[]"].length = 0;
			
			var val;
			for (i = 0; i <  f1.elements["partnerCountryLiving[]"].length; i++) {
				if (f1.elements["partnerCountryLiving[]"][i].selected && f1.elements["partnerCountryLiving[]"][i].text == "India") {
					val = f1.elements["partnerCountryLiving[]"][i].text;
					break;
				}
			}			
			if (val == "India") {
				for ( i = 0; i < f1.india_vs_state.length; i++) {
					newOption = document.createElement("OPTION");
					f1.elements["partnerResidingState[]"].options.add(newOption);
					newOption.text = f1.india_vs_state.options[i].text;
					newOption.value = f1.india_vs_state.options[i].value;
				} //for i
			}
		}
		
		function selectPartnerCity(city) {
			
			f1 = document.thisForm;
					
			f1.elements["partnerResidingCity[]"].length = 0;
			
			newOption = document.createElement("OPTION");					
			f1.elements["partnerResidingCity[]"].options.add(newOption);
		    newOption.text ="Any";
			newOption.value = "0";
			
			
			var ajaxRequest;
			var val;
			var k = 0;
			for (i = 1; i <  f1.elements["partnerResidingState[]"].length; i++) {
				if (f1.elements["partnerResidingState[]"][i].selected) {
					if (k==0) {
						val = f1.elements["partnerResidingState[]"][i].value;
					} else {
						val = val + "," + f1.elements["partnerResidingState[]"][i].value;
					}
					k++;	
				}
			}			
			if (val == "") { val = 0; }			
			var result;
			var newOption;
			try {
				ajaxRequest = new XMLHttpRequest();
			} catch (e) {
				try {
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e) {
						alert("Your browser does not support ajax!");
						return false;
					}
				}
			}
			ajaxRequest.onreadystatechange = function() {
				f1 = document.thisForm;	
							
				if (ajaxRequest.readyState == 4) {					
					result = ajaxRequest.responseText;					
					string1 = result.split("#");

					for ( var i = 0; i < string1.length - 1; i++) {						
						string2 = string1[i].split("_");
						newOption = document.createElement("OPTION");					
						f1.elements["partnerResidingCity[]"].options.add(newOption);
					    newOption.text = string2[1];
						newOption.value = string2[0];						
					}//for i
					if (city) {						
						f1 = document.thisForm;
						str = city.split(",");			
						for (i = 0; i < str.length; i++) {					
							for (j=0; j< f1.elements["partnerResidingCity[]"].length; j++)	{
								if (f1.elements["partnerResidingCity[]"][j].value == str[i]) {
									f1.elements["partnerResidingCity[]"][j].selected = true;
								}
							}
						}	
					}
					
				}				
			}
			ajaxRequest.open("GET","includes/fill_state_city_ajax.php?action=GetCity&stateid=" + val, true);
			ajaxRequest.send(null);
		}
		 
		function FillReligionsCaste(religion,caste) {
			
			FillReligions(religion,caste);			
		}		
		
		function FillReligions(religion,caste) {	
		
			f1 = document.thisForm;
			var ajaxRequest; 
			var val = 0;
			k = 0;
			for(i = 0; i <  f1.elements["partnerDomain[]"].length; i++) {
				if (f1.elements["partnerDomain[]"][i].selected) {
					if (k==0) {
						val = f1.elements["partnerDomain[]"][i].value;
					} else {
						val = val + "," + f1.elements["partnerDomain[]"][i].value;
					}
					k++;	
				}
			}						
			if (val == "") { val = 0; }			
			var result;
			var newOption;
			try {
				ajaxRequest = new XMLHttpRequest();
			} catch (e) {
				try {
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e) {
						alert("Your browser does not support ajax!");
						return false;
					}
				}
			}
			ajaxRequest.onreadystatechange = function() {
				f1 = document.thisForm;	
				if (ajaxRequest.readyState == 4) {					
					result = ajaxRequest.responseText;					
					string1 = result.split("/");			 
					
					//remove the previous items
					var len = f1.elements["partnerReligion[]"].length;
					for ( var k = len; k > 0; k--) {
						f1.elements["partnerReligion[]"].remove(k);
					}					
					for ( var i = 0; i < string1.length - 1; i++) {						
						string2 = string1[i].split("_");						
					    newOption = document.createElement("OPTION");					
						f1.elements["partnerReligion[]"].options.add(newOption);					
					    newOption.text = string2[1];
						newOption.value = string2[0];
						//alert(f1.elements["partnerReligion[]"][i].value);
					}//for i
					if (religion) {
						str = religion.split(",");
						f1.elements["partnerReligion[]"][0].selected = false;
						for (i = 0; i < str.length; i++) {
							for (j=0; j< f1.elements["partnerReligion[]"].length; j++)	{
								if (f1.elements["partnerReligion[]"][j].value == str[i]) {						
									f1.elements["partnerReligion[]"][j].selected = true;
								}
							}
						}
					}
					FillCaste(caste);
				}
			}
			ajaxRequest.open("GET","includes/fill_religion_caste_ajax.php?action=GetReligion&domainid=" + val, true);
			ajaxRequest.send(null);
		}
		
		function FillCaste1(caste) {	
		
			f1 = document.thisForm;
			var ajaxRequest; 
			var val = 0;
			var val1 = 0;
			k = 0;
			for(i = 0; i <  f1.elements["partnerDomain[]"].length; i++) {
				if (f1.elements["partnerDomain[]"][i].selected) {
					if (k == 0) {
						val = f1.elements["partnerDomain[]"][i].value;
					} else {
						val = val + "," + f1.elements["partnerDomain[]"][i].value;
					}
					k++;	
				}
			}
			if (val == "") { val = 0; }
			k = 0;
			for(i = 0; i <  f1.elements["partnerReligion[]"].length; i++) {
				if (f1.elements["partnerReligion[]"][i].selected) {						
					if (k == 0) {
						val1 = f1.elements["partnerReligion[]"][i].value;
					} else {
						val1 = val1 + "," + f1.elements["partnerReligion[]"][i].value;
					}
					k++;	
				}
			}
			if (val1 == "") { val1 = 0; }				
			var result;
			var newOption;
			try {
				ajaxRequest = new XMLHttpRequest();
			} catch (e) {
				try {
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e) {
						alert("Your browser does not support ajax!");
						return false;
					}
				}
			}
			ajaxRequest.onreadystatechange = function() {
				f1 = document.thisForm;	
				if (ajaxRequest.readyState == 4) {					
					result = ajaxRequest.responseText;					
					string1 = result.split("/");			 
					
					//remove the previous items
					/*var len = f1.elements["partnerCaste[]"].length;
					for ( var k = len; k > 0; k--) {
						f1.elements["partnerCaste[]"].remove(k);
					}*/
					
					f1.elements["partnerCaste[]"].length = 1;
					for ( var i = 0; i < string1.length - 1; i++) {						
						string2 = string1[i].split("_");
					    newOption = document.createElement("OPTION");						
						f1.elements["partnerCaste[]"].options.add(newOption);					
					    newOption.text = string2[1];
						newOption.value = string2[0];
						//alert(f1.elements["partnerReligion[]"][i].value);
					}//for i
					/*if (caste) {
						str = caste.split(",");
						f1.elements["partnerCaste[]"][0].selected = false;
						for (i = 0; i < str.length; i++) {
							for (j=0; j< f1.elements["partnerCaste[]"].length; j++)	{
								if (f1.elements["partnerCaste[]"][j].value == str[i]) {
									f1.elements["partnerCaste[]"][j].selected = true;
								}
							}	
						}
					}*/
				}
				
				
			}
			ajaxRequest.open("GET","includes/fill_religion_caste_ajax.php?action=GetCaste1&religionid=" + val1 + "&domainid=" + val, true);
			ajaxRequest.send(null);						
		}
		
		function FillCaste(caste) {				
			f1 = document.thisForm;
			var ajaxRequest; 
			k = 0;
			var val = 0;
			for(i = 0; i <  f1.elements["partnerDomain[]"].length; i++) {
				if (f1.elements["partnerDomain[]"][i].selected) {
					if (k == 0) {
						val = f1.elements["partnerDomain[]"][i].value;
					} else {
						val = val + "," + f1.elements["partnerDomain[]"][i].value;
					}
					k++;	
				}
			}
			if (val == "") { val = 0; }
			var result;
			var newOption;
			try {
				ajaxRequest = new XMLHttpRequest();
			} catch (e) {
				try {
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e) {
						alert("Your browser does not support ajax!");
						return false;
					}
				}
			}
			ajaxRequest.onreadystatechange = function() {
				f1 = document.thisForm;	
				if (ajaxRequest.readyState == 4) {	
				
					result = ajaxRequest.responseText;										
					string1 = result.split("/");			 
					
					//remove the previous items
					var len = f1.elements["partnerCaste[]"].length;
					for ( var k = len; k > 0; k--) {
						f1.elements["partnerCaste[]"].remove(k);
					}					
					for ( var i = 0; i < string1.length - 1; i++) {						
						string2 = string1[i].split("_");
					    newOption = document.createElement("OPTION");						
						f1.elements["partnerCaste[]"].options.add(newOption);					
					    newOption.text = string2[1];
						newOption.value = string2[0];
						//alert(f1.elements["partnerReligion[]"][i].value);
					}//for i
					if (caste) {
						str = caste.split(",");
						f1.elements["partnerCaste[]"][0].selected = false;
						for (i = 0; i < str.length; i++) {
							for (j=0; j< f1.elements["partnerCaste[]"].length; j++)	{
								if (f1.elements["partnerCaste[]"][j].value == str[i]) {
									f1.elements["partnerCaste[]"][j].selected = true;
								}
							}	
						}
					}
				}
			}
			ajaxRequest.open("GET","includes/fill_religion_caste_ajax.php?action=GetCaste&domainid=" + val, true);
			ajaxRequest.send(null); 	
		}
		
		function SelectCaste1() {
			
			f1 = document.thisForm;
			f1.elements["partnerReligion[]"].length = 0;				
			k = 0;
			dup = 1;
			sel = 0;
			for (i = 0; i < f1.elements["partnerDomain[]"].length; i++) {					
				if (f1.elements["partnerDomain[]"][i].selected) {					
					for (j =0; j < f1.domain_vs_religion.length; j++) {
						if (f1.elements["partnerDomain[]"][i].value == f1.domain_vs_religion.options[j].text) {														
							if (k == 0) {
								var opt = new Option();						
								opt.value = "unspec";	
								opt.text = "Any";
								f1.elements["partnerReligion[]"][f1.elements["partnerReligion[]"].length] = opt;	
								k++;
							} else {
								var opt = new Option();						
								opt.value = f1.domain_vs_religion1.options[j].value;	
								opt.text = f1.domain_vs_religion1.options[j].text;
								f1.elements["partnerReligion[]"][f1.elements["partnerReligion[]"].length] = opt;									
								k++;
							}							
						}
					}
					sel++;
				}
			}
		}
		
		function star() {
			document.write("<option value='' selected>- Optional -</option><option value='Anuradha / Anusham / Anizham'>Anuradha / Anusham / Anizham</option><option value='Ardra / Thiruvathira'>Ardra / Thiruvathira</option><option value='Ashlesha / Ayilyam'>Ashlesha / Ayilyam</option><option value='Ashwini / Ashwathi'>Ashwini / Ashwathi</option><option value='Bharani'>Bharani</option><option value='Chitra / Chitha'>Chitra / Chitha</option><option value='Dhanista / Avittam'>Dhanista / Avittam</option><option value='Hastha / Atham'>Hastha / Atham</option><option value='Jyesta / Kettai'>Jyesta / Kettai</option><option value='Krithika / Karthika'>Krithika / Karthika</option><option value='Makha / Magam'>Makha / Magam</option><option value='Moolam / Moola'>Moolam / Moola</option><option value='Mrigasira / Makayiram'>Mrigasira / Makayiram</option><option value='Poorvabadrapada / Puratathi'>Poorvabadrapada / Puratathi</option><option value='Poorvapalguni / Puram / Pubbhe'>Poorvapalguni / Puram / Pubbhe</option><option value='Poorvashada / Pooradam'>Poorvashada / Pooradam</option><option value='Punarvasu / Punarpusam'>Punarvasu / Punarpusam</option><option value='Pushya / Poosam / Pooyam'>Pushya / Poosam / Pooyam</option><option value='Revathi'>Revathi</option><option value='Rohini'>Rohini</option><option value='Shatataraka / Sadayam / Satabishek'>Shatataraka / Sadayam / Satabishek</option><option value='Shravan / Thiruvonam'>Shravan / Thiruvonam</option><option value='Swati / Chothi'>Swati / Chothi</option><option value='Uttarabadrapada / Uthratadhi'>Uttarabadrapada / Uthratadhi</option><option value='Uttarapalguni / Uthram'>Uttarapalguni / Uthram</option><option value='Uttarashada / Uthradam'>Uttarashada / Uthradam</option><option value='Vishaka / Vishakam'>Vishaka / Vishakam</option>");	
		}
		
		function GetHeight() {
			document.write("<option value='' selected='selected'>- Select Height -</option><option value='4.4'>Below 4ft 5in - 134.62cm</option><option value='4.5'>4ft 5in - 134.62cm</option><option value='4.6'>4ft 6in - 137.16cm</option><option value='4.7'>4ft 7in - 139.7cm</option><option value='4.8'>4ft 8in - 142.24cm</option><option value='4.9'>4ft 9in - 144.78cm</option><option value='4.10'>4ft 10in - 147.32cm</option><option value='4.11'>4ft 11in - 149.86cm</option><option value='5'>5ft - 152.4cm</option><option value='5.1'>5ft 1in - 154.94cm</option><option value='5.2'>5ft 2in - 157.48cm</option><option value='5.3'>5ft 3in - 160.02cm</option><option value='5.4'>5ft 4in - 162.56cm</option><option value='5.5'>5ft 5in - 165.1cm</option><option value='5.6'>5ft 6in - 167.64cm</option><option value='5.7'>5ft 7in - 170.18cm</option><option value='5.8'>5ft 8in - 172.72cm</option><option value='5.9'>5ft 9in - 175.26cm</option><option value='5.10'>5ft 10in - 177.8cm</option><option value='5.11'>5ft 11in - 180.34cm</option><option value='6'>6ft - 182.88cm</option><option value='6.1'>6ft 1in - 185.42cm</option><option value='6.2'>6ft 2in - 187.96cm</option><option value='6.3'>6ft 3in - 190.5cm</option><option value='6.4'>6ft 4in - 193.04cm</option><option value='6.5'>6ft 5in - 195.58cm</option><option value='6.6'>6ft 6in - 198.12cm</option><option value='6.7'>6ft 7in - 200.66cm</option><option value='6.8'>6ft 8in - 203.2cm</option><option value='6.9'>6ft 9in - 205.74cm</option><option value='6.10'>6ft 10in - 208.28cm</option><option value='6.11'>6ft 11in - 210.82cm</option><option value='7'>7ft - 213.36cm</option><option value='7.1'>7ft - 213.36cm Plus</option>");	
		}
		
		function GetBloodGroup() {
			document.write("<option value='' selected='selected'>-Select Blood Group-</option><option value='A+'>A+</option><option value='A-'>A-</option><option value='A1+'>A1+</option><option value='A1-'>A1- </option><option value='A1B+'>A1B+ </option><option value='A1B-'>A1B- </option><option value='A2+'>A2+ </option><option value='A2-'>A2- </option><option value='A2B+'>A2B+ </option><option value='A2B-'>A2B- </option><option value='AB+'>AB+ </option><option value='AB-'>AB- </option><option value='B+'>B+ </option><option value='B-'>B- </option><option value='O+'>O+ </option><option value='O-'>O- </option>");	
		}
		
		function formElementLimiter (field,maxlimit ) {
			if ( field.value.length > maxlimit ) {
				field.value = field.value.substring( 0, maxlimit );
				field.blur();
				field.focus();
				return false;
			}
		
		}
		
		function isMaxLen(counter,obj,maxsiz,msg) {	
		
			f1 = document.thisForm;
			
			if (Trim(obj.value)) {
				//obj.value = Trim(obj.value);
				var strLen = obj.value;
				counter.value = (strLen.length+1);
				if (strLen.length >= maxsiz) {
					alert("Please enter the \"" + msg + "\" within " + maxsiz + " letters");
					obj.focus();					
					obj.length = maxsiz;
					obj.enable = "false";					
					return false;  
				} else {						
					return true;						
				} 
			} else {
				counter.value = 0;	
			}
		}
		
		function isMinLen(obj,minsiz,msg) {				
			if (Trim(obj.value) != "") {
				//obj.value = Trim(obj.value);
				var strLen = obj.value;
				if (strLen.length < minsiz) {
					alert("Please enter the \"" + msg + "\" minimum " + minsiz + " letters");
					obj.focus();														
					return true;  
				} else {						
					return false;						
				} 
			}					
		}
		
		function fnRegister_1() {
				
			f1 = document.thisForm;
			var allow = 1;
			if (notSelected(f1.domain,"domain")) { allow = 0; return false;}
			if (notSelected(f1.registerby,"Register By")) { allow = 0; return false;}
			if (isNull(f1.name,"name")) { allow = 0; return false;}
			if (notSelected(f1.mydateM,"Month")) { allow = 0; return false; }
			if (notSelected(f1.mydateD,"Date")) { allow = 0; return false; }
			if (notSelected(f1.mydateY,"Year")) { allow = 0; return false; }
			//if (isNull(f1.age,"age")) { return false;}			
			if (notChecked1(f1.gender,"gender")) { allow = 0; return false;}				
			if (notChecked1(f1.maritalStatus,"marital Status")) { allow = 0; return false;}
			if (f1.no_of_Children.disabled == false) {
				if (notSelected(f1.no_of_Children,"Number of children")) { allow = 0; return false;}	
			}			
			childrenLivingStatusChk = 0;			
			if (f1.childrenLivingStatus[0].disabled == false) {		
				childrenLivingStatusChk = 1;			
			}
			if (childrenLivingStatusChk) {
				if (notChecked1(f1.childrenLivingStatus,"Children living status")) { 
					allow = 0; return false;
				} 		
			}			
			if (notSelected(f1.religion,"religion")) { allow = 0; return false;}
//			if (notSelected(f1.countryLivingIn,"country living in")) { return false;}

			if (f1.citizenship.value != 'Others') {
				if (notSelected(f1.citizenship,"citizenship")) { allow = 0; return false;}							
			} else {
				if (isNull(f1.citizenship_1,"citizenship")) { allow = 0; return false;}	
			}
			
			if (notSelected(f1.education,"education category")) { return false;}
			if (notSelected(f1.occupation,"occupation")) { return false;}		
			if (f1.income.value != "") {
				if(fnChkNumber(f1.income)) { return false;}
			}
			if (f1.nocaste.checked) {
			} else {
				if (notSelected(f1.caste,"Caste / Division")) { return false; }
			}
			if (notSelected(f1.language,"Mother tongue")) { return false;}




			if (isNull(f1.streetAddress,"Street Address")) { return false;}
			if (isNull(f1.area,"area")) { return false;}		
			
			if (f1.country.value != "Others") {
				if (notSelected(f1.country,"country")) { return false;}
			} else {
				if (isNull(f1.country_1,"country")) { return false; }					
			}		
			
			if (f1.state.value != "Others") {
				if (isNull(f1.state,"state")) { return false;}
			} else {
				if (isNull(f1.state_1,"state")) { return false; }		
			}
			
			if (f1.city.value != "Others") {
				if (isNull(f1.city,"city")) { return false;}
			} else {
				if (isNull(f1.city_1,"city")) { return false; }		
			}
			
			if (isNull(f1.pincode,"pin code/zip code")) { return false;}			
			if (fnChkNum2(f1.pincode, "pin code/zip code")) {return false;}
			if (f1.pincode.value <= 0) {
				alert('Please enter valid pincode');
				f1.pincode.focus();
				return false;
			}
			
			f1.phoneNumber.value = Trim(f1.phoneNumber.value);
			f1.mobileNumber.value = Trim(f1.mobileNumber.value);
			f1.countryCode.value = Trim(f1.countryCode.value);
			f1.areaCode.value = Trim(f1.areaCode.value);			
			
			if (f1.mobileNumber.value == "") {				
				if (isNull(f1.phoneNumber, "Phone number")) {return false;}
				if (fnChkNum2(f1.phoneNumber, "Phone number")) {return false;}
				if (f1.phoneNumber.value <= 0) {
					alert('Please enter valid phone number');
					f1.phoneNumber.focus();
					return false;
				}
				if (isNull(f1.countryCode, "Country code")) {return false;}
				if (fnChkNum2(f1.countryCode, "Country code")) {return false;}				
				if (f1.countryCode.value <= 0) {
					alert('Please enter valid country code');
					f1.countryCode.focus();
					return false;
				}
				if (isNull(f1.areaCode, "Area code")) {return false;}				
				if (fnChkNum2(f1.areaCode, "Area code")) {return false;}
				if (f1.areaCode.value <= 0) {
					alert('Please enter valid area code');
					f1.areaCode.focus();
					return false;
				}
			}			
			if (f1.phoneNumber.value == "") {
				if (isNull(f1.countryCode1, "Country code")) {return false;}
				if (fnChkNum2(f1.countryCode1, "Country code")) {return false;}				
				if (f1.countryCode1.value <= 0) {
					alert('Please enter valid country code');
					f1.countryCode1.focus();
					return false;
				}
				
				if (isNull(f1.mobileNumber, "Mobile Number")) {return false;}
				if (fnChkNum2(f1.mobileNumber, "Mobile Number")) {return false;}	
				if (f1.mobileNumber.value <= 0) {
					alert('Please enter valid mobile number');
					f1.mobileNumber.focus();
					return false;
				}
			}
			if (f1.phoneNumber.value != "") {
				if (fnChkNum2(f1.phoneNumber, "Phone number")) {return false;}
				if (f1.phoneNumber.value <= 0) {
					alert('Please enter valid phone number');
					f1.phoneNumber.focus();
					return false;
				}
			}
			if (f1.mobileNumber.value != "") {
				if (fnChkNum2(f1.mobileNumber, "Mobile Number")) {return false;}	
				if (f1.mobileNumber.value <= 0) {
					alert('Please enter valid mobile number');
					f1.mobileNumber.focus();
					return false;
				}
			}
			if (isNull(f1.email,"email")) { allow = 0; return false;}	
			if (notEmail(f1.email,"email")) { allow = 0; return false;}			
			if (isNull(f1.password,"password")) { allow = 0; return false;}
			if (isLen(f1.password,5,"Password")){ allow = 0; return false;}
			if (isNull(f1.cpassword,"confirm Password")) { allow = 0; return false; }       			
			if (isNotSame(f1.password,f1.cpassword,"Password","Confirm Password")) { allow = 0; return false;}
			/**/
			for (i = 0; i < f1.elements.length; i++) {
				if (f1.elements[i].name == "terms") {	
					if (f1.terms.checked) {
					} else {
						alert("Please accept the terms and condition");
						allow = 0;
						return false;
					}							
				}
			}
			if (allow == 1) {				
				return true;	
			}
		}	
		
		function fnRegister_2() {
			
			f1 = document.thisForm;
			
			if (f1.email.value != "") {
				
			
				var result;
				var newOption;
				try {
					ajaxRequest = new XMLHttpRequest();
				} catch (e) {
					try {
						ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					} catch (e) {
						try {
							ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (e) {
							alert("Your browser does not support ajax!");
							return false;
						}
					}
				}
				ajaxRequest.onreadystatechange = function() {
					f1 = document.thisForm;	
					if (ajaxRequest.readyState == 4) {	
					
						result = ajaxRequest.responseText;
						if (result == 1) {
							alert("Email address already Exist");
							f1.email.focus();
							return false;
						} else {		
							if (fnRegister_1()) {
								f1.submit();
							} else {
								return false;	
							}
							
						}
					}
				}
				ajaxRequest.open("GET","includes/checkmail_ajax.php?action=submit&email=" + f1.email.value);
				ajaxRequest.send(null);
			} else {
				return fnRegister_1();			
			}
		}
		
		function fnRegister() {		
		
			f1 = document.thisForm;
			if (notSelected(f1.domain,"domain")) { return false;}
			if (notSelected(f1.registerby,"Register By")) { return false;}
			if (isNull(f1.name,"name")) { return false;}
			if (notSelected(f1.mydateM,"Month")) { return false; }
			if (notSelected(f1.mydateD,"Date")) { return false; }
			if (notSelected(f1.mydateY,"Year")) { return false; }
			//if (isNull(f1.age,"age")) { return false;}			
			if (notChecked1(f1.gender,"gender")) { return false;}				
			if (notChecked1(f1.maritalStatus,"marital Status")) { return false;}
			if (f1.no_of_Children.disabled == false) {
				if (notSelected(f1.no_of_Children,"Number of children")) { return false;}	
			}			
			childrenLivingStatusChk = 0;			
			if (f1.childrenLivingStatus[0].disabled == false) {		
				childrenLivingStatusChk = 1;			
			}
			if (childrenLivingStatusChk) {
				if (notChecked1(f1.childrenLivingStatus,"Children living status")) { 
					return false;
				} 		
			}			
			if (notSelected(f1.religion,"religion")) { return false;}
//			if (notSelected(f1.countryLivingIn,"country living in")) { return false;}	

			if (f1.citizenship.value != 'Others') {
				if (notSelected(f1.citizenship,"citizenship")) { allow = 0; return false;}							
			} else {
				if (isNull(f1.citizenship_1,"citizenship")) { allow = 0; return false;}	
			}
			
			
			f1.phoneNumber.value = Trim(f1.phoneNumber.value);
			f1.mobileNumber.value = Trim(f1.mobileNumber.value);
			f1.countryCode.value = Trim(f1.countryCode.value);
			f1.areaCode.value = Trim(f1.areaCode.value);			
			
			if (f1.mobileNumber.value == "") {				
				if (isNull(f1.phoneNumber, "Phone number")) {return false;}
				if (fnChkNum2(f1.phoneNumber, "Phone number")) {return false;}
				if (f1.phoneNumber.value <= 0) {
					alert('Please enter valid phone number');
					f1.phoneNumber.focus();
					return false;
				}
				if (isNull(f1.countryCode, "Country code")) {return false;}
				if (fnChkNum2(f1.countryCode, "Country code")) {return false;}				
				if (f1.countryCode.value <= 0) {
					alert('Please enter valid country code');
					f1.countryCode.focus();
					return false;
				}
				if (isNull(f1.areaCode, "Area code")) {return false;}				
				if (fnChkNum2(f1.areaCode, "Area code")) {return false;}
				if (f1.areaCode.value <= 0) {
					alert('Please enter valid area code');
					f1.areaCode.focus();
					return false;
				}
			}			
			if (f1.phoneNumber.value != "") {
				
				if (fnChkNum2(f1.phoneNumber, "Phone number")) {return false;}
				if (f1.phoneNumber.value <= 0) {
					alert('Please enter valid phone number');
					f1.phoneNumber.focus();
					return false;
				}
			}
			
			if (f1.phoneNumber.value == "") {
				if (isNull(f1.mobileNumber, "Mobile Number")) {return false;}
				if (fnChkNum2(f1.mobileNumber, "Mobile Number")) {return false;}	
				if (f1.mobileNumber.value <= 0) {
					alert('Please enter valid mobile number');
					f1.mobileNumber.focus();
					return false;
				}
			}
			
			if (f1.mobileNumber.value != "") {
				if (fnChkNum2(f1.mobileNumber, "Mobile Number")) {return false;}	
				if (f1.mobileNumber.value <= 0) {
					alert('Please enter valid mobile number');
					f1.mobileNumber.focus();
					return false;
				}
			}
	
			
			if (isNull(f1.email,"email")) { return false;}	
			if (notEmail(f1.email,"email")) { return false;}
			if (isNull(f1.password,"password")) { return false;}
			if (isLen(f1.password,5,"Password")){ return false;}
			if (isNull(f1.cpassword,"confirm Password")){return false; }       			
			if (isNotSame(f1.password,f1.cpassword,"Password","Confirm Password")) { return false;}			
			/**/
			for (i = 0; i < f1.elements.length; i++) {
				if (f1.elements[i].name == "terms") {	
					if (f1.terms.checked) {
					} else {
						alert("Please accept the terms and condition");
						return false;
					}							
				}
			}
		}
		
		function fnRegister1() {
			f1 = document.thisForm;
			if (notSelected(f1.education,"education category")) { return false;}
			if (notSelected(f1.occupation,"occupation")) { return false;}		
			if (f1.income.value != "") {
				if(fnChkNumber(f1.income)) { return false;}
			}
			/*if (f1.horoscope1.value != "") {
				if (notPdfDocFile(f1.horoscope1,"horoscopre")) { return false; }
			}*/
			if (f1.nocaste.checked) {
			} else {
				if (notSelected(f1.caste,"Caste / Division")) { return false; }
			}
			if (notSelected(f1.language,"Mother tongue")) { return false;}	
			if (notSelected(f1.familyValue,"Family value")) { return false;}
			if (notSelected(f1.familyType,"Family type")) { return false;}
			if (notSelected(f1.familyStatus,"Family status")) { return false;}			
			if (isNull(f1.fatherName,"father name")) { return false;}
			if (isNull(f1.motherName,"mother name")) { return false;}
			if (f1.aboutFamily.value != "") {				
				if (isMinLen(f1.aboutFamily,50,"About my Family")) { return false; }
			}
			if (isNull(f1.streetAddress,"Street Address")) { return false;}
			if (isNull(f1.area,"area")) { return false;}		
			
			if (f1.country.value != "Others") {
				if (notSelected(f1.country,"country")) { return false;}
			} else {
				if (isNull(f1.country_1,"country")) { return false; }					
			}		
			
			if (f1.state.value != "Others") {
				if (isNull(f1.state,"state")) { return false;}
			} else {
				if (isNull(f1.state_1,"state")) { return false; }		
			}
			
			if (f1.city.value != "Others") {
				if (isNull(f1.city,"city")) { return false;}
			} else {
				if (isNull(f1.city_1,"city")) { return false; }		
			}
			
			if (isNull(f1.pincode,"pin code/zip code")) { return false;}			
			if (fnChkNum2(f1.pincode, "pin code/zip code")) {return false;}
			if (f1.pincode.value <= 0) {
				alert('Please enter valid pincode');
				f1.pincode.focus();
				return false;
			}
			
			f1.phoneNumber.value = Trim(f1.phoneNumber.value);
			f1.mobileNumber.value = Trim(f1.mobileNumber.value);
			f1.countryCode.value = Trim(f1.countryCode.value);
			f1.areaCode.value = Trim(f1.areaCode.value);			
			
			if (f1.mobileNumber.value == "") {				
				if (isNull(f1.phoneNumber, "Phone number")) {return false;}
				if (fnChkNum2(f1.phoneNumber, "Phone number")) {return false;}
				if (f1.phoneNumber.value <= 0) {
					alert('Please enter valid phone number');
					f1.phoneNumber.focus();
					return false;
				}
				if (isNull(f1.countryCode, "Country code")) {return false;}
				if (fnChkNum2(f1.countryCode, "Country code")) {return false;}				
				if (f1.countryCode.value <= 0) {
					alert('Please enter valid country code');
					f1.countryCode.focus();
					return false;
				}
				if (isNull(f1.areaCode, "Area code")) {return false;}				
				if (fnChkNum2(f1.areaCode, "Area code")) {return false;}
				if (f1.areaCode.value <= 0) {
					alert('Please enter valid area code');
					f1.areaCode.focus();
					return false;
				}
			}			
			if (f1.phoneNumber.value == "") {
				if (isNull(f1.mobileNumber, "Mobile Number")) {return false;}
				//if (fnChkNum2(f1.mobileNumber, "Mobile Number")) {return false;}	
				if (f1.mobileNumber.value <= 0) {
					alert('Please enter valid mobile number');
					f1.mobileNumber.focus();
					return false;
				}
			}
			if (f1.phoneNumber.value != "") {
				if (fnChkNum2(f1.phoneNumber, "Phone number")) {return false;}
				if (f1.phoneNumber.value <= 0) {
					alert('Please enter valid phone number');
					f1.phoneNumber.focus();
					return false;
				}
			}
			if (f1.mobileNumber.value != "") {
				if (fnChkNum2(f1.mobileNumber, "Mobile Number")) {return false;}	
				if (f1.mobileNumber.value <= 0) {
					alert('Please enter valid mobile number');
					f1.mobileNumber.focus();
					return false;
				}
			}
			if (f1.fax.value != "") {
				if (fnChkNum2(f1.fax, "Fax")) {return false;}	
				if (f1.fax.value <= 0) {
					alert('Please enter valid fax');
					f1.fax.focus();
					return false;
				}
			}		
			
			if (f1.residingCountry.value != "Others") {
				if (notSelected(f1.residingCountry,"Precently Residing in Country")) { return false;}
			} else {
				if (isNull(f1.residingCountry_1,"Precently Residing in Country")) { return false; }		
			}
			
			if (f1.residingState.value != "Others") {
				if (notSelected(f1.residingState,"Precently Residing in State")) { return false;}
			} else {
				if (isNull(f1.residingState_1,"Precently Residing in State")) { return false; }		
			}
			
			if (f1.residingCity.value != "Others") {
				if (notSelected(f1.residingCity,"Precently Residing in City")) { return false;}
			} else {
				if (isNull(f1.residingCity_1,"Precently Residing in City")) { return false; }		
			}	
			
			if (f1.nationality.value != "Others") {
				if (notSelected(f1.nationality,"nationality")) { return false;}									
			} else {
				if (isNull(f1.nationality_1,"nationality")) { return false; }	
			}
		}
		
		function fnRegister3() {
			f1 = document.thisForm;
			if (notSelected(f1.height,"height")) { return false; }
			if (notSelected(f1.bodyType,"body type")) { return false; }
			if (notSelected(f1.complexion,"Complexion")) { return false; }
			if (notSelected(f1.physicalStatus,"physical status")) { return false; }	
			if (notSelected(f1.smoking,"smoking")) { return false; }
			if (notSelected(f1.drink,"drink")) { return false; }	
			if (isNull(f1.personality, "personality")) { return false; }
			if (isMinLen(f1.personality,50,"personality")) { return false; }
			//languageKnown1
			j1=0;
			f1.languageKnown.value = "";
			langMax = f1.languageKnown1.length;
			for (i = 0; i < f1.languageKnown1.length; i++) {
				if (f1.languageKnown1[i].checked) {
					if (j1 == 0) {
						f1.languageKnown.value	= f1.languageKnown1[i].value;
					} else {	
						if (langMax == j1) { 
							
						} else {
							f1.languageKnown.value	= f1.languageKnown.value + "," + f1.languageKnown1[i].value;
						}
					}
					
					j1++;
				}
			}										
		}	 
		function DeleteImage(id) {
			var msg = "Are you sure want to delete the photo";	
			if (confirm(msg)) {	
				location.href="editprofile.php?action=deleteimage&action1=occupation&id=" + id;	
			}
		}
		function DeleteImage1(id) {
			var msg = "Are you sure want to delete the photo";	
			if (confirm(msg)) {	
				location.href="add_photo.php?action=deleteimage&id=" + id;	
			}
		}
		function LangKn() {	
			f1 = document.thisForm;							
			j=0;					
			for (k = 0; k < f1.languageKnown1.length; k++) {
				if (f1.languageKnown1[k].checked) {
					
					j++;	
				}
			}				
			if (j>10) {
				alert("Please don't select more than 10 language");
				return false;
			}
			//languageKnown1
		}
		function SelLanguage(lang) {
			f1 = document.thisForm;
			for (k = 0; k < f1.languageKnown1.length; k++) {
				if (f1.languageKnown1[k].value == lang) {
					f1.languageKnown1[k].checked = true;
				}
			}
		}
		var number = new Array("0","1","2","3","4","5","6","7","8","9","11","12","13","14","15","16","17","18","19","20","21","22","23","24");										
		function SelHobbies(no,type) {			
			f1 = document.thisForm;	
			k=0;
			for (p = 0; p < number.length; p++) {	
				if (no == number[p]) {
					k = 1;		
				}
			}
			if (k == 0) {
				for (i = 0; i < f1.elements.length; i++) {
					name = "txt" + type;
					if (f1.elements[i].name == name) {
						f1.elements[i].value = no;							
					}
				}
			}
			for (i = 0; i < f1.elements.length; i++) {
				name = type + "_" + no;
				if (f1.elements[i].name == name) {
					f1.elements[i].checked = true;
				}										
			}				
		}
		
		function SelDomain(domain1) {
			f1 = document.thisForm;
			str = domain1.split(",");
			f1.elements["partnerDomain[]"][0].selected = false;
			for (i = 0; i < str.length; i++) {
				for (j=0; j< f1.elements["partnerDomain[]"].length; j++) {
					if (f1.elements["partnerDomain[]"][j].value == str[i]) {
						f1.elements["partnerDomain[]"][j].selected = true;
					}
				}
			}
		}
		
		function SelEducation(education) {
			f1 = document.thisForm;
			str = education.split(",");
			f1.elements["partnerEducation[]"][0].selected = false;
			for (i = 0; i < str.length; i++) {
				for (j=0; j< f1.elements["partnerEducation[]"].length; j++)	{
					if (f1.elements["partnerEducation[]"][j].value == str[i]) {
						f1.elements["partnerEducation[]"][j].selected = true;
					}
				}
			}	
		}
		function SelMaritalStatus(status) {
			f1 = document.thisForm;
			str = status.split(",");
			f1.elements["partnerMaritalStatus[]"][0].selected = false;
			for (i = 0; i < str.length; i++) {
				for (j=0; j< f1.elements["partnerMaritalStatus[]"].length; j++)	{
					if (f1.elements["partnerMaritalStatus[]"][j].value == str[i]) {
						f1.elements["partnerMaritalStatus[]"][j].selected = true;
					}
				}
			}		
		}
		function SelCitizenship(country) {			
			f1 = document.thisForm;
			str = country.split(",");
			f1.elements["partnerCitizenship[]"][0].selected = false;
			for (i = 0; i < str.length; i++) {
				for (j=0; j< f1.elements["partnerCitizenship[]"].length; j++)	{
					if (f1.elements["partnerCitizenship[]"][j].value == str[i]) {
						f1.elements["partnerCitizenship[]"][j].selected = true;
					}
				}
			}		
		}
		function SelLivingIn(country) {				
			f1 = document.thisForm;
			str = country.split(",");
			f1.elements["partnerCountryLiving[]"][0].selected = false;
			for (i = 0; i < str.length; i++) {					
				for (j=0; j< f1.elements["partnerCountryLiving[]"].length; j++)	{
					if (f1.elements["partnerCountryLiving[]"][j].value == str[i]) {						
						f1.elements["partnerCountryLiving[]"][j].selected = true;
					}
				}
			}		
		}
		
		function selPartnerState(state) {
			f1 = document.thisForm;
			str = state.split(",");
			//f1.elements["partnerResidingState[]"][0].selected = false;
			for (i = 0; i < str.length; i++) {
				for (j=0; j< f1.elements["partnerResidingState[]"].length; j++)	{
					if (f1.elements["partnerResidingState[]"][j].value == str[i]) {
						f1.elements["partnerResidingState[]"][j].selected = true;
					}
				}
			}		
		}
		
		function selPartnerCity(city) {
			if (city) {
				f1 = document.thisForm;
				str = city.split(",");			
				for (i = 0; i < str.length; i++) {					
					for (j=0; j< f1.elements["partnerResidingCity[]"].length; j++)	{
						if (f1.elements["partnerResidingCity[]"][j].value == str[i]) {
							f1.elements["partnerResidingCity[]"][j].selected = true;
						}
					}
				}		
			}
		}
		
		function selPartnerReligion(religion) {
			//alert(religion);	
			f1 = document.thisForm;
			str = religion.split(",");
			f1.elements["partnerReligion[]"][0].selected = false;
			for (i = 0; i < str.length; i++) {
				for (j=0; j< f1.elements["partnerReligion[]"].length; j++)	{
					if (f1.elements["partnerReligion[]"][j].value == str[i]) {						
						f1.elements["partnerReligion[]"][j].selected = true;
					}
				}
			}		
		}
		function selPartnerCaste(caste) {
			f1 = document.thisForm;
			str = caste.split(",");
			f1.elements["partnerCaste[]"][0].selected = false;
			for (i = 0; i < str.length; i++) {
				for (j=0; j< f1.elements["partnerCaste[]"].length; j++)	{
					if (f1.elements["partnerCaste[]"][j].value == str[i]) {
						f1.elements["partnerCaste[]"][j].selected = true;
					}
				}
			}		
		}
		function getIndianState() {
			document.write("<option value='Andaman & Nicobar'>Andaman & Nicobar</option><option value='Andhra Pradesh'>Andhra Pradesh</option><option value='Arunachal Pradesh'>Arunachal Pradesh</option><option value='Assam'>Assam</option><option value='Bihar'>Bihar</option><option value='Chandigarh'>Chandigarh</option><option value='Chhattisgarh'>Chhattisgarh</option><option value='Dadra & Nagar Haveli'>Dadra & Nagar Haveli</option><option value='Daman & Diu'>Daman & Diu</option><option value='Delhi'>Delhi</option><option value='Goa'>Goa</option><option value='Gujarat'>Gujarat</option><option value='Haryana'>Haryana</option><option value='Himachal Pradesh'>Himachal Pradesh</option><option value='Jammu & Kashmir'>Jammu & Kashmir</option><option value='Jharkand'>Jharkand</option><option value='Karnataka'>Karnataka</option><option value='Kerala'>Kerala</option><option value='Lakshadeep'>Lakshadeep</option><option value='Madhya Pradesh'>Madhya Pradesh</option><option value='Maharashtra'>Maharashtra</option><option value='Manipur'>Manipur</option><option value='Meghalaya'>Meghalaya</option><option value='Mizoram'>Mizoram</option><option value='Nagaland'>Nagaland</option><option value='Orissa'>Orissa</option><option value='Pondicherry'>Pondicherry</option><option value='Punjab'>Punjab</option><option value='Rajasthan'>Rajasthan</option><option value='Sikkim'>Sikkim</option><option value='Tamil Nadu'>Tamil Nadu</option><option value='Tripura'>Tripura</option><option value='Uttar Pradesh'>Uttar Pradesh</option><option value='Uttaranchal'>Uttaranchal</option><option value='West Bengal'>West Bengal</option>");	
		}
		function UpdateMenus() {
			document.write('<table colspann="1" cellpading="1" width=500><tr><td><a href="editprofile.php?action1=basic">Basic Details</a></td><td><a href="editprofile.php?action1=occupation">Occupation,Family details</a></td><td><a href="editprofile.php?action1=physical">Physical Details</a></td><td><a href="editprofile.php?action1=hobbies">Interest,Hobbies details</a></td><td><a href="editprofile.php?action1=lookingfor">Expectation/Looking for</a></td></tr></table>');	
		}
		
		function chkUser1() {
			f1 = document.thisForm;	
			if (f1.username.value != "") {
				if ( window.XMLHttpRequest) {
					http = new XMLHttpRequest();
				} else if ( window.ActiveXObject ) {
					http = new  ActiveXObject("Microsoft.XMLHTTP");
				}
				http.onreadystatechange = httpChanges;
				url = "chkuser.php?action=check&prefix=" + f1.txtPrefix.value + "&username=" + f1.username.value;
				http.open("GET",url,true);
				http.send(null);
			}
		}		
		
		function httpChanges() {		
			if ( http.readyState == 4 ) {
				var x = http.responseText;			
				document.getElementById("usernameSuggest").innerHTML = x;							
			}	
		}		
		
		function selReligion() { 			
			f1 = document.thisForm;	
			f1.religion.length = 1;			
			k = 1;
			for (i = 0; i < f1.domain_vs_religion.length; i++) {
				if (f1.domain_vs_religion.options[i].text == f1.domain.value) {
					for (j = 0; j < f1.domain_vs_religion1.length; j++) {
						if (f1.domain_vs_religion1.options[j].value == f1.domain_vs_religion.options[i].value) {	
							var opt = new Option();						
							opt.value = f1.domain_vs_religion1.options[j].value;	
							opt.text = f1.domain_vs_religion1.options[j].text;	
							f1.religion.options[k] = opt;											
							k++;
						}
					}
				}
			}
		}		
		
		function FillCaste3(caste) {	
		
			f1 = document.thisForm;
			var ajaxRequest; 
			var val = 0;
			var val1 = 0;
			k = 0;
			val = f1.domain.value;
			if (val == "") { val = 0; }
			k = 0;
			val1 = f1.religion.value;
			if (val1 == "") { val1 = 0; }				
			var result;
			var newOption;
			try {
				ajaxRequest = new XMLHttpRequest();
			} catch (e) {
				try {
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e) {
						alert("Your browser does not support ajax!");
						return false;
					}
				}
			}
			ajaxRequest.onreadystatechange = function() {
				f1 = document.thisForm;	
				if (ajaxRequest.readyState == 4) {					
					result = ajaxRequest.responseText;					
					string1 = result.split("/");			 
					
					//remove the previous items
					/*var len = f1.elements["partnerCaste[]"].length;
					for ( var k = len; k > 0; k--) {
						f1.elements["partnerCaste[]"].remove(k);
					}*/
					
					f1.caste.length = 1;
					for ( var i = 0; i < string1.length - 1; i++) {						
						string2 = string1[i].split("_");
					    newOption = document.createElement("OPTION");						
						f1.caste.options.add(newOption);					
					    newOption.text = string2[1];
						newOption.value = string2[0];
						//alert(f1.elements["partnerReligion[]"][i].value);
					}//for i
					/*if (caste) {
						str = caste.split(",");
						f1.elements["partnerCaste[]"][0].selected = false;
						for (i = 0; i < str.length; i++) {
							for (j=0; j< f1.elements["partnerCaste[]"].length; j++)	{
								if (f1.elements["partnerCaste[]"][j].value == str[i]) {
									f1.elements["partnerCaste[]"][j].selected = true;
								}
							}	
						}
					}*/
				}
				
				
			}
			ajaxRequest.open("GET","includes/fill_religion_caste_ajax.php?action=GetCaste3&religionid=" + val1 + "&domainid=" + val, true);
			ajaxRequest.send(null);						
		}
		
		function toggleHint(sMode, sElementName)
		{			
			sDisplay = (sMode == "show") ? "inline" : "none";
		
			if(oElement = eval(document.getElementById('hint_' + sElementName)))
			{
				oElement.style.display = sDisplay;
			}
		}
		
		function fnValidateSearch(val1){
			f1 = document.searchForm;	
			if (val1 == 1) {
				if (notSelected(f1.religion,"religion")) { return false; }	
			} else {
				if (notSelected(f1.domain,"domain")) { return false; }		
			}
		}
		
		<!--yel-->
		function fnChange(curid)
		{
			var menubg1='';
			menubg1 = "menubg"+curid;
			document.getElementById(menubg1).style.backgroundColor = "#948036";
			document.getElementById(menubg1).style.color = "#fff7d8";

		}
		 function fnstore(curid)
		{
			var menubg1='';
			menubg1 = "menubg"+curid;
			document.getElementById(menubg1).style.backgroundColor = "#fff7d8";
			document.getElementById(menubg1).style.color = "#847742";
		}
		<!--grn-->
		function fnChangeg(grnid)
		{
			var menugbg1='';
			menugbg1 = "menugbg"+grnid;
			document.getElementById(menugbg1).style.backgroundColor = "#84a41f";
			document.getElementById(menugbg1).style.color = "#f7f9cf";

		}
		 function fnstoreg(grnid)
		{
			var menugbg1='';
			menugbg1 = "menugbg"+grnid;
			document.getElementById(menugbg1).style.backgroundColor = "#f7f9cf";
			document.getElementById(menugbg1).style.color = "#75901e";
		}
			var newwindow="";
		function poptastic(url){
		newwindow=window.open(url,'name','height=500,width=280,left=20,top=20,toolbar=no,menubar=no,directories=no,location=no,scrollbars=yes,status=no,resizable=yes,fullscreen=no');
		if (window.focus) {newwindow.focus()}
		}
