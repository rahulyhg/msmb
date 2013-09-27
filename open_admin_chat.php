<?
ob_start();
session_start();
if($_REQUEST['uname'] && $_REQUEST['upass']!=""){
	?>
	<script language="javascript">
	url="chat/php121.php?uname=<? echo $_REQUEST['uname'];?>&upass=<? echo $_REQUEST['upass'];?>";
	var newwindow;
	newwindow=window.open(url,'name','height=500,width=280,left=20,top=20,toolbar=no,menubar=no,directories=no,location=no,scrollbars=yes,status=no,resizable=yes,fullscreen=no');
	if (window.focus) {newwindow.focus()}

	</script>
	<?
}
?>