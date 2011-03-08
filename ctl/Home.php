<?php
class Home extends Controller {
	function index() {
		Model::load('User');
		if (UserModel::loggedInUser()!==null) 
			Controller::Redirect("Home", "Dashboard");
	}
	function Dashboard() {
	}
}