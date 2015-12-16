<?php 

namespace Controllers;

use Controllers\AppController;
use \Models\Entities\User;

class IndexController extends AppController {

	public function __construct() {
		parent::__construct();
		$this->loadModel('User');
		$this->loadModel('Team');
		$this->loadModel('Authorization');
	}

	public function home() {
		if(isset($_SESSION["User"]) && !empty($_SESSION["User"])) {
			$this->render("index.home");
		} else {
			$this->render("index.pleaseLogIn");
		}
	}

	public function login() {
		$this->render("index.login");
	}

	public function register() {
		if($this->User->verif($_POST["login"], $_POST["pswd"])) {
			$user = new User();
			$user
				->exchangeArray($this->User->getByLogin($_POST["login"]))
				->setTeams($this->User->getTeams($user->id));
			
			$authsIds = $this->Team->getAuths($user->extractTeamsIds());
			$namedAuths = $this->Authorization->nameAuths($authsIds);
			$organizedAuths = array();
			foreach ($namedAuths as $auth) {
				if(!array_key_exists($auth["object"], $organizedAuths)) {
					$organizedAuths[$auth["object"]] = array();
				}
				if(!in_array($auth["action"], $organizedAuths[$auth["object"]])) {
					$organizedAuths[$auth["object"]][] = $auth["action"];
				}
			}
			$user->setAuths($organizedAuths);
			
			$_SESSION["User"] = $user;
			$this->redirect("/");
		} else {
			$state = array("danger" => "DNOACCOUNT");
			$this->render("index.login", compact('state'));
		}
	}

	public function logout() {
		// renew the session
		session_destroy();
		session_start();
		// redirect to the home page
		$this->redirect("/");
	}
}