<?php
	mysql_connect('localhost','thecrec5_shadb','shadb') or die("count not connect to server");
	mysql_select_db('thecrec5_shadb') or die("not databae");
	$sql  = 'select *from tbl_register';
	echo $sql;
	$result = mysql_query($sql);
	echo mysql_num_rows($result);
?>