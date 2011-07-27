<?php
error_reporting(E_ALL); // report all errors
define('ROOT', realPath(dirname(__FILE__).'/..'));
chdir(ROOT);
class LibraryException extends Exception {}
function loadClass($name) {
	Header('X-Autoloaded-Class: '.$name);	
	$classFile = ROOT.'/lib/class.'.$name.'.php';
	if (!file_exists($classFile)) return false;
	require_once($classFile);
	return true;
}
function loadLibrary($name) {
	$libFile = ROOT.'/lib/'.$name.'.php';
	if (!file_exists($libFile)) return false;
	require_once($libFile);
	return true;
}
function useLibraries($name) {
	$wd = getcwd();
	$inRoot = $wd == ROOT;
	if (!$inRoot) chdir(ROOT);
	$names = func_get_args();
	forEach($names as $name) {
		if (loadClass($name)) continue;
		if (loadLibrary($name)) continue;
		throw new LibraryException('Could not locate library: '.$name);
	}
	if (!$inRoot) chdir($wd);
}
spl_autoload_register('loadClass', true);
