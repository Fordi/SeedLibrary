<?php
class Controller {
	protected $view = 'index';
	protected $action = 'index';
	protected $viewClass = '';
	protected $formData = array();
	protected $data = array();
	public function render() {
		return template($this->viewClass.'/'.$this->view, array_merge(
			$this->data,
			array(
				'form'=>$this->formData,
				'Controller'=>$this->viewClass,
				'Action'=>$this->action
			)
		));
	}
	public function index() {
	}
	protected static $pageTitle = '';
	protected static $pageClass = '';
	public static function PageSetup() {
		return array(
			'pageClass'=>self::$pageClass,
			'pageTitle'=>self::$pageTitle
		);
	}
	public static function dispatch($ctl='Home', $act='index', $args=null, $request=null) {
		if ($args===null) $args = array();
		if ($request===null) $request = array();
		@include_once('ctl/'.$ctl.'.php');
		if (class_exists($ctl)) {
			$class = new $ctl();
		} else {
			$class = new self();
		}
		$class->formData = $request;
		$class->viewClass = $ctl;
		$class->view = $act;
		$class->action = $act;
		call_user_func(array($class, $act), $args);
		return $class->render();
	}
	public static function URL($controller='Home', $action='index', $args=null, $request=null) {
		if ($args===null) $args = array();
		if ($request===null) $request = array();
		array_unshift($args, $action);
		array_unshift($args, $controller);
		$path = '/'.join('/', $args);
		$params = array();
		forEach($request as $name=>$value) 
			$params[] = urlEncode($name).'='.urlEncode($value);
		if (count($params)>0) $path.='?'.join('&', $params);
		return $path;
	}
	public static function Redirect($controller='Home', $action='index', $args=null, $request=null) {
		$url = self::URL($controller, $action, $args, $request);
		Header('Location: '.$url);
		exit();
	}
}