<?php
require_once(dirname(__FILE__).'/core.php');
useLibraries('slug', 'templating');


$content = Controller::dispatch(
	Request::Subject(), 
	Request::Action(), 
	Request::Args(), 
	Request::Params()
);

echo template('layout', array_merge(Controller::PageSetup(), array('content'=>$content)));
