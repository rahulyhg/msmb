<?php

class pb_imageGeneric { 
	
	var $imagePath;
	var $imageType;
	var $imageW;
	var $imageH;
	
	function pb_imageGeneric($imagePath) {
		$this->imagePath=$imagePath;
		$this->getImageSizeAndType();
	}
	
	function returnImageType($type) {
		$imageType = explode(",","NONE,GIF,JPG,PNG,SWF,PSD,WBMP,TIF");
		return $imageType[$type];
	}
	
	function getImageSizeAndType() {
	
		$data = getImageSize($this->imagePath);
		$this->imageW = $data[0];
		$this->imageH = $data[1];
		$this->imageType = $this->returnImageType($data[2]);
	}
	
	
	function calcResize($maxW,$maxH) {
	
		$pcW = $maxW / $this->imageW;
		$pcH = $maxH / $this->imageH;
		if ($pcH >= $pcW) {
			$scale = $pcW;
			$newW = $maxW;
			$newH = intval($this->imageH * $scale);
		} else {
			$scale = $pcH;
			$newW = intval($this->imageW * $scale);
			$newH = $maxH;
		}
		$dimensions[]=$newW;
		$dimensions[]=$newH;
		return $dimensions;
	}
	
	function calcCrop($maxW,$maxH) {
	
		$pcW = $maxW / $this->imageW;
		$pcH = $maxH / $this->imageH;
		$scale = max($pcW,$pcH);
		$newW = number_format($this->imageW * $scale,2);
		$newH = number_format($this->imageH * $scale,2);
		$dimensions[]=$newW;
		$dimensions[]=$newH;
		return $dimensions;
	}

}

class pb_imageMagick extends pb_imageGeneric {
	
	function pb_imageMagick($imagePath) {
		global $CONST;
		$this->imagePath=$imagePath;
		$this->getImageSizeAndType();
		//$this->binary = $CONST['libPB']['image']['bin']['convert'];
	}
	
	function resample($maxW,$maxH,$outputPath,$quality=90) {
		global $CONST;
		$newW=$maxW;
		$newH=$maxH;
		//$exec="{$this->binary} -thumbnail {$newW}x{$newH} -unsharp 1x3+1+.08 -compress JPEG -quality {$quality} {$this->imagePath} {$outputPath}";
		$exec="convert -resize {$newW}x{$newH} -unsharp 1x3+2+.08 -compress JPEG -quality {$quality} {$this->imagePath} {$outputPath}";
		passthru($exec);
		pb_core::debug($exec);
		if (file_exists($outputPath)) {
			return true;
		} else {
			return false;
		}
	}
	
	//function createFile()
	
	function crop($maxW,$maxH,$outputPath="image",$quality=90) {
	
		# another image crop code
		
		/*
			system("convert ".DIR_FS_CATALOG_IMAGES.str_replace(" ",'\ ',$products_image_name)." -resize x130 ".DIR_FS_CATALOG_IMAGES."small/".str_replace(" ",'\ ',$products_image_name),$retval);
			
            system("convert ".DIR_FS_CATALOG_IMAGES."$products_image_name -resize 130x ".DIR_FS_CATALOG_IMAGES."small/$products_image_name",$retval);
		
		*/
		global $CONST;
		list($newW,$newH) = $this->calcCrop($maxW,$maxH);
		$binary = "/usr/bin/convert"; // use "magic" or "gd" system;
		$exec="convert -gravity north -geometry ".$newW."x".$newH."! -crop ".$maxW."x".$maxH."+0+0 -compress JPEG -quality ".$quality." ".$this->imagePath." ".$outputPath;
		//echo $exec;
		passthru($exec);
		
		if (file_exists($outputPath)) {
			return true;
		} else {
			return false;
		}
	}
	
}