<?php
function slug($str) {
	return preg_replace('/[^\w\d]/', '_', $str);
}
function camelize($name) {
	$x = preg_split('/[^\w\d]+/', $name, -1, PREG_SPLIT_NO_EMPTY);
	$x[0] = strToLower($x[0]);
	for ($i=1; $i<count($x); $i++)
		$x[$i] = strToUpper(substr($x[$i],0,1)).strToLower(substr($x[$i],1));
	return join('', $x);
}
