<?php 

namespace Models;

use Helpers\DB;

class Model {
	protected $db;
	protected $grain;

	function __construct($login = null, $pswd = null, $host = null, $dbname = null) {
		if (!is_null($login) && !is_null($pswd) && is_null($host) && is_null($dbname)) {
			$db = new DB($login, $pswd, $host, $dbname);
		} else {
			$db = new DB();
		}
		$this->db = $db->getPDO();
		$this->grain = "in~*hX[F_d~+R&hY]M";
	}

	protected function getDB($login = null, $pswd = null, $host = null, $dbname = null) {
		if (is_null($login) || is_null($pswd) || is_null($host) || is_null($dbname)) { return false; }
		$db = new DB($login, $pswd, $host, $dbname);
		return $db->getPDO();
	}
}