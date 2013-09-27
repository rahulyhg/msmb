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
	 
	 
function getpageNumbers($total_pages1,$page_no,$page_name,$cboName="",$cboValue=0,$cboName2="",$cboValue2=0,$limit,$total){
	$numargs = func_num_args();
	$qryString = "";
	$index_limit = 10;
	//$iCount=1;
	if($total_pages1>1){
		echo "<table border=0 width='100%'><tr><td align='left'><b>Page :</b> ";
		if (intval($page_no) <= 0)
			$page_no = 1;
		$total_pages = ceil($total / $limit);
		$start = max($page_no - intval($index_limit / 2), 1);
		$end = $start + $index_limit - 1;
		for($iPageCnt=$start;$iPageCnt <= $end && $iPageCnt <= $total_pages;$iPageCnt++){
			if($iPageCnt==$page_no){
				echo "&nbsp;<b>[".$iPageCnt."]</b>&nbsp;";
			} else {
				$numargs<=3 ? $qryString = "page=".$iPageCnt : $qryString = "page=".$iPageCnt."&$cboName=$cboValue&$cboName2=$cboValue2";		
				echo "&nbsp;<a href='$page_name?$qryString'>".$iPageCnt."</a>&nbsp;";
			}
		}
		if ($total_pages > $end) {
				$iPageCnt = $total_pages;
				//echo ' ...';
				//echo '&nbsp; <a href="javascript:paging('.$i.')" title="" class="next">'.$i.'</a> &nbsp;';
			}
		echo " of ".$total_pages1."</td><td align='right'>";
		$prev=$page_no-1;
		$next=$page_no+1;
		if(($page_no<=$total_pages) && ($page_no>1)){
			$numargs<=3 ? $qryString = "page=$prev" : $qryString = "page=$prev&$cboName=$cboValue&$cboName2=$cboValue2";
			echo "&nbsp; <a href='$page_name?$qryString' class='tdred'>Previous</a>"; 
		}
		if(($page_no<$total_pages) && ($page_no>=1)){
			$numargs<=3 ? $qryString = "page=$next" : $qryString = "page=$next&$cboName=$cboValue&$cboName2=$cboValue2";
			echo "&nbsp; <a href='$page_name?$qryString' class='tdred'>Next</a>"; 
		}
		echo "</td></tr></table>";
	}		
}


function getpageNumbers1($total_pages,$page_no,$page_name,$cboName="",$cboValue=0,$cboName2="",$cboValue2=0){
	$numargs = func_num_args();
	$qryString = "";
	if($total_pages>1){
		echo "<table border=0 width='100%'><tr><td align='left'><b>Page :</b> ";
		for($iPageCnt=1;$iPageCnt<=$total_pages;$iPageCnt++){
			if($iPageCnt<=$total_pages){
				if($iPageCnt==$page_no){
					echo "&nbsp;<b>[".$iPageCnt."]</b>&nbsp;";
				} else {
					$numargs<=3 ? $qryString = "page=".$iPageCnt : $qryString = "page=".$iPageCnt."&$cboName=$cboValue&$cboName2=$cboValue2";		
					echo "&nbsp;<a href='$page_name?$qryString&val=".$_REQUEST['val']."'>".$iPageCnt."</a>&nbsp;";
					if($iPageCnt%20==0)
					{
						echo "<br>";
					}
//					echo "&nbsp;<a href='$page_name?$qryString'>".$iPageCnt."</a>&nbsp;";
				}
			} else {
				break;
			}
		}
		echo "</td><td align='right'>";
		$prev=$page_no-1;
		$next=$page_no+1;
		if(($page_no<=$total_pages) && ($page_no>1)){
			$numargs<=3 ? $qryString = "page=$prev" : $qryString = "page=$prev&$cboName=$cboValue&$cboName2=$cboValue2";
			echo "&nbsp; <a href='$page_name?$qryString&val=".$_REQUEST['val']."' class='tdred'><b>Prev</b></a>"; 
		}
		if(($page_no<$total_pages) && ($page_no>=1)){
			$numargs<=3 ? $qryString = "page=$next" : $qryString = "page=$next&$cboName=$cboValue&$cboName2=$cboValue2";
			echo "&nbsp; <a href='$page_name?$qryString&val=".$_REQUEST['val']."' class='tdred'><b>Next</b></a>"; 
		}
		echo "</td></tr></table>";
	}		
}

function getpageNumbers2($total_pages,$page_no,$page_name,$cboName="",$cboValue=0,$cboName2="",$cboValue2=0){
	$numargs = func_num_args();
	$qryString = "";
	if($total_pages>1){
		echo "<table border=0 width='100%'><tr><td align='left'><b>Page :</b> ";
		for($iPageCnt=1;$iPageCnt<=$total_pages;$iPageCnt++){
			if($iPageCnt<=$total_pages){
				if($iPageCnt==$page_no){
					echo "&nbsp;<b>[".$iPageCnt."]</b>&nbsp;";
				} else {
					$numargs<=3 ? $qryString = "page=".$iPageCnt : $qryString = "page=".$iPageCnt."&$cboName=$cboValue&$cboName2=$cboValue2";		
					echo "&nbsp;<a href='$page_name?$qryString&catnum=".$_REQUEST['catnum']."&scatnum=".$_REQUEST['scatnum']."'>".$iPageCnt."</a>&nbsp;";
					if($iPageCnt%20==0)
					{
						echo "<br>";
					}					
//					echo "&nbsp;<a href='$page_name?$qryString'>".$iPageCnt."</a>&nbsp;";
				}
			} else {
				break;
			}
		}
		echo "</td><td align='right'>";
		$prev=$page_no-1;
		$next=$page_no+1;
		if(($page_no<=$total_pages) && ($page_no>1)){
			$numargs<=3 ? $qryString = "page=$prev" : $qryString = "page=$prev&$cboName=$cboValue&$cboName2=$cboValue2";
			echo "&nbsp; <a href='$page_name?$qryString&catnum=".$_REQUEST['catnum']."&scatnum=".$_REQUEST['scatnum']."' class='tdred'><b>Prev</b></a>"; 
		}
		if(($page_no<$total_pages) && ($page_no>=1)){
			$numargs<=3 ? $qryString = "page=$next" : $qryString = "page=$next&$cboName=$cboValue&$cboName2=$cboValue2";
			echo "&nbsp; <a href='$page_name?$qryString&catnum=".$_REQUEST['catnum']."&scatnum=".$_REQUEST['scatnum']."' class='tdred'><b>Next</b></a>"; 
		}
		echo "</td></tr></table>";
	}		
}

?>