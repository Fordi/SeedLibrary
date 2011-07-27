<?php
abstract class Test {
	private static function mean($array) {
		return array_sum($array) / count($array);
	}
	private static function dev($array) {
		$mean = self::mean($array);
		$sum = 0;
		forEach ($array as $item) 
			$sum+=pow($item-$mean, 2);
		return sqrt($sum/count($array));
	}
	public static function simplePerformance($lambda, $args=null, $totalTime=10) {
		if (empty($args)) $args=array();
		$allStart = microtime(true);
		$cps = array();
		$tpc = array();
		$n = array();
		while (microtime(true) - $allStart < $totalTime) {
			$count = 0;
			$start = microtime(true);
			$timeout = mt_rand(1,256)/65536;
			while (($time = microtime(true)-$start) < $timeout) {
				call_user_func_array($lambda, $args);
				$count++;
			}
			$cps[]=$count/$time;
			$tpc[]=$time/$count;
		}
		return (object)array(
			'Hz'=>(object)array(
				'mean'=>self::mean($cps),
				'dev'=>self::dev($cps)
			),
			'time'=>(object)array(
				'mean'=>self::mean($tpc),
				'dev'=>self::dev($tpc)
			)
		);
	}
}