<?php

	Autoloader::register();

	class Autoloader {

		public static function register() {

			if (function_exists('__autoload')) {
				spl_autoload_register('__autoload');
			}

			return spl_autoload_register(['Autoloader', 'Load']);
		}

		public static function Load($pClassName) {

			if (class_exists($pClassName, false)) { // class already exists
				return false;
			}

			$pClassFilePath = SITE_ROOT . str_replace('\\', DIRECTORY_SEPARATOR, $pClassName) . '.php';

			if (file_exists($pClassFilePath) === false || is_readable($pClassFilePath) === false) { // can't load file
				return false;
			}
			require_once($pClassFilePath);
		}
	}