<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" align="center" cellpadding="0">
		<tr>
			<td valign="top">
			  <table border="0" cellspacing="0" cellpadding="0" align="left">			
			  <tr>
			  	<td valign="top" colspan="3" height="25"><b class="red"><font color="#FF0000">Community Search</font></b></td>
			  </tr>	
			  <tr>
				<td width="15%" valign="top">				
					<b class="red">Caste</b></td>
				<td width="1" align="center">&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;</td>
				<td  valign="top" class="castnew">
				<?
					$sql = "select a.caste,d.domain,d.id as domain_id,a.religionid,b.religion,a.id as caste_id from tbl_caste_master a, tbl_religion_master b, tbl_domain_master d where a.religionid=b.id and b.domain=d.id ";
					$i =0;
					 $caste_sql = $sql . " group by caste order by rand() limit 0,6";
					$search_users = Execute($caste_sql);
					if (mysql_num_rows($search_users) > 0) {	
						while ($user_caste = mysql_fetch_array($search_users)) {
						if($sex=="")
								echo "<a class='cast' href='view_community_list.php?mode=occupation&caste=$user_caste[caste_id]&domain=$user_caste[domain_id]'>$user_caste[caste]</a>&nbsp;| ";										 
						else
								echo "<a class='cast' href='view_community_list.php?mode=occupation&caste=$user_caste[caste_id]&domain=$user_caste[domain_id]&$sex'>$user_caste[caste]</a>&nbsp;| ";										 		
						}					
					} 
					echo "<a class='cast' href='view_community_list.php?mode=cast'>more</a>..";
					 				
					
					
					/*$res = Execute("select * from tbl_caste_master order by rand() limit 0,5");
					if (mysql_num_rows($res) > 0) { 
						while($com_caste = mysql_fetch_array($res)) { 
							//echo "<a class='cast' href='search.php?action=search&caste=$com_caste[caste]'>$com_caste[caste]</a>&nbsp;| ";	
						}			
					}*/
					?>
					</td>			
			  </tr>
			  
			  <tr>
				<td valign="top"><b class="red">Religion</b><td align="center"><b>:</b></td>								
				<td class="castnew" valign="top">
				<?
					mysql_free_result($search_users);
					$i =0;
					$religion_sql = $sql . " group by religion,domain order by rand() limit 0,6";
					$search_users = Execute($religion_sql);
					if (mysql_num_rows($search_users) > 0) {	
						while ($user_religion = mysql_fetch_array($search_users)) {
								echo "<a class='cast' href='view_community_list.php?mode=occupation&domain=$user_religion[domain_id]&religion=$user_religion[religionid]&$sex'>$user_religion[domain] - $user_religion[religion]</a>&nbsp;&nbsp;| ";										 
						}					
					}
					echo "<a class='cast' href='view_community_list.php?mode=religion'>more</a>..";
					mysql_free_result($search_users);
					?>			</td>		  
			  </tr>
			  
			  <tr>
				<td valign="top">
					<b class="red">Education</b><td align="center"><b>:</b></td>
				<td class="castnew" >
				<?
					$sql = "select *  from tbl_education_master";
					$i =0;				
					$education_sql = $sql . " group by education order by rand() limit 0,6";
					$search_users = Execute($education_sql);
					if (mysql_num_rows($search_users) > 0) {	
						while ($user_education = mysql_fetch_array($search_users)) {
								echo "<a class='cast' href='view_community_list.php?mode=occupation&education=$user_education[id]&$sex'>$user_education[education]</a>&nbsp;&nbsp;| ";										 
						}
					}
					echo "<a class='cast' href='view_community_list.php?mode=education'>more</a>..";
					mysql_free_result($search_users);
				?>			</td>	
			  </tr>
			  
			  <tr>
				<td valign="top">
					<b class="red">Occupation</b></td><td align="center" valign="top"><b>:</b></td>
				<td class="castnew" >
				<?
					$sql = "select *  from tbl_occupation_master";
					$i =0;				
					$occupation_sql = $sql . " group by occupation order by rand() limit 0,6";			
					$search_users = Execute($occupation_sql);
					if (mysql_num_rows($search_users) > 0) {	
						while ($user_occupation = mysql_fetch_array($search_users)) {
								echo "<a class='cast' href='search.php?action=search&occupation=$user_occupation[id]&$sex'>$user_occupation[occupation]</a>&nbsp;&nbsp;| ";										 
						}
					echo "<a class='cast' href='view_community_list.php?mode=occupation'>more</a>..";
					} 
				?>			</td>
			   </tr>
			</table>
			</td>		
		</tr>	
		</table>
	</td>
	<?  if($PageName!="Search") {
			fnNewsletter();	
		} ?>
</tr>