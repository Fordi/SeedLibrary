<?php
error_reporting(E_ALL); // report all errors
define('ROOT', realPath(dirname(__FILE__).'/..'));
chdir(ROOT);
require_once('lib/slug.php');
require_once('lib/class.Config.php');
require_once('lib/class.Database.php');
require_once('lib/class.String.php');
require_once('lib/class.FirePHP.php');
require_once('lib/class.MinHtml.php');
require_once('lib/templating.php');
require_once('lib/class.Controller.php');
require_once('lib/class.Model.php');


