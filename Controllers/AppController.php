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

	protected function verifyForm($form = array(), $requiredFields = array()) {
		// var_dump($form, $requiredFields);exit;
		if (empty($form)) { return array("err" => 1, "state" => array("danger" => "FORMINCOMPLETE")); }

		foreach ($requiredFields as $field) {
			$field = strtolower($field);
			if(!isset($form[$field]) || empty($form[$field])) {
				return array("err" => 2, "state" => array("danger" => "MISSING_" . strtoupper($field)));
			}
		}

		return array("err" => 0, "state" => array("success" => "FORMOK"));
	}
}