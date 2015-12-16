<?php

	namespace Models;

	use \PDO;
	use Models\Model;

	class TeamModel extends Model {

		function __construct() {

			parent::__construct();
		}

		function getAll() {

			$sql = "SELECT
					`id`,
					`name`,
					`deleted` 
				FROM
					`team` as `t`
				WHERE `t`.`deleted` != 1";
			$rq = $this->db->prepare($sql);

			$rq->execute();

			return $rq->fetchAll(PDO::FETCH_ASSOC);
		}

		function getById($id) {

			$sql = "SELECT
					`id`,
					`name`,
					`deleted` 
				FROM
					`team` as `t`
				WHERE
					`t`.`id` = :id";
			$rq = $this->db->prepare($sql);

			$rq->execute(["id" => htmlspecialchars($id)]);

			return $rq->fetch(PDO::FETCH_ASSOC);
		}

		function getAuths($team) {

			$sql = "SELECT DISTINCT `id_auth` FROM `auth_team` as `at` WHERE";
			if (is_array($team)) {
				$params = [];
				foreach ($team as $tKey => $tVal) {
					$pKey = "id" . $tKey;
					$params[$pKey] = htmlspecialchars($tVal);
					$sql .= " `at`.`id_team` = :" . $pKey . " OR";
				}
				$sql = substr($sql, 0, -3);
				$fetch = "fetchAll";
			} else {
				$sql .= " `at`.`id_team` = :id";
				$params = ["id" => htmlspecialchars($team)];
				$fetch = "fetch";
			}

			// var_dump($sql, $params, $fetch);

			$rq = $this->db->prepare($sql);

			$rq->execute($params);

			return $rq->$fetch(PDO::FETCH_ASSOC);
		}

		public function getByName($name) {

			$sql = "SELECT
					`id`,
					`name`,
					`rows`,
					`hasMasterServer`,
					`deleted` 
				FROM
					`team` as `t`
				WHERE
					`t`.`name` = :name";
			$rq = $this->db->prepare($sql);

			$rq->execute(["name" => htmlspecialchars($name)]);

			return $rq->fetch(PDO::FETCH_ASSOC);
		}
	}