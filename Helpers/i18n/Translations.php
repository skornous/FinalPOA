<?php

namespace Helpers\i18n;
use \Exception;

abstract class Translations {
	protected $_translations = array();

	public function __construct() {
		$this->loadTranslation();
	}

	public function __get($property) {
		if (!array_key_exists($property, $this->_translations)) {
			throw new Exception("Translation of " . $property . " does not exist for the language : " . get_class($this));
		}
		return $this->_translations[$property];
	}

	public function __set($property, $value) {
		throw new Exception("Action not allowed on " . get_class($this));
		
	}

	protected abstract function loadTranslation();
}