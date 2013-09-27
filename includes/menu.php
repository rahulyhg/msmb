<?php 
$file = $_SERVER["SCRIPT_NAME"];
$break = Explode('/', $file);
$pfile = $break[count($break) - 1]; 
if ($pfile == 'index.php' || !$config[userinfo]) {
?>
<div style=" width:760px; float:right; order:#00FF00 1px solid;"><a href="index.php" class="language" id="OnPage">Assamese</a><a href="index.php" class="language">Bengali</a><a href="index.php" class="language">Gujarati</a><a href="index.php" class="language">Hindi</a><a href="index.php" class="language">Kannada</a><a href="index.php" class="language">Malayalee</a><a href="index.php" class="language">Marathi</a><a href="index.php" class="language">Marwadi</a><a href="index.php" class="language">Punjabi</a>
<a href="index.php" lass="language" class="language">Tamil</a>
<a href="index.php" class="language">Telugu</a><a href="index.php" class="language">Urdu</a></div>
<? } else { ?>
<table idth="390" width="450" border="0" cellspacing="0" cellpadding="0" align="right">
	<tr>
		<td><a href="index.php" class="language">Home</a></td>			
		<? if ($pfile == 'search.php') { ?>
		<td><a href="search.php"  class="language1">Search</a></td>
		<? } else { ?>
		<td><a href="search.php"  class="language">Search</a></td>
		<? } ?>
		<? if ($pfile == 'payment.php') { ?>
		<td><a href="payment.php"  class="language1">Payment</a></td>
		<? } else { ?>
		<td><a href="payment.php"  class="language">Payment</a></td>
		<? } ?>		
		<? if ($pfile == 'my_matrimony.php') { ?>
		<td><a href="my_matrimony.php"  class="language1">My Matrimony</a></td>
		<? } else { ?>
		<td><a href="my_matrimony.php"  class="language">My Matrimony</a></td>
		<? } ?>		
		<? if ($pfile == 'my_profile.php') { ?>
		<td><a href="my_profile.php"  class="language1">My Profile</a></td>
		<? } else { ?>
		<td><a href="my_profile.php"  class="language">My Profile</a></td>
		<? } ?>			
		<? if ($pfile == 'contact_us.php') { ?>
		<td><a href="contact_us.php" class="language1">Contact Us</a></td>
		<? } else { ?>
		<td><a href="contact_us.php" class="language">Contact Us</a></td>
		<? } ?>	
	</tr>
</table>
<?  } ?>