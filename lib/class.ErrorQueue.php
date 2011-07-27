<?php
class ErrorQueue {
	private $queue = array();
	function __construct($level = null) {
		if ($level === null ) $level = E_ERROR;
		set_error_handler(array($this, 'pushError'), $level);
	}
	function pushError($errno, $errstr, $errfile=null, $errline=null, $errcontext=null) {
		$this->pushException(new ErrorException($errstr, 0, $errno, $errfile, $errline));
	}
	function pushException($exception) {
		$this->queue[] = $exception;
	}
	function EndCapture() {
		restore_error_handler();
		return $this->queue;
	}
}