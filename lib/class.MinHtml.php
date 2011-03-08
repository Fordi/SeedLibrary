<?php
abstract class MinHtml {
	public static function Start() {
		ob_start();
	}
	public static function End() {
		echo preg_replace('/[\s\r\n\t]+/', ' ', ob_get_clean())."\r\n";
	}
}
