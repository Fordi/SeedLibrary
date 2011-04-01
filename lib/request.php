<?php
session_start();
require_once(dirname(__FILE__).'/core.php');
$_SERVER['PHP_SELF']=$_SERVER['PATH_INFO'];
$path = explode('/', preg_replace('/.*'.basename(__FILE__).'\/?(.*)$/', '\1', $_SERVER['PHP_SELF']));
while (count($path)>0 && $path[0]=='') array_shift($path);
if (count($path)==0) $path[] = 'Home';
if (count($path)==1) $path[] = 'index';
$content = Controller::dispatch(
	slug(array_shift($path)), 
	slug(array_shift($path)), 
	$path, 
	$_REQUEST
);
$page = Controller::PageSetup();
echo template('layout', array_merge($page, array('content'=>$content)));
