<?php
class Config {
	private $obj;
	private static $instances;
	private function __construct($name) {
		if (empty(self::$instances)) self::$instances = array();
		if (!empty(self::$instances[$name])) 
			throw new Exception('Only use Config::getInstance');
		$this->obj = (array)json_decode(file_get_contents('conf/'.$name.'.json'));
		self::$instances[$name]=$this;
	}
	public static function getInstance($name) { 
		if (empty(self::$instances)) return new self($name);
		if (empty(self::$instances[$name])) return new self($name);
		return self::$instances[$name];
	}
	function __get($name) {
		if (isset($this->obj[$name])) return $this->obj[$name];
		return null;
	}
}
function Config($name) {
	return Config::getInstance($name);
}