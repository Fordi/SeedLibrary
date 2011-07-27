<?php
require_once(dirname(__FILE__).'/../lib/core.php');
class Category extends Controller {
	function __call($name, $args) {
		Model::load('Catalog');
		$cat = $this->data['Category']=CatalogModel::fromSlug($name);
		if (count($cat->children())>0) {
			$this->view = 'Category';
		} else {
			$this->view = 'Family';
		}
		if ($cat->View !== null) $this->view = $cat->View;
	}
}