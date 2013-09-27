<?
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
$linkid=db_connect();
if($_REQUEST['selval']!=""){
$sql="select * from tbl_wedding_category where parent_category='".$_REQUEST['selval']."'";
$r=mysql_query($sql);

if(mysql_num_rows($r)>0)
{
  $string="";	
  while($res=mysql_fetch_object($r))
   {
   $string.=$res->category_id."_".$res->category_name."/"; 
   }
}
echo $string;
}
?>