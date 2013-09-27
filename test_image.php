<?php
ob_start();
session_start();
include("includes/lib.php");
$action = GetVar("action");
include("common/image_crop.php");
//$image_magic = new pb_imageMagick;
$siteurl = realpath(".");

//system("convert ".$siteurl."cron/model.jpg -resize 100x ".$siteurl."userthumbnail/model.jpg",$retval);
passthru("-gravity center -geometry 100x100! -crop 100x100+0+0 -compress JPEG -quality 100 {$imagePath} {$outputPath}");


//$result = crop(100,100,$siteurl\."model.jpg",$siteurl\."$outputpath");

/*function crop($maxW,$maxH,$imagepath,$outputPath="image",$quality=90) {


		list($newW,$newH) = calcCrop($imagepath,$maxW,$maxH);
		$binary = "/usr/bin/convert"; // use "magic" or "gd" system;
		$exec="{$binary} -gravity center -geometry {$newW}x{$newH}! -crop {$maxW}x{$maxH}+0+0 -compress JPEG -quality {$quality} {$imagePath} {$outputPath}";
		//echo $exec;
		passthru($exec);

}

function calcCrop($imagepath,$maxW,$maxH) {
	$data = getImageSize($imagePath);
	$imageW = $data[0];
	$imageH = $data[1];
	$pcW = $maxW / $this->imageW;
	$pcH = $maxH / $this->imageH;
	$scale = max($pcW,$pcH);
	$newW = number_format($this->imageW * $scale,2);
	$newH = number_format($this->imageH * $scale,2);
	$dimensions[]=$newW;
	$dimensions[]=$newH;
	return $dimensions;
}

*/
?>