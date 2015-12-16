<?php

	namespace Controllers;

	use Models;
	use Helpers\Lang;

	class Controller {

		protected $id;
		protected $viewPath;
		protected $template;
		protected $properties;
		protected $model;
		protected $lang;
		protected $scripts;
		protected $styles;

		function __construct($viewPath = "") {

			$model = 'Models\\' . $viewPath . 'Model';
			$this->properties = ["page" => "home"];
			$this->viewPath = $viewPath;

			$this->model = new $model; // bring on the model
			$this->lang = $_SESSION["lang"];
			$this->scripts = [];
			$this->styles = [];
		}

		/**
		 * if the property is an object property set it
		 * else add a property in the properties array
		 */
		function __set($property, $value) {

			if (property_exists($this, $property)) {
				$this->$property = $value;
			} else {
				$this->properties[$property] = $value;
			}
		}

		/**
		 * if the property is an object property get it
		 * else get it from the properties array or return false if not in the array
		 */
		function __get($property) {

			if (property_exists($this, $property)) {
				return $this->$property;
			} else {
				if (array_key_exists($property, $this->properties)) {
					return $this->properties[$property];
				} else {
					return false;
				}
			}
		}

		function __toString() {

			$str = get_class($this) . "[";
			foreach (get_object_vars($this) as $prop => $val) {
				$str .= "\n\t" . $prop . " : " . $val;
			}
			$str .= "\n]";

			return $str;
		}

		protected function render($view, $variables = []) {

			$page = explode(".", $view);
			$page = array_map("ucfirst", $page);//(".", $view);
			$pageName = implode(" > ", $page);
			ob_start();
			extract($variables);
			if (!empty($this->scripts)) {
				$scripts = $this->scripts;
			}
			if (!empty($this->styles)) {
				$styles = $this->styles;
			}
			// $pageName = ucfirst($page);
			$lang = $this->lang;
			if (isset($_SESSION["User"]) && !empty($_SESSION["User"])) {
				$loggedUser = $_SESSION["User"];
			}
			require($this->viewPath . str_replace('.', DIRECTORY_SEPARATOR, $view) . '.php');
			$content = ob_get_clean();
			require($this->viewPath . 'templates' . DIRECTORY_SEPARATOR . $this->template . '.php');
		}

		protected function redirect($route) {

			header("Location: " . BASE_URL . $route);
		}

		protected function registerScript($scriptPath) {

			if (!in_array($scriptPath, $this->scripts)) {
				$this->scripts[] = $scriptPath;
			}
		}

		protected function registerStyle($stylePath) {

			if (!in_array($stylePath, $this->styles)) {
				$this->styles[] = $stylePath;
			}
		}

	}