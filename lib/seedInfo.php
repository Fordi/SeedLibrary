<?php
require_once(dirname(__FILE__).'/phpquery.php');
require_once(dirname(__FILE__).'/slug.php');
require_once(dirname(__FILE__).'/class.Cache.php');
class SeedSavers {
	private static function cacheSeed($seedId, $value=null) {
		return cache('seeds', $seedId, $value);
	}
	private static function scrapeSingleSeed($pq) {
		if (!is_object($pq)) {
			//$pq is an ID.
			$id = $pq;
			if (($res=self::cacheSeed($id)) !== null) return $res;
			$url = sprintf(
				'http://www.seedsavers.org/Details.aspx?itemNo=%s', 
				$id
			);
			$pq = phpQuery::newDocumentFile($url);
		} else {
			$id = trim($pq->find('#ctl00_mPageContent_lblShortNumber')->text());
			if (($res=self::cacheSeed($id)) !== null) return $res;
		}
		$nameField = $pq->find('#ctl00_mPageContent_lblTitle');
		if ($nameField->count() == 0) return null;
		$name = $nameField->text();
		
		$image = 'http://www.seedsavers.org'.$pq->find('#ctl00_mPageContent_lblImage img')->attr('src');
		$local = '/seed-images/'.md5($image).'.jpg';
		$lfs = dirname(__FILE__).'/../webroot'.$local;
		if (!file_exists($lfs))
			copy ($image, $lfs);
		
		$desc = trim($pq->find('#ctl00_mPageContent_lblDescription .style3:first, #ctl00_mPageContent_lblDescription')->eq(0)->text());
		$latin = '';
		if (preg_match('/^\(([^\)]*)\)(.*)$/Uis', $desc, $regs)) {
			$latin = $regs[1];
			$desc = trim($regs[2]);
		}
		$attributes = $pq->find('#ctl00_mPageContent_lblDescription .style3 .style1');
		$atts = array();
		forEach($attributes as $attribute) {
			$nvp = preg_split('/[\r\n]+/', pq($attribute)->text());
			$atts[trim(camelize($nvp[0]))] = trim($nvp[1]);
		}
		$seedInfo = array(
			'Id' => $id,
			'Name' => $name,
			'Image' => $local,
			'Latin' =>$latin,
			'Description' => $desc,
			'Attributes'=>(object)$atts
		);
		
		//encache the seed object
		return self::cacheSeed($id, (object)$seedInfo);
	}
	private static function cacheSearch($keys, $value=null) {
		return cache('seedsearch', $keys, $value);
	}
	static function search($keys) {
		$results = self::cacheSearch($keys);
		if ($results === null) {
			$url = sprintf(
				'http://www.seedsavers.org/Items.aspx?search=%s', 
				urlEncode($keys)
			);
			$pq = phpQuery::newDocumentFile($url);
			$items = $pq->find('.ItemBox a span')->parents('a');
			if ($items->count()==0) {
				$results = array(self::scrapeSingleSeed($pq)->Id);
			} else {
				$results = array();
				forEach($items as $item) {
					$url = pq($item)->attr('href');
					$id = trim(preg_replace('/^.*[\&\?]itemNo=([^\&\?]+).*?$/i', '\1', $url));
					$results[]=$id;
				}
			}
		}
		self::cacheSearch($keys, $results);
		forEach($results as $index=>$id) {
			if (!is_numeric(substr($id,0,1))) unset($results[$index]);
			else $results[$index]=self::scrapeSingleSeed($id);
		}
		sort($results);
		return $results;
	}
}
