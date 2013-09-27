<?

# Photo image and thumbnail streamer
# Copyright 2005 Rhydio Ltd., all rights reserved
# Licensed to TSS001/0090

include "lib.php";

ini_set("memory_limit","100M");

$id = GetVar("id");
$path = GetVar("path");
# get photo data
$photo = GetSingleField("thumbnail","tbl_photo","userid",$id);


if (($id!="") || ($photo!="")) { 

	//$imagedata = base64_decode($photo); 
	  	
	Header("Content-Type: image/jpeg");
	Header("Content-Disposition: filename=$photo$id.jpg");
	Header("Content-Transfer-Encoding: binary");
	$handle = fopen("../$path", "r");
	$imagedata = fread($handle, filesize("../$path"));	
	fclose($handle);			
	$imagedata=base64_encode($imagedata);
	$imagedata=base64_decode($imagedata);	
				
	if ($_GET["thumbnail"]) {
		
			
		# determine thumbnail mode and extract size

		if (ereg("pc",$_GET["thumbnail"])) {
			$thumbmode = "pc";
			$thumbsize = ereg_replace("pc","",$_GET["thumbnail"]);
			$thumbheight = ereg_replace("pc","",$_GET["height"]);
		}

		if (ereg("px",$_GET["thumbnail"])) {
			$thumbmode = "px";
			$thumbsize = ereg_replace("px","",$_GET["thumbnail"]);
			$thumbheight = ereg_replace("px","",$_GET["height"]);
		}

		# reduce image dimensions
			
		# get source image (from myself)
				
		$sim = imagecreatefromjpeg("../$path");
		
					
		# and its size
		$size = getimagesize("../$path");				
		
		if ($thumbmode == "pc") {
			# reduce dimensions by percentage
			$width = intval(($size[0] / 100) * $_GET["thumbnail"]);
			//$width = $thumbsize;
			$height = intval(($size[1] / 100) * $_GET["thumbnail"]);
			//$height = $thumbheight;
		}

		if ($thumbmode == "px") {
			# reduce dimensions to fixed width with aspect ratio
			$width = $thumbsize;
			$ratio = $size[1] / $size[0];
			$height = $width * $ratio;
			$height = sprintf("%.0f",$height);
			//$height = $thumbheight;
		}

		# create new image and overlay source image
/*
		$dim = imagecreatetruecolor(64,81);
		$bgColor =  imagecolorallocate($dim, 152,28,30);
		imagefill($dim , 0,0 , $bgColor);*/
		$dim = imagecreatetruecolor($width,$height);		
		imagecopyresampled($dim,$sim,0,0,0,0,$width,$height,$size[0],$size[1]);
		if ($_GET["watermark"]) {
			# apply HHH watermark
//			$wim = imagecreatefrompng($config["site"]["path"]."/docs/images/watermark-".$_GET["watermark"].".png");
			$wim = imagecreatefrompng("../images/watermark-".$_GET["watermark"].".png");
			imagecopy($dim,$wim,5,10,0,0,120,80);
		}

	}	
	
	if (!$_GET["thumbnail"]) { Header("Content-Length: ".strlen($imagedata)); }
	
	if ($_GET["thumbnail"]) {
		imagejpeg($dim,"",100);
		
	} else {
		echo $imagedata;
	}
}
?>