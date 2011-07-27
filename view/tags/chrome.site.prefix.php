<?php
$location = Config('user-config')->location;
$links = (array)Config('user-config')->links;
Model::load('Catalog');
$catalog = CatalogModel::All();