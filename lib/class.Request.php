<?php
require_once(dirname(__FILE__).'/core.php');
useLibraries('slug');

class Request {
	private static $_URI;
	private static $_Action;
	private static $_Subject;
	private static $_Args;
	static function init() {
		if (!empty(self::$_URI)) return;
		if (!empty($_SERVER['HTTP_HOST'])) {
			session_start();
			if (!empty($_SERVER['PATH_INFO']))
				$_SERVER['PHP_SELF']=$_SERVER['PATH_INFO'];
		} else {
			$_SERVER['PHP_SELF']='';
		}
		self::$_URI = preg_replace('/.*'.basename(__FILE__).'\/?(.*)$/', '\1', $_SERVER['REQUEST_URI']);
		$path = explode('/', self::$_URI);
		while (count($path)>0 && $path[0]=='') array_shift($path);
		if (count($path)==0) $path[] = 'Home';
		if (count($path)==1) $path[] = 'index';
		self::$_Subject = slug(array_shift($path));
		self::$_Action = slug(array_shift($path));
		self::$_Args = $path;
	}
	static function URI() {
		self::init();
		return self::$_URI;
	}
	static function Subject() {
		self::init();
		return self::$_Subject;
	}
	static function Action() {
		self::init();
		return self::$_Action;
	}
	static function Args() {
		self::init();
		return self::$_Args;	
	}
	static function Params() {
		self::init();
		return $_REQUEST;
	}
	function __construct() {}
}

