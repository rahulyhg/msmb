<?
ob_start();
?><option value="0">Select City</option><?
include("includes/lib.php");
 $sta=$_GET['d'];
 
  echo $select_place="select place_name from citydata where region_name='$sta' order by place_name ASC";
	$result_place=mysql_query($select_place,$link);
	while($plac=mysql_fetch_array($result_place)){
	?>
    <option value="<? echo $plac[0]?>"><? echo $plac[0]?></option>
   <?
	}
	?>
                         