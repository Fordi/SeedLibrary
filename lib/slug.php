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

class Cache implements ArrayAccess, Iterator {	
	private $namespace;
	private $cacheDir;
	private $index;
	private $currentItem;

	public static function cache($namespace, $keys, $value=null) {
		$cacheDir = dirname(__FILE__).'/cache/';
		if (!is_dir($cacheDir)) mkdir($cacheDir);
		$cacheId = $namespace.'-'.md5($keys);
		if ($value === null) {
			if (!file_exists($cacheDir.$cacheId)) return null;
			return unserialize(file_get_contents($cacheDir.$cacheId));
		}
		if (file_exists($cacheDir.$cacheId)) unlink($cacheDir.$cacheId);
		if ($value !== false) 
			file_put_contents($cacheDir.$cacheId, serialize($value));
		
		return $value;
	}
	
	function __constructor($namespace) {
		$this->namespace = $namespace;
		$this->rewind();
	}
	
	function __get($name) { return self::cache($this->namespace, $name); }
	function __set($name, $value) { return self::cache($this->namespace, $name, $value); }
	function __isset($name) { return !empty(self::cache($this->namespace, $name)); }
	function __unset($name) { return self::cache($this->namespace, $name, false); }
	
	function offsetExists($name) { return $this->__isset($name); }
	function offsetGet($name) { return $this->__get($name); }
	function offsetSet($name, $value) { return $this->__set($name, $value); }
	function offsetUnset($name) { return $this->__unset($name); }
	
	public function rewind() {
		$path = dirname(__FILE__).'/cache/';
		$this->cacheDir = dir($path);
		$this->next();
	}
	
	public function key() { return null; }
	public function next() {
		$path = dirname(__FILE__).'/cache/';
		$space = $this->namespace.'-';
		$spl = strlen($space);
		while (false !== ($en = $this->cacheDir->read())) {
			if (is_dir($path.$en)) continue;
			if (substr($en,0,$spl)!=$space) continue;
			$this->currentItem = unserialize(file_get_contents($path.$en));
			return;
		}
		$this->currentItem = false;
	}
	public function current() { return $this->currentItem; }
	public function valid() { return $this->currentItem !== false; }
}
function Cache($namespace, $keys, $value=null) {
	return Cache::cache($namespace, $keys, $value);
}

