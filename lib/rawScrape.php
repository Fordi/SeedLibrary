<?php
useLibraries(phpquery);
function rawScrape($htmlSnippet, $selector, $populators) {
	$pq = phpQuery::newDocumentHTML($htmlSnippet);
	$ret = array();
	forEach($populators as $name=>$populator) {
		$populator = explode('|', $populator);
		$populators[$name]=(object)array(
			'sel'=>array_shift($populator),
			'mth'=>empty($populator)?'html':array_shift($populator)
		);
	}
	forEach ($pq[$selector] as $item) {
		$item = pq($item);
		$val = array();
		forEach($populators as $name=>$pop) {
			$val[$name] = call_user_func(array($item[$pop->sel], $pop->mth));
		}
		$ret[]=(object)$val;
	}
	return $ret;
}