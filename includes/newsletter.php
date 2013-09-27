<?php
 function fnNewsletter(){
	$strBottomBanner="";
		$strBottomBanner.="<td height=\"140\">";
			$strBottomBanner.="<table width=\"200\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
				$strBottomBanner.="<form name=\"newsLetterForm\" method=\"post\" action=\"subscribe.php?Mode=Subscribe\" onsubmit=\"return fnValidateNewsletter();\">";
			//For Register Page				
				$file = $_SERVER["SCRIPT_NAME"];
				$break = Explode('/', $file);
				$pfile = $break[count($break) - 1]; 
				$pfile;
						
				$strBottomBanner.="<td width=\"236\" align=\"center\">";	
				$strBottomBanner.="<div style=\"background-color:#FFFFFF; width:225px; height:125px; border:solid 1px #a4b386;\">";
					$strBottomBanner.="<div><img src=\"images/news_letter.jpg\" width=\"225\"/></div>";
					$strBottomBanner.="<div class=\"story\" style=\"padding:10px 0px 10px 10px;\" align=\"left\">Sign up for a FREE Newsletter by entering your email address here.</div>";
					$strBottomBanner.="<div><input name=\"txtEmailAddress\" type=\"text\" class=\"newsbox\">&nbsp;<input name=\"Submit\" type=\"Submit\" value=\"Submit\" class=\"button2\"></div>";
				$strBottomBanner.="</div>";
				$strBottomBanner.="</td>";
				
				$strBottomBanner.="</form>";													
				$strBottomBanner.="</tr></table>";
		$strBottomBanner.="</td>";	
	echo $strBottomBanner;
 }
?>