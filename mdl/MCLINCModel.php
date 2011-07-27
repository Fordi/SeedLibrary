<?php
require_once(dirname(__FILE__).'/../lib/core.php');
useLibraries(
	'Model',
	'Cache'
);
class MCLINCModelException extends Exception {}
class MCLINCModel extends Model {
	static $defaultDataFile = 'MCLINCData.html';
	static private $instance = null;
	static function fromDataFile($file, $force=false) {
		$cacheId = 'Inventory-'.md5(realPath($file));
		if (null !== ($ret = cache('MCLINC', $cacheId)) && !$force) return $ret;
		$rawData = rawScrape(
			file_get_contents($file), 
			'tr.piece', 
			array(
				'name'=>'td.piecefront td[width]',
				'avail'=>'td.piece:first'
			)
		);
		$set = array();
		forEach($rawData as $item) {
			$name = str_replace('ADULT SEED KIT  ', '', $item->name);
			if (!isset($set[$name])) $set[$name] = (object)array('name'=>$name, 'total'=>0, 'avail'=>0);
			$set[$name]->total++;
			if (strToLower(substr($item->avail,0,2))=='in')
				$set[$name]->avail++;
		}
		return cache('MCLINC', $cacheId, $set);
	}
	static function initialize() {
		$dataFile = realPath(dirname(__FILE__).'/../data/'.self::$defaultDataFile);
		if (file_exists($dataFile))
			self::$instance = new MCLINCModel(self::fromDataFile($dataFile));
		else throw new MCLINCModelException($dataFile.' does not exist; please provide copy of availability asp output from MCLINC');
	}
	static function getInstance() {
		return self::$instance;
	}
}
function MCLINC() {
	return MCLINCModel::getInstance();
}
MCLINCModel::initialize();