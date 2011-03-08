<?php
function slug($str) {
	return preg_replace('/[^\w\d]/', '_', $str);
}