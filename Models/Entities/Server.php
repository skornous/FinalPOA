<?php

	namespace Models\Entities;

	class Server extends Entity {

		private $id;
		private $name;
		private $deleted;

		public function __construct() {

			parent::__construct();
		}

		public function exchangeArray($data) {

			$this->id = (isset($data["id"])) ? $data["id"] : null;
			$this->name = (isset($data["name"])) ? $data["name"] : null;
			$this->deleted = (isset($data["deleted"])) ? (bool)$data["deleted"] : null;

			return $this;
		}

		// ----- Static functions ----- //
		public static function createFromArray($data) {

			$server = new Server();
			$server->exchangeArray($data);

			return $server;
		}

		// ----- Getters & Setters ----- //
		public function getId() {

			return $this->id;
		}

		public function setId($id) {

			$this->id = $id;

			return $this;
		}

		public function getName() {

			return $this->name;
		}

		public function setName($name) {

			$this->name = $name;

			return $this;
		}

		public function getDeleted() {

			return $this->deleted;
		}

		public function setDeleted($deleted) {

			$this->deleted = $deleted;

			return $this;
		}
	}