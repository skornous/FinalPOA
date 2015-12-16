<?php

namespace Models\Entities;

class Team extends Entity {

	private $id;
	private $name;
	private $usersList;
	private $authsList;
	private $hasMasterServer;
	private $rows;

	public function __construct() {
		parent::__construct();
	}

	public function exchangeArray($data) {
		$this->id = (isset($data["id"])) ? $data["id"] : null;
		$this->name = (isset($data["name"])) ? $data["name"] : null;
		$this->usersList = (isset($data["usersList"])) ? $data["usersList"] : null;
		$this->authsList = (isset($data["authsList"])) ? $data["authsList"] : null;
		$this->hasMasterServer = (isset($data["hasMasterServer"])) ? $data["hasMasterServer"] : null;
		$this->rows = (isset($data["rows"])) ? $data["rows"] : null;
		return $this;
	}

	public function getRowsAsArray() {
		$rows = preg_replace("/`/", "", $this->rows);
		$rows = preg_replace("/ /", "", $rows);
		return explode(",", $rows);
	}

	public function getRowsAsArrayWithId() {
		$rows = $this->getRowsAsArray();
		$rows[] = "id";
		return $rows;
	}

	// ----- Getters & Setters ----- //
	public function getId() { return $this->id; }
	public function setId($id) { $this->id = $id; return $this;}

	public function getName() { return $this->name; }
	public function setName($name) { $this->name = $name; return $this;}

	public function getUsersList() { return $this->usersList; }
	public function setUsersList($usersList) { $this->usersList = $usersList; return $this;}

	public function getAuthsList() { return $this->authsList; }
	public function setAuthsList($authsList) { $this->authsList = $authsList; return $this;}

	public function getHasMasterServer() { return $this->hasMasterServer; }
	public function setHasMasterServer($hasMasterServer) { $this->hasMasterServer = $hasMasterServer; return $this;}

	public function getRows() { return $this->rows; }
	public function setRows($rows) { $this->rows = $rows; return $this;}

}