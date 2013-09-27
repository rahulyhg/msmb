<?php
 function fnBottomBanner($page,$type){
 	$sql_banner="select * from tbl_advertisements where 0 in(domains_show) and banner_display_type=0";								
	$sql_banner.=" and 1=1 order by rand() limit 1";	
	$res_banner=mysql_query($sql_banner);
	if(mysql_num_rows($res_banner)>0){
		$obj_banner=mysql_fetch_object($res_banner);
		$banner_image="ad_banner_images/".$obj_banner->banner_image;
		$website_url=$obj_banner->website_url;
	}else{
		$banner_image="images/add_banner_botom.gif";
		$website_url="http://bestmatrimonial.com//";
	}

 		$strBottomBanner="";
		$strBottomBanner.="<td width=\"32%\">";
		$strBottomBanner.="<table  border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">";
		$strBottomBanner.="<tr><td height=\"120\" align=\"right\"><a href=".$website_url." target=\"_blank\" style=\"cursor:pointer;\"><img src=".$banner_image." border=\"0\" width=\"230\" height=\"100\" /></a></td>";																					
		$strBottomBanner.="</tr></table></td>";		
		echo $strBottomBanner;	
 }
 function fnBottomBanners($page,$type){
 	$sql_banner="select * from tbl_advertisements where 0 in(domains_show) and banner_display_type=0";								
	$sql_banner.=" and 1=1 order by rand() limit 1";	
	$res_banner=mysql_query($sql_banner);
	if(mysql_num_rows($res_banner)>0){
		$obj_banner=mysql_fetch_object($res_banner);
		$banner_image="ad_banner_images/".$obj_banner->banner_image;
		$website_url=$obj_banner->website_url;
	}else{
		$banner_image="images/add_banner_botom.gif";
		$website_url="http://bestmatrimonial.com//";
	}

 	$strBottomBanner="";
		$strBottomBanner.="<tr><td class=\"bottombg\" height=\"140\">";
			$strBottomBanner.="<table width=\"780\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
				$strBottomBanner.="<tr><td width=\"544\"><a href=".$website_url." target=\"_blank\" style=\"cursor:pointer;\"><img src=".$banner_image." border=\"0\" width=\"539\" height=\"117\" /></a></td>";
				$strBottomBanner.="<form name=\"newsLetterForm\" method=\"post\" action=\"subscribe.php?Mode=Subscribe\" onsubmit=\"return fnValidateNewsletter();\">";
//For Register Page				
				$file = $_SERVER["SCRIPT_NAME"];
				$break = Explode('/', $file);
				$pfile = $break[count($break) - 1]; 
				$pfile;
						
				
				$strBottomBanner.="</form>";													
				$strBottomBanner.="</tr></table>";
		$strBottomBanner.="</td></tr>";	
		$strBottomBanner.="<tr><td class=\"btmmenubg\" height=\"20\" align=\"center\"><a href=\"index.php\" class=\"btmmenu\">Home</a><font class=\"bmenup\">|</font><a href=\"#\" class=\"btmmenu\">About Us</a><font class=\"bmenup\">|</font><a href=\"#\" class=\"btmmenu\">FAQ</a><font class=\"bmenup\">|</font><a href=\"search.php\" class=\"btmmenu\">Search</a><font class=\"bmenup\">|</font><a href=\"#\" class=\"btmmenu\">Support</a><font class=\"bmenup\">|</font><a href=\"#\" class=\"btmmenu\">Contact</a><font class=\"bmenup\">|</font><a href=\"#\" class=\"btmmenu\">Privacy Policy</a><font class=\"bmenup\">|</font><a href=\"#\" class=\"btmmenu\">Terms & Conditions</a></td></tr>";		
		$strBottomBanner.="<tr><td align=\"center\" height=\"50\" bgcolor=\"#fffcf8\"><font class=\"copy\">© 2010 thecreativeit.com Matrimonial Services Provider.<br>All trademarks, logos and names are properties of their respective owners. All Rights Reserved.</font></td></tr>";		
	echo $strBottomBanner;	
 }

?>
