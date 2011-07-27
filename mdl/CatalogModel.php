<?php
require_once(dirname(__FILE__).'/../lib/core.php');
useLibraries('DB');
class CatalogModel extends Model {
	static private $table='catalog';
	static private $db;
	static private $columns = array('ID', 'Name', 'Slug', 'Parent', 'View', 'Badge');
	static private $cache = array();

	static function initialize() {
		if (isset(self::$db)) return;
		if (empty(self::$cache)) self::$cache = array();	
		$columns = '`'.join('`, `', self::$columns).'`';
		$table = '`'.self::$table.'`';
		self::$db = (object)array(
			'ByParent'=>DB()->prepare(
				'SELECT  '.$columns.' FROM '.$table.' WHERE Parent=:Parent'
			),
			'BySlug'=>DB()->prepare(
				'SELECT '.$columns.' FROM '.$table.' WHERE Slug=:Slug'
			),
			'ByID'=>DB()->prepare(
				'SELECT '.$columns.' FROM '.$table.' WHERE ID=:ID'
			)
		);
		forEach(self::fromSlug(Request::URI())->breadcrumb() as $category) $category->active = true;
	}
	private static function fromResult($result) {
		if (!empty(self::$cache[$result['ID']]))
			return self::$cache[$result['ID']];
		$obj = new self();
		$obj->data = &$result;
		self::$cache[$result['ID']] = &$obj;
		return $obj;
	}	
	public static function fromSlug($subject) {
		$subject = str_replace('/category/', '', strToLower($subject));
		$q = self::$db->BySlug;
		$q->bindValue(':Slug', $subject);
		$q->execute();
		$result = $q->fetch(PDO::FETCH_ASSOC);
		$result = self::fromResult($result);
		
		return $result;
	}
	public static function fromId($id) {
		if ($id==-1) return null;
		if (!empty(self::$cache[$id])) return self::$cache[$id];
		$q = self::$db->ByID;
		$q->bindValue(':ID', $id);
		$q->execute();
		$result = $q->fetch(PDO::FETCH_ASSOC);
		$result = self::fromResult($result);
		return $result;
	}
	public static function All() {
		return self::childrenOf(-1);
	}
	public static function childrenOf($root=-1) {
		$q = self::$db->ByParent;
		$q->bindValue(':Parent', $root);
		$q->execute();
		$results = $q->fetchAll(PDO::FETCH_ASSOC);
		$ret = array();
		forEach ($results as $result) {
			$ret[] = &self::fromResult($result);
		}
		return $ret;
	}
	public function isHeirOf(CatalogModel $catalog) {
		//i.e., is or is child of
		forEach ($this->breadcrumb() as $cat) {
			if ($cat->ID == $catalog->ID) return true;
		}
		return false;
	}
	public function parent() {
		return self::fromId($this->data['Parent']);
	}
	public function breadcrumb() {
		$dad = $this->parent();
		if ($dad===null) return array($this);
		$bread = $dad->breadcrumb();
		$bread[] = $this;
		return $bread;
	}
	public function children() {
		return self::childrenOf($this->data['ID']);
	}
	public function products() {
		Model::load('Product');
		return ProductModel::listFromCategory($this);
	}
	
	
}
CatalogModel::initialize();
