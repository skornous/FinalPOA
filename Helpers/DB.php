<?php

	namespace Helpers;

	use \PDO;

	class DB {

		private $pdo = null;
		private $db_login = "root";
		private $db_pass = "";
		private $db_host = "localhost";
		private $db_name = "poa";

		public function __construct($login = null, $pswd = null, $host = null, $dbname = null) {

			try {
				if (!is_null($login) && !is_null($pswd) && !is_null($host) && !is_null($dbname)) {
					$pdo = new PDO("mysql:host=" . $host . ";dbname=" . $dbname, $login, $pswd);
				} else {
					$pdo = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_login, $this->db_pass);
				}
			} catch (Exception $e) {
				$pdo = null;
				echo "PDO connect error : <br />" . $e->getMessage();
			}
			$this->pdo = $pdo;
		}

		public function getPDO() {

			return $this->pdo;
		}
	}
