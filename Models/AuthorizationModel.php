<?php

namespace Models;

use \PDO;

class AuthorizationModel extends Model {
	
	function __construct() {
		parent::__construct();
	}

	public function nameAuths($auth) {
		$sql = "SELECT DISTINCT `action`, `object` FROM `authorization` as `a` WHERE";
		if (is_array($auth)) {
			$params = array();
			foreach ($auth as $aKey => $aVal) {
				$pKey = "id" . $aKey;
				$params[$pKey] = htmlspecialchars($aVal["id_auth"]);
				$sql .= " `a`.`id` = :" . $pKey . " OR";
			}
			$sql = substr($sql, 0, -3);
			$fetch = "fetchAll";
		} else {
			$sql .= " `a`.`id` = :id";
			$params = array("id" => htmlspecialchars($auth));
			$fetch = "fetch";
		}

		// var_dump($sql, $params, $fetch);
		
		$rq = $this->db->prepare($sql);

		$rq->execute($params);

		return $rq->$fetch(PDO::FETCH_ASSOC);
	}
}