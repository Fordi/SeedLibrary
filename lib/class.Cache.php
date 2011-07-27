<?php
class Cache implements ArrayAccess, Iterator {	
	private $namespace;
	private $cacheDir;
	private $index;
	private $currentItem;
	private static $webCacheLife = 3600;
	
	private static function age($cacheFile) {
		$stat = stat($cacheFile);
		return mktime()-$stat[9];
	}
	
	public static function cacheVal($namespace, $keys, $value=null, $life=null) {
		$cacheDir = dirname(__FILE__).'/cache/';
		if (!is_dir($cacheDir)) mkdir($cacheDir);
		$cacheId = $namespace.'-'.md5($keys);
		if ($value === null) {
			if (!file_exists($cacheDir.$cacheId)) return null;
			$ret = unserialize(file_get_contents($cacheDir.$cacheId));
			if (!is_object($ret)) return $ret;
			if (empty($ret->___life___)) return $ret;
			$life = $ret->___life___;
			if ($life === -1) return @$ret->___data___;
			$age = self::age($cacheDir.$cacheId);
			if ($life-$age <= 0) return null;
			return @$ret->___data___;
		}
		if (file_exists($cacheDir.$cacheId)) unlink($cacheDir.$cacheId);
		if ($value !== false) 
			file_put_contents($cacheDir.$cacheId, serialize((object)array(
				'___life___'=>$life===null?-1:$life,
				'___data___'=>$value
			)));
		return $value;
	}
	
	function __constructor($namespace) {
		$this->namespace = $namespace;
		$this->rewind();
	}
	
	function __get($name) { return self::cacheVal($this->namespace, $name); }
	function __set($name, $value) { return self::cacheVal($this->namespace, $name, $value); }
	function __isset($name) { $ret = self::cacheVal($this->namespace, $name); return !empty($ret); }
	function __unset($name) { return self::cacheVal($this->namespace, $name, false); }
	
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
	public function urlRequest($url) {
		if (null === ($urlData = cache('Cache;urlRequest', $url))) {
			self::cacheVal('Cache;urlRequest', $url, $urlData = file_get_contents($url), self::$webCacheLife);
		}
		return $urlData;
	}
}
function Cache($namespace, $keys, $value=null, $life=null) {
	return Cache::cacheVal($namespace, $keys, $value, $life);
}
function UrlGetContents($url) {
	return Cache::urlRequest($url);
}

