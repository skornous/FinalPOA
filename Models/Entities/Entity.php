<?php

	namespace Models\Entities;

	class Entity {

		public function __construct() {
		}

		public function __get($prop) {

			if (property_exists($this, $prop)) {
				$getterName = "get" . ucfirst($prop);

				return $this->$getterName();
			} else {
				return false;
			}
		}
	}