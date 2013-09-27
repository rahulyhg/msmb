<?php
function fnBannerImage($page,$type){
			 if(($type=="right_bottom")&&($page=="index"))
					$sql_banner="select * from tbl_advertisements where 0 in(domains_show) and banner_display_type=0 ";								
			 elseif(($type=="top")&&($page=="index"))
					$sql_banner="select * from tbl_advertisements where 0 in(domains_show) and banner_display_type=8 ";	
			 elseif(($type=="top")&&($page=="search"))
					$sql_banner="select * from tbl_advertisements where 0 in(domains_show) and banner_display_type=2 ";	
			 elseif(($type=="left")&&($page=="search"))
					$sql_banner="select * from tbl_advertisements where 0 in(domains_show) and banner_display_type=3 ";	
			 elseif(($type=="bottem")&&($page=="member_login"))
					$sql_banner="select * from tbl_advertisements where 0 in(domains_show) and banner_display_type=4 ";									
			 elseif(($type=="bottem")&&($page=="image_view"))
					$sql_banner="select * from tbl_advertisements where 0 in(domains_show) and banner_display_type=5 ";									
			 elseif(($type=="top")&&($page=="widding_directory"))
					$sql_banner="select * from tbl_advertisements where 0 in(domains_show) and banner_display_type=6 ";									
			 else
					$sql_banner="select * from tbl_advertisements where 0 in(domains_show) and banner_display_type=1 ";								
		$sql_banner.=" and 1=1 order by rand() limit 1";	
		$res_banner=mysql_query($sql_banner);
		if(mysql_num_rows($res_banner)>0){
			$obj_banner=mysql_fetch_object($res_banner);
			list($name,$ext)=explode('[.]',$obj_banner->banner_image);
			$ext=strtolower($ext);
			if($ext!="swf"){
				$banner_image="ad_banner_images/".$obj_banner->banner_image;
			}else{?>
		<?	}
			$website_url=$obj_banner->website_url;
		}else{			
			$banner_image="images/add_banner.gif";
			$website_url="http://topmatrimonial.thecreativeit.com/";
		}

			$strBanner="";
				$strBanner.="<table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
					$strBanner.="<tr>";
					if ($banner_image != 'images/add_banner.gif') {
						if($ext=='swf'){
						    if(($type=="right_bottom")&&($page=="index")) {
								$strBanner.='<td align="right">
											 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="360" height="90">
											 <param name="movie" value="ad_banner_images/'.$obj_banner->banner_image.'">
											 <param name="quality" value="high">
											 <embed src="ad_banner_images/'.$obj_banner->banner_image.'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="360" height="90"></embed>
											 </object></td>';
							} elseif(($type=="top")&&($page=="index")) {
								$strBanner.='<td align="right">
											 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="356" height="68">
											 <param name="movie" value="ad_banner_images/'.$obj_banner->banner_image.'">
											 <param name="quality" value="high">
											 <embed src="ad_banner_images/'.$obj_banner->banner_image.'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="356" height="68"></embed>
											 </object></td>';
						    } elseif(($type=="top")&&($page=="search")) {
								$strBanner.='<td align="right">
											 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="356" height="68">
											 <param name="movie" value="ad_banner_images/'.$obj_banner->banner_image.'">
											 <param name="quality" value="high">
											 <embed src="ad_banner_images/'.$obj_banner->banner_image.'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="356" height="68"></embed>
											 </object></td>';
						    } elseif(($type=="left")&&($page=="search")) {
								$strBanner.='<td align="center">
											 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="172" height="318">
											 <param name="movie" value="ad_banner_images/'.$obj_banner->banner_image.'">
											 <param name="quality" value="high">
											 <embed src="ad_banner_images/'.$obj_banner->banner_image.'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="172" height="318"></embed>
											 </object></td>';
							} elseif(($type=="bottem")&&($page=="member_login")) {
								$strBanner.='<td align="center">
											 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="175" height="72">
											 <param name="movie" value="ad_banner_images/'.$obj_banner->banner_image.'">
											 <param name="quality" value="high">
											 <embed src="ad_banner_images/'.$obj_banner->banner_image.'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="175" height="72"></embed>
											 </object></td>';
							} elseif(($type=="bottem")&&($page=="image_view")) {
								$strBanner.='<td align="center">
											 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="500" height="72">
											 <param name="movie" value="ad_banner_images/'.$obj_banner->banner_image.'">
											 <param name="quality" value="high">
											 <embed src="ad_banner_images/'.$obj_banner->banner_image.'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="500" height="72"></embed>
											 </object></td>';
							} elseif(($type=="top")&&($page=="widding_directory")) {
								$strBanner.='<td align="right">
											 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="356" height="68">
											 <param name="movie" value="ad_banner_images/'.$obj_banner->banner_image.'">
											 <param name="quality" value="high">
											 <embed src="ad_banner_images/'.$obj_banner->banner_image.'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="356" height="68"></embed>
											 </object></td>';
							} else {														
								$strBanner.='<td align="center">
											 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="356" height="68">
											 <param name="movie" value="ad_banner_images/'.$obj_banner->banner_image.'">
											 <param name="quality" value="high">
											 <embed src="ad_banner_images/'.$obj_banner->banner_image.'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="356" height="68"></embed>
											 </object></td>';
							}
						} else {
							if(($type=="right_bottom")&&($page=="index")) {
								$strBanner.="<td align=\"right\"><a href=\"http://".$website_url."\" target=\"_blank\" style=\"cursor:pointer;\"><img src=\"".$banner_image."\" border=\"0\" width=\"360\" height=\"90\"></a></td>";
							} elseif(($type=="top")&&($page=="index")) {
								$strBanner.="<td align=\"right\"><a href=\"http://".$website_url."\" target=\"_blank\" style=\"cursor:pointer;\"><img src=\"".$banner_image."\" border=\"0\" width=\"356\" height=\"68\"></a></td>";
						    } elseif(($type=="top")&&($page=="search")) {
								$strBanner.="<td align=\"right\"><a href=\"http://".$website_url."\" target=\"_blank\" style=\"cursor:pointer;\"><img src=\"".$banner_image."\" border=\"0\" width=\"356\" height=\"68\"></a></td>";
						    } elseif(($type=="left")&&($page=="search")) {
								$strBanner.="<td align=\"center\"><a href=\"http://".$website_url."\" target=\"_blank\" style=\"cursor:pointer;\"><img src=\"".$banner_image."\" border=\"0\" width=\"172\" height=\"318\"></a></td>";
							} elseif(($type=="bottem")&&($page=="member_login")) {
								$strBanner.="<td align=\"center\"><a href=\"http://".$website_url."\" target=\"_blank\" style=\"cursor:pointer;\"><img src=\"".$banner_image."\" border=\"0\" width=\"175\" height=\"72\"></a></td>";
							} elseif(($type=="bottem")&&($page=="image_view")) {
								$strBanner.="<td align=\"center\"><a href=\"http://".$website_url."\" target=\"_blank\" style=\"cursor:pointer;\"><img src=\"".$banner_image."\" border=\"0\" width=\"500\" height=\"72\"></a></td>";
							} elseif(($type=="top")&&($page=="widding_directory")) {
								$strBanner.="<td align=\"right\"><a href=\"http://".$website_url."\" target=\"_blank\" style=\"cursor:pointer;\"><img src=\"".$banner_image."\" border=\"0\" width=\"356\" height=\"68\"></a></td>";
							} else {														
								$strBanner.="<td align=\"center\"><a href=\"http://".$website_url."\" target=\"_blank\" style=\"cursor:pointer;\"><img src=\"".$banner_image."\" border=\"0\" width=\"356\" height=\"68\"></a></td>";							
							}
						}
					} else {
						$strBanner.="<td align=\"center\">&nbsp;</td>";						
					}
						
					$strBanner.="</tr>";	
				$strBanner.="</table>";	
		echo $strBanner;
	
}
function fnBannerImage1($page,$type){
	
		if(($type=="bottem")&&($page=="member_login"))
			$sql_banner="select * from tbl_advertisements where 0 in(domains_show) and banner_display_type=4 ";											
		$sql_banner.=" and 1=1 order by rand() limit 1";	
		$res_banner=mysql_query($sql_banner);
		if(mysql_num_rows($res_banner)>0){
			$obj_banner=mysql_fetch_object($res_banner);
			list($name,$ext)=split('[.]',$obj_banner->banner_image);
			$ext=strtolower($ext);
			if($ext!="swf"){
				$banner_image="ad_banner_images/".$obj_banner->banner_image;
			}else{?>
		<?	}
			$website_url=$obj_banner->website_url;
		}else{			
			$banner_image="images/add_banner.gif";
			$website_url="http://topmatrimonial.thecreativeit.com/";
		}
			
			$strBanner="";
				//$strBanner.="<table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
					//$strBanner.="<tr>";
					if ($banner_image != 'images/add_banner.gif') {
					    if(($type=="bottem")&&($page=="member_login"))
						if($ext=='swf'){
							$strBanner.='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="272" height="100">
											 <param name="movie" value="ad_banner_images/'.$obj_banner->banner_image.'">
											 <param name="quality" value="high">
											 <embed src="ad_banner_images/'.$obj_banner->banner_image.'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="272" height="100"></embed>
											 </object>';
							}else{
							$strBanner.="<a href=\"http://".$website_url."\" target=\"_blank\" style=\"cursor:pointer;\"><img src=\"".$banner_image."\" border=\"0\" width=\"272\" height=\"100\"></a>&nbsp;&nbsp;";						
							}
					} else {
						$strBanner.="&nbsp;&nbsp;";
					}		
					//$strBanner.="</tr>";	
				//$strBanner.="</table>";	
		echo $strBanner;	
	
}
?>