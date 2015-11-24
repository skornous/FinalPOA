<?php

namespace Controllers;

use Controllers\AppController;

class ErrorController extends AppController {
	public function __construct(){
		parent::__construct();
	}

	public function _404(){
		$this->render("errors.404");
	}
}