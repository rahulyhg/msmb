<?
     //¡ÓË¹´ãËé IE ÍèÒ¹ page ¹Õé·Ø¡¤ÃÑé§ äÁèä»àÍÒ¨Ò¡ cache
     ob_start();
     header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
     header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
     header ("Cache-Control: no-cache, must-revalidate");
     header ("Pragma: no-cache");
     
     header("content-type: application/x-javascript; charset=tis-620");
     
   $data=$_GET['data'];
     $test=$_GET['test'];
  $val=$_GET['val'];
   session_start();
   $_SESSION['value'].=$val."@";
      //$ss.=$val;
     
/*   //¤èÒ¡ÓË¹´¢Í§ °Ò¹¢éÍÁÙÅ
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$dbname="newindia_db";
 
 */
$dbhost="localhost:9956";
$dbuser="newlinda";
$dbpass="Rq0p1WeS@!";
$dbname="newindia_db";
//include("../includes/connection.php");
mysql_pconnect($dbhost,$dbuser,$dbpass) or die ("Unable to connect to MySQL server");  
     
     if ($data=='province') { 
          echo "<select name='m_birth_place' id='m_birth_place' style='width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;' onChange=\"dochange('amper', this.value)\">\n";
          echo "<option value='0'>-Select-</option>\n";
          $result=mysql_db_query($dbname,"select distinct region_name from citydata order by region_name DESC");
          while($category_name=mysql_fetch_array($result)){
               echo "<option value=\"$category_name[0]\" >$category_name[0]</option> \n" ;
          }
          echo "<input type=hidden name=test value='$id'>";
     
	 }
	 else if ($data=='province1') { 
          echo "<select name='f_birth_place' id='f_birth_place' style='width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;' onChange=\"dochange('amper1', this.value)\">\n";
          echo "<option value='0'>-Select-</option>\n";
          $result=mysql_db_query($dbname,"select distinct region_name from citydata order by region_name DESC");
          while($category_name=mysql_fetch_array($result)){
               echo "<option value=\"$category_name[0]\" >$category_name[0]</option> \n" ;
          }
          echo "<input type=hidden name=test value='$id'>";
    
	 }
	 
	   else if ($data=='amper') {
          echo "<select name='m_birth_city' id='m_birth_city' style='width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;' onChange=\"mcom(this.value)\">\n";
          echo "<option value='0'>-Select-</option>\n";
          //$val2=$val;
          //$val = substr($val,0,2); 
          //echo $category_id= $val;                               
          $result=mysql_db_query($dbname,"select place_name from citydata where region_name='$val' order by place_name ASC");
          while($sa=mysql_fetch_array($result)){       
               echo "<option value=\"$sa[0]\" >$sa[0]</option> \n" ;
          }
          echo "<input type=hidden name=test value='$id'>";
		  $_SESSION['sub']= $val;
      
	 }  
	 else if ($data=='amper1') {
          echo "<select name='f_birth_city' id='f_birth_city' style='width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;' onChange=\"fcom(this.value)\">\n";
          echo "<option value='0'>-Select-</option>\n";
          //$val2=$val;
          //$val = substr($val,0,2); 
          //echo $category_id= $val;                               
          $result=mysql_db_query($dbname,"select place_name from citydata where region_name='$val' order by place_name ASC");
          while($sa=mysql_fetch_array($result)){       
               echo "<option value=\"$sa[0]\" >$sa[0]</option> \n" ;
          }
          echo "<input type=hidden name=test value='$id'>";
		  $_SESSION['sub']= $val;
      
	 }  
	 
	 echo "</select>\n";  
	
	
	
	
?>