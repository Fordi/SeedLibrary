<?php
session_start();
require_once(dirname(__FILE__).'/core.php');
$_SERVER['PHP_SELF']=$_REQUEST['rewrite_url'];
unset($_REQUEST['rewrite_url']);
$path = explode('/', preg_replace('/.*'.basename(__FILE__).'\/?(.*)$/', '\1', $_SERVER['PHP_SELF']));
while (count($path)>0 && $path[0]=='') array_shift($path);
if (count($path)==0) $path[] = 'Home';
if (count($path)==1) $path[] = 'index';

echo template('layout', array_merge(Controller::PageSetup(), array(
	'content'=>Controller::dispatch(slug(array_shift($path)), slug(array_shift($path)), $path, $_REQUEST)
)));
