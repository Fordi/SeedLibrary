<?php
class Model implements ArrayAccess, Iterator {
	protected $data;
	public function __construct($data=null) {
		if ($data===null) $data=array();
		$this->data = $data;
	}

	public function __get($name) { return $this->data[$name]; }
	public function __set($name, $value) { $this->data[$name] = $value; }
	public function __isset($name) { return isset($this->data[$name]); }
	public function __unset($name) { unset($this->data[$name]); }
	public function offsetGet($name) { return $this->data[$name]; }
	public function offsetSet($name, $value) { $this->data[$name] = $value; }
	public function offsetExists($name) { return isset($this->data[$name]); }
	public function offsetUnset($name) { unset($this->data[$name]); }
	public function current() { return current($this->data); }
	public function key() { return key($this->data); }
	public function next() { next($this->data); }
	public function rewind() { reset($this->data); }
	public function valid() { return $this->key()===null; }
	
	public static function load($model) {
		$modelName = $model.'Model';
		include_once('mdl/'.$modelName.'.php');
		if (!class_exists($modelName)) $modelName = 'Model';
		return $modelName;
	}
}