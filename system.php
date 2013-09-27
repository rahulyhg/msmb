<?php

	$siteurl = realpath(".");
echo $siteurl."/";

echo "convert ".$siteurl."\cron\model.jpg -resize 100x ".$siteurl."\userthumbnail\model.jpg";

passthru("convert ".$siteurl."\cron\model.jpg -resize 100x ".$siteurl."\userthumbnail\model_1.jpg",$retval);
?>