<?php
require_once(dirname(__FILE__).'/../lib/core.php');
useLibraries('DB');
class ProductModel extends Model {
	static private $table='product';
	static private $db;
	static private $columns = array('ID', 'Name', 'Slug', 'Parent', 'View', 'Badge');
	static private $cache = array();

	static function initialize() {
		Model::load('Catalog');
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
	}
	static function listFromCategory(CatalogModel $category) {
		return array();
	}
}
ProductModel::initialize();
