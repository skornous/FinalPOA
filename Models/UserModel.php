<?php

namespace Models;

use \PDO;
use Models\Model;

class UserModel extends Model {

	function __construct() {
		parent::__construct();
	}

	function getAll() {
		$sql = "SELECT `u`.`id`,
					`u`.`firstname`,
					`u`.`lastname`,
					`u`.`email`,
					`u`.`login`,
					`u`.`active`,
					`u`.`deleted`
				FROM
					`user` as `u`
				WHERE `u`.`deleted` != 1";
		$rq = $this->db->prepare($sql);

		$rq->execute();

		return $rq->fetchAll(PDO::FETCH_ASSOC);
	}

	function getById($id) {
		$sql = "SELECT `u`.`id`,
					`u`.`firstname`,
					`u`.`lastname`,
					`u`.`email`,
					`u`.`login`,
					`u`.`active`,
					`u`.`deleted`
				FROM
					`user` as `u`
				WHERE
					`u`.`id` = :id";
		$rq = $this->db->prepare($sql);

		$rq->execute(array("id" => htmlspecialchars($id)));

		return $rq->fetch(PDO::FETCH_ASSOC);
	}

	function getByLogin($login) {
		$sql = "SELECT `u`.`id`,
					`firstname`,
					`lastname`,
					`email`,
					`login`,
					`active`,
					`u`.`deleted`
				FROM
					`user` as `u`
				WHERE
					`u`.`login` = :login";
		$rq = $this->db->prepare($sql);

		$rq->execute(array("login" => htmlspecialchars($login)));
		// var_dump($rq);

		return $rq->fetch(PDO::FETCH_ASSOC);
	}

	function getTeams($id) {
		$sql = "SELECT
					`t`.`id`,
					`t`.`name`
				FROM
					`user` as `u`
					INNER JOIN `user_team` as `ut`
						ON `u`.`id`=`ut`.`id_user`
					INNER JOIN `team` as `t`
						ON `t`.`id` = `ut`.`id_team`
				WHERE
					`u`.`id` = :id
					AND `t`.`deleted` IS NOT NULL";
		$rq = $this->db->prepare($sql);

		$rq->execute(array("id" => htmlspecialchars($id)));

		return $rq->fetchAll(PDO::FETCH_ASSOC);
	}

	function create($userDatas) {
		if ($this->userExists($userDatas["login"])){
			return array("danger" => "EUSEREXISTS");
		}
		if (isset($userDatas["teams"])) {
			$teams = $userDatas["teams"];
			unset($userDatas["teams"]);
		}

		$sql = "INSERT INTO `user`
				VALUES (NULL, :fname, :lname, :email, :login, :pswd, :active, 0);";

		$rq = $this->db->prepare($sql);

		$rq->execute(array(
			"fname" => htmlspecialchars($userDatas["firstname"]),
			"lname" => htmlspecialchars($userDatas["lastname"]),
			"email" => htmlspecialchars($userDatas["email"]),
			"login" => htmlspecialchars($userDatas["login"]),
			"pswd" => md5($this->grain . $userDatas["password"]),
			"active" => htmlspecialchars($userDatas["active"]),
		));

		if (isset($teams) && !empty($teams)) {
			$newUserID = $this->db->lastInsertId();
			if(is_array($teams)) {
				foreach ($teams as $team) {
					$this->addTeam($newUserID, $team);
				}
			} else {
				$this->addTeam($newUserID, $team);
			}
		}

		return array("success" => "SUSERCREATE");
	}

	//update user
	function modify($userDatas){
		if (isset($userDatas["teams"])) {
			$teams = $userDatas["teams"];
			unset($userDatas["teams"]);
		}
		$sql = "UPDATE `user`
				SET 
					`firstname` = :fname, 
					`lastname` = :lname, 
					`email` = :email, 
					`login` = :login, 
					`active` = :active
				WHERE `id` = :id";

		$rq = $this->db->prepare($sql);

		$rq->execute(array(
			"fname" => htmlspecialchars($userDatas["firstname"]),
			"lname" => htmlspecialchars($userDatas["lastname"]),
			"email" => htmlspecialchars($userDatas["email"]),
			"login" => htmlspecialchars($userDatas["login"]),
			"active" => htmlspecialchars($userDatas["active"]),
			"id" => htmlspecialchars($userDatas["id"]),
		));

		if(!empty($teams)) {
			$userID = htmlspecialchars($userDatas["id"]);
			$oldTeams = $this->getTeams($userID);
			foreach ($oldTeams as $key => $team) {
				$oldTeams[$key] = $team["id"];
			}
			// var_dump($teams, $oldTeams);exit;
			if (is_array($teams)) {
				foreach ($teams as $team) {
					if (!in_array($team, $oldTeams)) {
						$this->toggleTeam($userID, $team);
					}
				}
			} else {
				$changeDone = false;
				foreach ($oldTeams as $oTeam) {
					if ($oTeam["id"] != $team) {
						$this->removeTeam($userID, $team);
					} else {
						$changeDone = true;
					}
				}
				if (!$changeDone) {
					$this->addTeam($userID, $team);
				}
			}
		}

		return array("success" => "SUSERMODIFY");
	}

	//update user's pswd
	function modifyPswd($id, $pswd){
		$sql = "UPDATE `user`
				SET `pswd` = :pswd
				WHERE `id` = :id";

		$rq = $this->db->prepare($sql);

		$rq->execute(array(
			"id" => htmlspecialchars($id),
			"pswd" => md5($this->grain . $pswd)
		));

		return array("success" => "SPSWDMODIFY");
	}

	//delete user
	function delete($id) {

		$sql = "UPDATE `user`
				SET `deleted` = 1
				WHERE `id` = :id";

		$rq = $this->db->prepare($sql);

		$rq->execute(array("id" => htmlspecialchars($id)));

		return array("success" => "SUSERDELETE");
	}

	//verif connect
	function verif($login, $pswd) {

		$sql = "SELECT `id`
				FROM `user`
				WHERE
					`login` = :login
					AND `pswd` = :pswd";

		$rq = $this->db->prepare($sql);

		$rq->execute(array(
			"login" => htmlspecialchars($login),
			"pswd" => md5($this->grain . $pswd),  
		));

		// echo md5($this->grain . $pswd);
		$count = $rq->rowCount();

		return $count;

	}

	//verif connect
	function userExists($login) {
		$sql = "SELECT `id`
				FROM `user`
				WHERE `login` = :login";

		$rq = $this->db->prepare($sql);

		$rq->execute(array( "login" => htmlspecialchars($login) ));
		$count = $rq->rowCount();
		return ($count > 0);

	}

	//verif old password
	function checkPswd($id, $pswd) {
		$sql = "SELECT `pswd`
				FROM `user`
				WHERE `id` = :id
					AND `pswd` = :pswd";

		$rq = $this->db->prepare($sql);

		$rq->execute(array( "id" => htmlspecialchars($id),
							"pswd" => md5($this->grain . $pswd)
					));
		$count = $rq->rowCount();
		return ($count > 0);
	}

	//verif active - (not used)
	function isActive($id) {
		$sql = "SELECT `active`
				FROM`user`
				WHERE `id` = :id";

		$rq = $this->db->prepare($sql);

		$rq->execute(array(
						"id" => htmlspecialchars($id)));

	}

	function getDocForUser($newUserID) {
		$sql = "SELECT `r`.`documentation_` as `doc`
				FROM `user` as `u`
					INNER JOIN `role` as `r`
						ON `u`.`role` = `r`.`id`
				WHERE `u`.`id` = :id";
		$rq = $this->db->prepare($sql);

		$rq->execute(array("id" => $newUserID));
		
		return $rq->fetch(PDO::FETCH_ASSOC);
	}

	function getUserTasks($newUserID){
		$sql = "SELECT
					`p`.`projectname_" . $_SESSION["lang"]->locale . "` as `projectName`,
					`p`.`id` as `projectID`,
					`t`.`taskname_" . $_SESSION["lang"]->locale . "` as `taskName`,
					`t`.`id` as `taskID`
				FROM
					`user` as `u`
					INNER JOIN `user_task` as `ut`
						ON (`u`.`id` = `ut`.`id_user` AND `ut`.`date_end` IS NULL)
					INNER JOIN `task` as `t`
						ON `ut`.`id_task` = `t`.`id`
					LEFT JOIN `project` as `p`
						ON `t`.`id_project` = `p`.`id`
				WHERE
					`u`.`id` = :id
					AND `t`.`progression` != 100";

		$rq = $this->db->prepare($sql);

		$rq->execute(array("id" => $newUserID));

		return $rq->fetchAll(PDO::FETCH_ASSOC);
	}

	private function checkHasTeam($userID, $teamID) {
		$sql_check = "SELECT COUNT(*) AS `exists` FROM `user_team` WHERE `id_user`=:user AND `id_team`=:team";
		$rq_check = $this->db->prepare($sql_check);

		$rq_check->execute(array(
			"user" => $userID,
			"team" => $teamID,
		));

		$check = $rq_check->fetch(PDO::FETCH_ASSOC);
		return $check["exists"] >= 1;
	}

	private function toggleTeam($userID, $teamID) {
		if ($this->checkHasTeam($userID, $teamID)) {
			$this->removeTeam($userID, $teamID);
		} else {
			$this->addTeam($userID, $teamID);
		}
	}

	private function addTeam($userID, $teamID) {
		if (!$this->checkHasTeam($userID, $teamID)) {
			$sql_do = "INSERT INTO `user_team` (`id_user`, `id_team`) VALUES (:user, :team)";
			$rq_do = $this->db->prepare($sql_do);

			$rq_do->execute(array(
				"user" => $userID,
				"team" => $teamID,
			));
		}
	}

	private function removeTeam($userID, $teamID) {
		if ($this->checkHasTeam($userID, $teamID)) {
			$sql_do = "DELETE FROM `user_team` WHERE `id_user`=:user AND `id_team`=:team";
			$rq_do = $this->db->prepare($sql_do);

			$rq_do->execute(array(
				"user" => $userID,
				"team" => $teamID,
			));
		}
	}
}