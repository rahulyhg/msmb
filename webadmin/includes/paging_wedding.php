<?
class Pager
	{
	function getPagerData($numHits, $limit, $page)
		{
			$numHits  = (int) $numHits;
			$limit    = max((int) $limit, 1);
			$page     = (int) $page;
			$numPages = ceil($numHits / $limit);
			$page = max($page, 1);
			$page = min($page, $numPages);
			$offset = ($page - 1) * $limit;
			$ret = new stdClass;
			$ret->offset   = $offset;
			$ret->limit    = $limit;
		//	$ret->limit	= 15;
			$ret->numPages = $numPages;
			$ret->page     = $page;
			return $ret;
		}
	 }
	 
	 
function getpageNumbers($total_pages,$page_no,$page_name,$id,$cboName="",$cboValue=0,$cboName2="",$cboValue2=0){
	$numargs = func_num_args();
	$qryString = "";
	if($total_pages>1){
		echo "<table border=0 width='100%'><tr><td align='left'><b>Page :</b> ";
		for($iPageCnt=1;$iPageCnt<=$total_pages;$iPageCnt++){
			if($iPageCnt<=$total_pages){
				if($iPageCnt==$page_no){
					echo "&nbsp;<b>[".$iPageCnt."]</b>&nbsp;";
				} else {
					$numargs<=3 ? $qryString = "page=".$iPageCnt : $qryString = "page=".$iPageCnt."&$zone=".$_REQUEST['cmbZone'];		
					echo "&nbsp;<a href='$page_name?$qryString&zone=".$_REQUEST['cmbZone']."&dirid=".$id."'>".$iPageCnt."</a>&nbsp;";
				}
			} else {
				break;
			}
		}
		echo "</td><td align='right'>";
		$prev=$page_no-1;
		$next=$page_no+1;
		if(($page_no<=$total_pages) && ($page_no>1)){
			$numargs<=3 ? $qryString = "page=$prev" : $qryString = "page=$prev&$zone=".$_REQUEST['cmbZone'];
			echo "&nbsp; <a href='$page_name?$qryString&zone=".$_REQUEST['cmbZone']."&dirid=".$id."' class='tdred'><b>Prev</b></a>"; 
		}
		if(($page_no<$total_pages) && ($page_no>=1)){
			$numargs<=3 ? $qryString = "page=$next" : $qryString = "page=$next&$zone=".$_REQUEST['cmbZone'];
			echo "&nbsp; <a href='$page_name?$qryString&zone=".$_REQUEST['cmbZone']."&dirid=".$id."' class='tdred'><b>Next</b></a>"; 
		}
		echo "</td></tr></table>";
	}		
}
?>