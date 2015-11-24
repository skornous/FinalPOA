<?php

namespace Models;

use \PDO;
use Models\Model;

class ServerModel extends Model {

	function __construct() {
		parent::__construct();
	}

	function getAll() {
		$sql = "SELECT `s`.`id`,
					`s`.`name`,
					`s`.`deleted`
				FROM
					`server_netbackup` as `s`
				WHERE `s`.`deleted` != 1";
		$rq = $this->db->prepare($sql);

		$rq->execute();

		return $rq->fetchAll(PDO::FETCH_ASSOC);
	}

	function getById($id) {
		$sql = "SELECT `s`.`id`,
					`s`.`name`,
					`s`.`deleted`
				FROM
					`server_netbackup` as `s`
				WHERE
					`s`.`id` = :id";
		$rq = $this->db->prepare($sql);

		$rq->execute(array("id" => htmlspecialchars($id)));

		return $rq->fetch(PDO::FETCH_ASSOC);
	}

	// create server
	function create($serverDatas) {
		if ($this->serverExists($serverDatas["name"])){
			return array("danger" => "EMSERVEREXISTS");
		}

		$sql = "INSERT INTO `server_netbackup`
				VALUES (NULL, :name, 0);";

		$rq = $this->db->prepare($sql);

		$rq->execute(array(
			"name" => htmlspecialchars($serverDatas["name"]),
		));

		return array("success" => "SMSERVERCREATE");
	}

	// update server
	function modify($serverDatas){
		$sql = "UPDATE `server_netbackup`
				SET 
					`name` = :name
				WHERE `id` = :id";

		$rq = $this->db->prepare($sql);

		$rq->execute(array(
			"name" => htmlspecialchars($serverDatas["name"]),
			"id" => htmlspecialchars($serverDatas["id"]),
		));

		return array("success" => "SMSERVERMODIFY");
	}

	// delete server
	function delete($id) {

		$sql = "UPDATE `server_netbackup`
				SET `deleted` = 1
				WHERE `id` = :id";

		$rq = $this->db->prepare($sql);

		$rq->execute(array("id" => htmlspecialchars($id)));

		return array("success" => "SMSERVERDELETE");
	}

	function serverExists($serverName) {
		$sql = "SELECT `id` FROM `server_netbackup` WHERE `name` = :name";
		$rq = $this->db->prepare($sql);

		$rq->execute(array("name" => $serverName));

		return $rq->rowCount() > 0;
	}
}