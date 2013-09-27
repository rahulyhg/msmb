<?
$_SERVER['FULL_URL'] = 'http';
$script_name = '';
if(isset($_SERVER['REQUEST_URI'])) {
    $script_name = $_SERVER['REQUEST_URI'];
} else {
    $script_name = $_SERVER['PHP_SELF'];
    if($_SERVER['QUERY_STRING']>' ') {
        echo $script_name .=  '?'.$_SERVER['QUERY_STRING'];
    }
}
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') {
    $_SERVER['FULL_URL'] .=  's';
}
$_SERVER['FULL_URL'] .=  '://';
if($_SERVER['SERVER_PORT']!='80')  {
    $_SERVER['FULL_URL'] .=
     $_SERVER['HTTP_HOST'].':'.$_SERVER['SERVER_PORT'].$script_name;
} else {
    $_SERVER['FULL_URL'] .=  $_SERVER['HTTP_HOST'].$script_name;
}

 $path1=$_SERVER['FULL_URL'];
 $sss=base64_encode($path1);
  $_SERVER['FULL_URL'];
 
$ss=explode("://",$path1);
$pppath=$ss[1];
$ss22=explode("/",$pppath);
$pppath12=$ss22[0];

//$urlpath="http://".$pppath12."/NM/";
$urlpath="http://".$pppath12."/";
//$path="http://192.168.0.12/kongunew/";
?>