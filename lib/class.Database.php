<?php
class DB extends PDO {
	private static $instance;
	public function __construct() {
		if (isset(self::$instance)) 
			throw new Exception("DB is a singleton.  Please use DB() or DB::instance().");
		$c = Config()->Database;
		parent::__construct($c->dsn, $c->user, $c->pass);
	}
	public static function instance() { 
		if (isset(self::$instance)) return self::$instance;
		return self::$instance = new self(); 
	}
}
function DB() {
	return DB::instance();
}