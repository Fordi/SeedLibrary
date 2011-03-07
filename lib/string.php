<?php
class String implements ArrayAccess {
	private static $instance;
	private static $getString;
	private static $setString;
	private static $dropString;
	private $dbCache;
	private function __construct() {
		$this->dbCache = array();
		if (!isset(self::$getString)) {
			$locale = self::locale();
			self::$getString = DB()->prepare(
				'SELECT `string` FROM `string` '.
				'WHERE `locale` = "'.$locale.'" '.
					'AND `name` = :name'
			);
			self::$setString = DB()->prepare(
				'REPLACE INTO `string` SET '.
					'`locale` = "'.$locale.'", '.
					'`name` = :name, '.
					'`string` = :string '.
				'WHERE `locale` = "'.$locale.'" '.
					'AND `name` = :name'
			);
			self::$dropString = DB()->prepare(
				'DELETE FROM `string` '.
				'WHERE `locale` = '.$locale.' '.
					'AND `name` = :name'
			);
		}
	}
	private static function locale() {
		return 'en_US';
	}
	function offsetExists($name) {
		$x = $this[$name];
		return !empty($x);
	}
	function offsetGet($name) {
		if (!empty($this->dbCache[$name])) return $this->dbCache[$name];
		self::$getString->bindValue(':name', $name, PDO::PARAM_STR);
		self::$getString->execute();
		
		$count = self::$getString->rowCount();
		if ($count == 0) {
			self::$getString->closeCursor();
			$this->dbCache[$name]='';
			return null;
		}
		$res = self::$getString->fetch(PDO::FETCH_ASSOC);
		self::$getString->closeCursor();
		return $this->dbCache[$name] = $res['string'];
	}
	function offsetSet($name, $value) {
		self::$setString->execute(array('name'=>$name, 'string'=>$value));
		self::$getString->closeCursor();
		$this->dbCache[$name] = $value;
	}
	function offsetUnset($name) {
		self::$dropString->execute(array('name'=>$name));
		unset($this->dbCache[$name]);
	}
	public static function instance() { 
		if (isset(self::$instance)) return self::$instance;
		return self::$instance = new self(); 
	}
	public static function ExportRequested() {
		$out="INSERT INTO `string` (`locale`, `name`, `string`) VALUES\r\n";
		$values = array();
		forEach(self::instance()->dbCache as $key=>$value) {
			$values[]="\t(\"en_US\", \"$key\", \"".htmlentities(addslashes($value))."\")";
		}
		$out.=join(",\r\n", $values).";";
		return $out;
	}
}
function String($key) {
	$inst = String::instance();
	$str = $inst[$key];
	if (!isset($str)) $str = '??? TNF: '.$key.' ???';
	return $str;
}