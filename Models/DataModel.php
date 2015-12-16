<?php

	namespace Models;

	use \PDO;
	use Models\Model;

	class DataModel extends Model {

		private $rows;
		private $team;
		private $hasMS; // Has Master Server

		function __construct() {

			parent::__construct();
		}

		function initWithTeam($team) {

			$this->rows = $team->rows;
			$this->team = strtolower($team->name);
			$this->hasMS = $team->hasMasterServer;

			return $this;
		}

		function getAll() {

			$sql = $this->generateSelect() . $this->generateFrom();
			$rq = $this->db->prepare($sql);

			$rq->execute();

			// var_dump($rq->errorInfo());

			return $rq->fetchAll(PDO::FETCH_ASSOC);
		}

		function getById($id) {

			$sql = $this->generateSelect() . " " . $this->generateFrom();
			$prefix = ($this->hasMS) ? "`d`." : "";
			$sql .= " WHERE " . $prefix . "`id` = :id";

			$rq = $this->db->prepare($sql);

			$rq->execute(["id" => htmlspecialchars($id)]);

			// var_dump($rq);

			return $rq->fetch(PDO::FETCH_ASSOC);
		}

		function getMasterServerList() {

			$sql = "SELECT * FROM `server_" . $this->team . "` WHERE `deleted` != 1";
			$rq = $this->db->prepare($sql);

			$rq->execute();

			return $rq->fetchAll(PDO::FETCH_ASSOC);
		}

		function create($formDatas) {

			$rq = $this->db->prepare($this->generateCreate($formDatas));

			$rq->execute($formDatas);

			// var_dump($rq, $formDatas);
			// var_dump($rq->errorInfo());

			return ["success" => "SDATACREATED"];
		}

		function modify($formDatas) {

			$rq = $this->db->prepare($this->generateModify(array_keys($formDatas)));

			$rq->execute($formDatas);

			// var_dump($rq, $formDatas);
			// var_dump($rq->errorInfo());

			return ["success" => "SDATAMODIFY"];
		}

		function delete($formDatas) {

			$rq = $this->db->prepare($this->generateDelete());

			$rq->execute($formDatas);

			// var_dump($rq, $formDatas);exit;
			// var_dump($rq->errorInfo());

			return ["success" => "SDATADELETE"];
		}

		// -- SQL generator -- //
		private function generateSelect() {

			$sql = "SELECT";
			if ($this->hasMS) {
				$sql .= " `d`.`id`";
				$sql .= ", `d`." . implode(", `d`.", explode(",", $this->rows));
				$sql .= ", `s`.`name` as `master_server`";
				$sql = str_replace(", `d`. `master_server`", "", $sql);
			} else {
				$sql .= " `id`, " . $this->rows;
			}

			return $sql;
		}

		private function generateFrom() {

			$sql = "FROM `data_" . $this->team . "`";
			if ($this->hasMS) {
				$sql .= " as `d` INNER JOIN `server_" . $this->team . "` as `s`";
				$sql .= " ON `d`.`master_server` = `s`.`id`";
			}

			return $sql;
		}

		private function generateCreate($vals) {

			// INSERT INTO `table` (`cols`) VALUES (:vals)
			// cols
			$sql_cols = "(";
			foreach ($vals as $col => $val) {
				$sql_cols .= "`" . $col . "`, ";
			}
			$sql_cols = substr($sql_cols, 0, -2) . ")";
			// vals
			$sql_vals = "(";
			foreach ($vals as $col => $val) {
				$sql_vals .= ":" . $col . ", ";
			}
			$sql_vals = substr($sql_vals, 0, -2) . ")";

			// final request
			$sql = "INSERT INTO `data_" . $this->team . "` " . $sql_cols . " VALUES " . $sql_vals;

			return $sql;
		}

		private function generateModify($cols) {

			// UPDATE `table` SET `row` = :val WHERE `id` = :id
			$sql = "UPDATE `data_" . $this->team . "` SET";
			foreach ($cols as $col) {
				if ($col != "id") {
					$sql .= " `" . $col . "` = :" . $col . ", ";
				}
			}

			return substr($sql, 0, -2) . " WHERE `id` = :id";
		}

		private function generateDelete() {

			// DELETE FROM `table` WHERE `id` = :id
			return "DELETE FROM `data_" . $this->team . "` WHERE `id` = :id";
		}

	}