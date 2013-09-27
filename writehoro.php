<?



$horoscope=urldecode($_POST["RegData"]);
$custid =$_POST["Userid"];
$rasireg=base64_decode($_POST["RegRasi"]);
$navreg=base64_decode($_POST["RegNavamsa"]);
$horofname =$_POST["RegDataFname"];
$rasifname =$_POST["RegRasiFname"];
$navamsafname =$_POST["RegNavamsaFname"];



function writelog($fname,$stext)
{
$fp = fopen($fname,"w");
fwrite($fp,$stext);
fclose($fp);
}


writelog("Reports/".$horofname,$horoscope);
writelog("Reports/".$rasifname,$rasireg);

writelog("Reports/".$navamsafname,$navreg);


echo $horoscope;

?>


