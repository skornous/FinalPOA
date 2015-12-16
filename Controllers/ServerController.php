<?php

	namespace Controllers;

	use Controllers\AppController;
	use Models\Entities\Server;

	class ServerController extends AppController {

		public function __construct() {

			parent::__construct();
			$this->loadModel('Server');
		}

		// -- Actions -- //
		public function show($id) {

			if ($_SESSION["User"]->can("see", "server")) {
				$server = new Server();
				$server
					->exchangeArray($this->Server->getById($id));
				$this->render("server.show", compact('server'));
			} else {
				$this->render("errors.403");
			}
		}

		public function showAll() {

			if ($_SESSION["User"]->can("see", "server")) {
				$servers = $this->Server->getAll();
				$this->render("server.all", compact('servers'));
			} else {
				$this->render("errors.403");
			}
		}

		public function modify() {

			if ($_SESSION["User"]->can("edit", "server")) {
				$formDatas = $_POST;
				$verif = $this->verifyModifyForm($formDatas);
				if ($verif["err"] === 0) {
					$server = Server::createFromArray($formDatas);
					$state = $this->Server->modify($formDatas);
					if ($_SESSION["User"]->can("see", "server")) {
						$this->render("server.show", compact('state', 'server'));
					} else {
						$this->render("server.modify", compact('state', 'server'));
					}
				} else {
					$state = $verif["state"];
					$server = Server::createFromArray($formDatas);
					$this->render("server.modify", compact('state', 'server'));
				}
			} else {
				var_dump($_SESSION["User"]);
				$this->render("errors.403");
			}
		}

		public function create() {

			if ($_SESSION["User"]->can("add", "server")) {
				$formDatas = $_POST;
				$verif = $this->verifyCreateForm($formDatas);
				if ($verif["err"] === 0) {
					$formDatas["active"] = 1; // default value for active
					$state = $this->Server->create($formDatas);
					$this->render("server.create", compact('state'));
				} else {
					$state = $verif["state"];
					$this->render("server.create", compact('state', 'formDatas'));
				}
			} else {
				var_dump($_SESSION["User"]);
				$this->render("errors.403");
			}
		}

		public function delete($id) {

			if ($_SESSION["User"]->can("delete", "server")) {
				$state = $this->Server->delete($id);
				if ($_SESSION["User"]->can("see", "server")) {
					$servers = $this->Server->getAll();
					$this->render("server.all", compact('state', 'servers'));
				} else {
					$this->render("errors.403");
				}
			} else {
				$this->render("errors.403");
			}
		}

		// -- Forms -- //
		public function createForm() {

			if ($_SESSION["User"]->can("add", "server")) {
				$this->render("server.create");
			} else {
				$this->render("errors.403");
			}
		}

		public function modifyForm($id) {

			if ($_SESSION["User"]->can("edit", "server")) {
				$server = new Server();
				$server
					->exchangeArray($this->Server->getById($id));

				$this->render("server.modify", compact('server'));
			} else {
				$this->render("errors.403");
			}
		}

		// -- Verifiers -- //
		private function verifyCreateForm($form = []) {

			$requiredFields = ["name"];

			return $this->verifyForm($form, $requiredFields);
		}

		private function verifyModifyForm($form = []) {

			$requiredFields = ["name"];

			return $this->verifyForm($form, $requiredFields);
		}

	}