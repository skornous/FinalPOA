<?php

	namespace Controllers;

	use Controllers\Controller;

	class AppController extends Controller {

		protected $template = 'default';

		public function __construct() {

			parent::__construct();
			$this->viewPath = ROOT . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR;
		}

		protected function loadModel($model_name) {

			$model = "\\Models\\" . $model_name . "Model";
			$this->$model_name = new $model();
		}

		protected function loadController($controller_name) {

			$controller = "\\Controllers\\" . $controller_name . "Controller";
			$this->$controller_name = new $controller();
		}

		protected function verifyForm($form = [], $requiredFields = []) {

			// var_dump($form, $requiredFields);exit;
			if (empty($form)) {
				return ["err" => 1, "state" => ["danger" => "FORMINCOMPLETE"]];
			}

			foreach ($requiredFields as $field) {
				$field = strtolower($field);
				if (!isset($form[$field]) || empty($form[$field])) {
					return ["err" => 2, "state" => ["danger" => "MISSING_" . strtoupper($field)]];
				}
			}

			return ["err" => 0, "state" => ["success" => "FORMOK"]];
		}
	}