<?php
function template($__TEMPLATE, $__LOCALS=null) {
	if ($__LOCALS !== null) extract((array)$__LOCALS);
	$__STRING = String::instance();
	$__ID = substr(md5(mt_rand(0,16777216).microtime(true)), 0, 6);
	
	ob_start();
	if (file_exists('view/'.$__TEMPLATE.'.php')) @include('view/'.$__TEMPLATE.'.php');
	else @include('view/404.php');
	return ob_get_clean();
}
function tag($__TEMPLATE=null, $__LOCALS=null) {
	static $__STACK;
	if (!isset($__STACK)) $__STACK=array();
	if ($__TEMPLATE === null) {
		$__ITEM = array_pop($__STACK);
		$__ITEM->__LOCALS['content'] = ob_get_clean();
		return template($__ITEM->__TEMPLATE, $__ITEM->__LOCALS);
	}
	if ($__LOCALS===null) $__LOCALS = array();
	else $__LOCALS = (array)$__LOCALS;
	$__STACK[]=(object)array(
		'__TEMPLATE'=>'tags/'.$__TEMPLATE,
		'__LOCALS'=>$__LOCALS
	);
	ob_start();
	return '';
}
abstract class MinHtml {
	public static function Start() {
		ob_start();
	}
	public static function End() {
		echo preg_replace('/[\s\r\n\t]+/', ' ', ob_get_clean())."\r\n";
	}
}
