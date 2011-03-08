<?php
class Config {
	private $obj;
	private static $instance;
	private function __construct() {
		$this->obj = (array)json_decode(file_get_contents('conf/database.json'));
	}
	public static function instance() { 
		if (isset(self::$instance)) return self::$instance;
		return self::$instance = new self(); 
	}
	function __get($name) {
		if (isset($this->obj[$name])) return $this->obj[$name];
		return null;
	}
}
function Config() {
	return Config::instance();
}