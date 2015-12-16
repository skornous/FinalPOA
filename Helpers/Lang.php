<?php

	namespace Helpers;

	use Helpers\i18n;

	class Lang {

		protected $_config;
		// protected $_acceptedLanguages;
		protected $_translations;

		function __construct($lang = "en") {

			$this->_config["locale"] = $lang;
			// $this->_acceptedLanguages = array();

			// foreach (scandir("helpers/i18n") as $file) {
			// 	if ($file !== "." && $file !== ".." && $file !== "Translations") { // useless files
			// 		// remove the extension and add the language to the list of the accepted languages
			// 		$this->_acceptedLanguages[] = substr($file, 0, -4);
			// 	}
			// }

			$this->reloadI18N();
		}

		function __set($property, $value) {

			$this->_config[$property] = $value;
			if ($property == "locale") {
				$this->reloadI18N();
			}
		}

		function __get($property) {

			if (array_key_exists($property, $this->_config)) {
				return $this->_config[$property];
			} else {
				return $this->_translations->$property;
			}
		}

		static function supportedLanguage($language = "") {

			if (empty($language)) {
				return false;
			} else {
				foreach (scandir("helpers/i18n") as $file) {
					if ($file !== "." && $file !== ".." && $file !== "Translations") { // useless files
						$languageFile = $language . ".php";
						if ($languageFile === $file) {
							return true;
						}
					}
				}

				return false;
			}
		}

		function reloadI18N() {

			$langClass = "Helpers\\i18n\\" . $this->_config["locale"];
			$this->_translations = new $langClass();
		}

	}