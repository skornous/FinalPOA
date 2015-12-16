<?php

	namespace Models;

	use \PDO;
	use Models\Model;

	class DataMasterModel extends Model {

		private $tables;
		private $servers;
		private $prefix;

		function __construct() {

			parent::__construct();
			$this->prefix = "data_";
			$this->tables = ["bt", "netbackup"];
			$this->servers = ["netbackup"];
		}

		public function getAll() {

		}

	}