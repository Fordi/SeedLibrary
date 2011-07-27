<?php
require_once(dirname(__FILE__).'/../lib/core.php');
class User extends Controller {
	function __construct() {
		Model::load('User');
	}
	function index() {
		$args = func_get_args();
		Controller::Redirect("User", "Login", $args, $this->formData);
	}
	function Login() {
		$current = UserModel::loggedInUser();
		if (!empty($current)) Controller::Redirect("Home", "Dashboard");
		$email = @$this->formData['Email'];
		$pass = @$this->formData['Password'];
		if (empty($email) || empty($pass)) return;
		$userData = UserModel::fromLogin($email, $pass);
		if ($userData === null) {
			$this->data['badLogin']=true;
			return;
		}
		Controller::Redirect("Home", "Dashboard");
	}
	
	function Logout() {
		UserModel::Logout();
		Controller::Redirect("Home", "index", $args, $this->formData);
	}
	function Register() {
		$current = UserModel::loggedInUser();
		if (!empty($current)) Controller::Redirect("Home", "Dashboard");
		if (strlen($this->formData['NameFirst']) < 2) {
			$this->data['NameFirstError']="Please use a valid first name";
		}
	}
	
	function Edit($userId=null) {
		$current = UserModel::loggedInUser();
		if ($userId===null) {
			return;
		}
		if (!$current->admin) 
			Controller::Redirect("Home", "Dashboard");
		
	}
	
	function Profile() {
		$current = UserModel::loggedInUser();
	}
	
}