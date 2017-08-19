<?php
	header("Content-type:text/html;Charset=utf-8");
class Page{

	public static function getPageString($counts,$controller,$action,$plat,$pagecount = 5,$page = 1){
		$pages = ceil($counts / $pagecount);
		$url = 'Page.class.php?p=' . $plat . '&m=' .$controller . '&a=' . $action;
		$prev = $page >1 ? $page -1 : 1;
		$next = $page <$pages ? $page +1 : $pages;
		$pagestring = '';
		if($page >1) $pagestring .= "<a href='{$url}&page={$prev}'>上一页</a>";
		if($pages <= 10){
			for ($i=1; $i <= $pages ; $i++) { 
				$pagestring .= "<a href='{$url}&page={$i}'>{$i}</a>";
			}
			if($page != $pages ) $pagestring .= "<a href='{$url}&page={$next}'>下一页</a>";
			return $pagestring;
		}
		if($page > 6){
			if($page + 4 <= $pages){
				for ($i=$page-5; $i <= $page+4 ; $i++) { 
					$pagestring .= "<a href='{$url}&page={$i}'>{$i}</a>";
				}				
			}else{
				for ($i=$pages - 9; $i <= $pages; $i++) { 
					$pagestring .="<a href='{$url}&page={$i}'>{$i}</a>";
				}
			}
		}else{
			for ($i=1; $i < 10; $i++) { 
				$pagestring .= "<a href='{$url}&page={$i}'>{$i}</a>";
			}
		}
		if($page != $pages)  $pagestring .= "<a href='{$url}&page={$next}'>下一页</a>";
		return $pagestring;
	}
}
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
echo Page::getPageString(100,'','','',9,$page);