<?php 

namespace Controllers;

use Controllers\AppController;
use Models\Entities\User;

class UserController extends AppController {

	public function __construct() {
		parent::__construct();
		$this->loadModel('User');
		$this->loadModel('Team');
		$this->loadModel('Authorization');
	}

	// -- Actions -- //
	public function show($id, $state = null) {
		if ($_SESSION["User"]->can("see", "user")) {
			$user = new User();
			$user
				->exchangeArray($this->User->getById($id))
				->setTeams($this->User->getTeams($id));
			$authsIds = $this->Team->getAuths($user->extractTeamsIds());
			$user->setAuths($this->Authorization->nameAuths($authsIds));

			if (!is_null($state)) {
				$compact = compact('user', 'state');
			} else {
				$compact = compact('user');
			}

			$this->render("user.show", $compact);
		} else {
			$this->render("errors.403");
		}
	}

	public function showAll() {
		if ($_SESSION["User"]->can("see", "user")) {
			$users = $this->User->getAll();
			$this->render("user.all", compact('users'));
		} else {
			$this->render("errors.403");
		}
	}

	public function modify() {
		if ($_SESSION["User"]->can("edit", "user")) {
			$formDatas = $_POST;
			$verif = $this->verifyModifyForm($formDatas);
			if($verif["err"] === 0) {
				$user = User::createFromArray($formDatas);
				$formDatas["active"] = (isset($formDatas["active"]) && $formDatas["active"] == "on") ? 1 : 0;
				$state = $this->User->modify($formDatas);
				if ($_SESSION["User"]->can("see", "user")) {
					$this->show($user->id, $state);
				} else {
					$teams = $this->Team->getAll();
					$this->render("user.modify", compact('state', 'user', 'teams'));
				}
			} else {
				$state = $verif["state"];
				$user = User::createFromArray($formDatas);
				$teams = $this->Team->getAll();
				$this->render("user.modify", compact('state', 'user', 'teams'));
			}
		} else {
			var_dump($_SESSION["User"]);
			$this->render("errors.403");
		}
	}

	public function create() {
		if ($_SESSION["User"]->can("add", "user")) {
			$formDatas = $_POST;
			$verif = $this->verifyCreateForm($formDatas);
			if($verif["err"] === 0) {
				$formDatas["active"] = 1; // default value for active
				// remove useless fields
				unset($formDatas["charLen"]);
				unset($formDatas["uppercase"]);
				unset($formDatas["figures"]);
				$state = $this->User->create($formDatas);
				$teams = $this->Team->getAll();
				$this->render("user.create", compact('state', 'teams'));
			} else {
				$state = $verif["state"];
				$teams = $this->Team->getAll();
				$this->render("user.create", compact('state', 'formDatas', 'teams'));
			}
		} else {
			// var_dump($_SESSION["User"]);
			$this->render("errors.403");
		}
	}

	public function delete($id) {
		if ($_SESSION["User"]->can("delete", "user")) {
			$state = $this->User->delete($id);
			if ($_SESSION["User"]->can("see", "user")) {
				$users = $this->User->getAll();
				$this->render("user.all", compact('state', 'users'));
			} else {
				$this->render("errors.403");
			}
		} else {
			$this->render("errors.403");
		}
	}

	public function changePassword() {
		$datas = $_POST;
		if(isset($datas["newpassword1"]) && isset($datas["newpassword2"])) { // all fields are set
			if (strlen($datas["newpassword1"]) >= 5) {
				if($datas["newpassword1"] === $datas["newpassword2"]) { // new password matches it's verification
					if($this->User->checkPswd($datas["userID"], $datas["oldpassword"])) { // old pswd is correct
						$state = $this->User->modifyPswd($datas["userID"], $datas["newpassword1"]);
					} else {
						$state = array("danger" => "DOLDPSWD");
					}
				} else {
					$state = array("danger" => "DNEWPSWD");
				}
			} else {
				$state = array("danger" => "PSWDRULES");
			}
		} else {
			$state = array("danger" => "SUSERDELETE");
		}
		$this->render("user.changePswd", compact("state"));
	}

	// -- Forms -- //
	public function createForm() {
		if ($_SESSION["User"]->can("add", "user")) {
			$teams = $this->Team->getAll();
			$this->render("user.create", compact('teams'));
		} else {
			$this->render("errors.403");
		}
	}

	public function modifyForm($id) {
		if ($_SESSION["User"]->can("edit", "user")) {
			$user = new User();
			$user
				->exchangeArray($this->User->getById($id))
				->setTeams($this->User->getTeams($id));
			$authsIds = $this->Team->getAuths($user->extractTeamsIds());
			$user->setAuths($this->Authorization->nameAuths($authsIds));

			$teams = $this->Team->getAll();

			$this->render("user.modify", compact('user', 'teams'));
		} else {
			$this->render("errors.403");
		}
	}

	public function changePasswordForm() { $this->render("user.changePswd"); }

	// -- Verifiers -- //
	private function verifyCreateForm($form = array()) {
		$requiredFields = array("firstname", "lastname", "email", "login", "password");
		return $this->verifyForm($form, $requiredFields);
	}

	private function verifyModifyForm($form = array()) {
		$requiredFields = array("id", "firstname", "lastname", "email", "login");
		return $this->verifyForm($form, $requiredFields);
	}
	
}