<?php
require_once(dirname(__FILE__).'/core.php');
useLibraries('Cache');
function template($__TEMPLATE, $__LOCALS=null) {
	$__ERRORS = new ErrorQueue();
	if ($__LOCALS !== null) extract((array)$__LOCALS);
	$__STRING = String::instance();
	$__ID = substr(md5(mt_rand(0,16777216).microtime(true)), 0, 6);
	
	if (file_exists('view/'.$__TEMPLATE.'.prefix.php')) {
		include('view/'.$__TEMPLATE.'.prefix.php');
	}
	ob_start();
	try {
		if (file_exists('view/'.$__TEMPLATE.'.php')) @include('view/'.$__TEMPLATE.'.php');
		else @include('view/404.php');
	} catch (Exception $e) {
		$q->pushException($e);
	}
	$__CONTENT = ob_get_clean();
	$__ERRORS = $__ERRORS->EndCapture();
	ob_start();
	@include('view/phpErrors.php');
	echo ob_get_clean();
	return $__CONTENT;
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
