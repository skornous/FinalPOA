<?php

namespace Models;

use \PDO;
use Models\Model;

class ScriptModel extends Model {

	private $prod;

	function __construct() {
		parent::__construct();
		$this->prod = $this->getDB("root", "helios01", "localhost", "portail_prod");
	}

	public function getInfo($scriptName = null, $month = null) {
		if (is_null($scriptName) || is_null($month)) { return false; }
		$func = "get" . ucfirst($scriptName);
		$sql = $this->$func();

		$rq = $this->db->prepare($sql);
		$date = date("Y-m", strtotime($month)) . "%";
		$rq->execute(array("monthPerCent" => $date));
		// var_dump($rq, $date);
		// var_dump($rq->errorInfo());
		
		$res = $rq->fetch(PDO::FETCH_ASSOC);
		// var_dump($res);
		
		return $res["nb"];
	}

	public function getInfo12($scriptName = null, $month = null) {
		if (is_null($scriptName) || is_null($month)) { return false; }
		$func = "get" . ucfirst($scriptName) . "_12";
		$sql = $this->$func();

		$rq = $this->db->prepare($sql);
		$end = date("Y-m-t", strtotime($month));
		$start = date("Y-m-01", strtotime($end . "-12 months"));

		$rq->execute(array(
			"d_start" => $start,
			"d_end" => $end,
		));
		// var_dump($rq, $date);
		// var_dump($rq->errorInfo());
		
		$res = $rq->fetchAll(PDO::FETCH_ASSOC);
		// var_dump($res);
		$ret = array();
		foreach ($res as $val) {
			if (!array_key_exists(date("Y-m", strtotime($val['month'])), $ret)) {
				$ret[date("Y-m", strtotime($val['month']))] = floatval($val['nb']);
			} else {
				$ret[date("Y-m", strtotime($val['month']))] += floatval($val['nb']);
			}
		}
		
		return $ret;
		
		// return $res["nb"];
	}

	public function getScriptInfo($scriptName = null, $month = null, $v_uo = true) {
		if (is_null($scriptName) || is_null($month)) { return false; }
		$func = "get" . ucfirst($scriptName);
		$sql = $this->$func();
		// var_dump(date("Y-m-t", strtotime($month)));

		$rq = $this->prod->prepare($sql);

		$rq->execute(array(
			"month" => date("Y-m-t", strtotime($month)),
			"v_uo" => ($v_uo) ? "oui" : "%",
		));
		// var_dump($rq->errorInfo());
		
		$res = $rq->fetch(PDO::FETCH_ASSOC);
		
		return $res["nb"];
	}

	public function getScriptInfo12($scriptName = null, $month = null, $v_uo = true) {
		if (is_null($scriptName) || is_null($month)) { return false; }
		$func = "get" . ucfirst($scriptName) . "_12";
		$sql = $this->$func();

		$rq = $this->prod->prepare($sql);

		$rq->execute(array(
			"d_start" => date("Y-m-t", strtotime(date("Y-m-t", strtotime($month)) . "-12 months")),
			"d_end" => date("Y-m-t", strtotime($month)),
			"v_uo" => ($v_uo) ? "oui" : "%",
		));
		// var_dump($rq->errorInfo());

		$res = $rq->fetchAll(PDO::FETCH_ASSOC);
		$ret = array();
		foreach ($res as $val) {
			$ret[date("Y-m", strtotime($val['month']))] = $val['nb'];
		}
		
		return $ret;
	}

	public function getStockedInfo($scriptName = null, $month = null) {
		if (is_null($scriptName) || is_null($month)) { return false; }
		$func = "getStocked" . ucfirst($scriptName);
		$sql = $this->$func();

		$rq = $this->db->prepare($sql);

		$rq->execute(array("month" => date("Y-m-t", strtotime($month))));
		// var_dump($rq->errorInfo());
		
		$res = $rq->fetch(PDO::FETCH_ASSOC);
		
		return $res["nb"];
	}

	public function getStockedInfo12($scriptName = null, $month = null) {
		if (is_null($scriptName) || is_null($month)) { return false; }
		$func = "getStocked" . ucfirst($scriptName) . "_12";
		$sql = $this->$func();

		$rq = $this->db->prepare($sql);

		$rq->execute(array(
			"d_start" => date("Y-m-t", strtotime(date("Y-m-t", strtotime($month)) . "-12 months")),
			"d_end" => date("Y-m-t", strtotime($month)),
		));
		// var_dump($rq->errorInfo());
		
		$res = $rq->fetchAll(PDO::FETCH_ASSOC);
		$ret = array();
		foreach ($res as $val) {
			$ret[date("Y-m", strtotime($val['month']))] = $val['nb'];
		}
		
		return $ret;
	}


	public function getPeriod($start = null, $end = null) {
		if(is_null($start) || is_null($end)) { return false; }

		$sql = "SELECT
					`mois`
				FROM
					`slm_valcofin`
				WHERE
					`mois` >= :d_end
					AND `mois` <= :d_start
				GROUP BY
					`mois`
				ORDER BY
					`mois` DESC";

		$rq = $this->prod->prepare($sql);

		$rq->execute(array(
			"d_start" => $start,
			"d_end" => $end,
		));

		// var_dump($sql, $start, $end);

		// var_dump($rq->errorInfo());

		return $rq->fetchAll(PDO::FETCH_ASSOC);
	}

	public function alreadySaved($type, $date) {
		$sql = "SELECT count(`id`) AS `nb`
				FROM `data_stocked`
				WHERE
					`date` = :month
					AND `type` = :type";
		$rq = $this->db->prepare($sql);

		$rq->execute(array(
			"month" => date("Y-m-t", strtotime($date)),
			"type" => $type,
		));

		$res = $rq->fetch(PDO::FETCH_ASSOC);

		return $res["nb"] > 0;
	}

	public function stockDatas($type, $value, $month) {
		if (is_null($type) || is_null($value) || is_null($month)) { return false; }
		$sql = "INSERT INTO `data_stocked` (`date`, `type`, `value`) VALUES (:month, :type, :value)";

		$rq = $this->db->prepare($sql);

		$rq->execute(array(
			"month" => date("Y-m-t", strtotime($month)),
			"type" => $type,
			"value" => floatval($value),
		));

		return true;
	}


	// -- Private methods -- //

	/*private function getNb_serveurs() {
		return "SELECT COUNT(*) AS `nb`
				FROM `pif_serveurs` AS `s`
				INNER JOIN `slm_valcofin` AS `v` ON `v`.`mois` = `s`.`Mois Inventaire`
				WHERE `v`.`mois` = :month AND `v`.`validation_uo` = 'oui'";
	}*/

	// ***** Calculated ***** //

	// --- Gets for the current month

	private function getNb_instances_SAP() {
		return "SELECT COUNT(*) AS `nb`
				FROM `pif_bdd` AS `s`
					INNER JOIN `slm_valcofin` AS `v`
						ON `v`.`mois` = `s`.`Mois Inventaire`
				WHERE
					`v`.`mois` = :month
					AND `v`.`validation_uo` LIKE :v_uo
					AND s.`Code Sous-Lot` IN ('Template Light', 'Template Europe')";
	}

	private function getNb_instances_ORACLE() {
		return "SELECT COUNT(`pif`.`Code Serveur`) AS `nb`
				FROM
					`pif_bdd` AS `pif`
					INNER JOIN `slm_bdd` AS `slm`
						ON `pif`.`Code BDD` = `slm`.`nom_bdd`
					INNER JOIN `slm_valcofin` AS `v`
						ON `v`.`mois` = `pif`.`Mois Inventaire`
				WHERE 
					`v`.`mois` = :month
					AND `v`.`validation_uo` LIKE :v_uo
					AND `slm`.`type_bdd` = 'ORACLE'";
	}

	private function getNb_instances_SQL() {
		return "SELECT COUNT(`pif`.`Code Serveur`) AS `nb`
				FROM
					`pif_bdd` AS `pif`
					INNER JOIN `slm_bdd` AS `slm`
						ON `pif`.`Code BDD` = `slm`.`nom_bdd`
					INNER JOIN `slm_valcofin` AS `v`
						ON `v`.`mois` = `pif`.`Mois Inventaire`
				WHERE 
					`v`.`mois` = :month
					AND `v`.`validation_uo` LIKE :v_uo
					AND `slm`.`type_bdd` = 'SQL SERVER'";
	}

	private function getNb_ESX() {
		return "SELECT COUNT(`pif`.`Code Serveur`) AS `nb`
				FROM
					`pif_serveurs` AS `pif`
					INNER JOIN `slm_serveurs` AS `slm`
						ON `pif`.`Code Serveur` = `slm`.`nom_serveur`
					INNER JOIN `slm_valcofin` AS `v`
						ON `v`.`mois` = `pif`.`Mois Inventaire`
				WHERE 
					`v`.`mois` = :month
					AND `v`.`validation_uo` LIKE :v_uo
					AND `slm`.`master` = 'ESX'";
	}

	private function getNb_CITRIX() {
		return "SELECT COUNT(*) AS `nb`
				FROM
					`pif_serveurs` AS `pif`
					INNER JOIN `slm_serveurs` AS `slm`
						ON `pif`.`Code Serveur` = `slm`.`nom_serveur`
					INNER JOIN `slm_valcofin` AS `v`
						ON `v`.`mois` = `pif`.`Mois Inventaire`
				WHERE 
					`v`.`mois` = :month
					AND `v`.`validation_uo` LIKE :v_uo
					AND `slm`.`System_Role` LIKE 'Server CITRIX%'
					AND `slm`.`date_sortie_perimetre_helios` = ''";
	}

	// --- Gets for the 12 last months

	private function getNb_instances_SAP_12() {
		return "SELECT COUNT(*) AS `nb`, `v`.`mois` AS `month`
				FROM `pif_bdd` AS `s`
					INNER JOIN `slm_valcofin` AS `v`
						ON `v`.`mois` = `s`.`Mois Inventaire`
				WHERE
					`v`.`mois` >= :d_start AND `v`.`mois` <= :d_end
					AND `v`.`validation_uo` LIKE :v_uo
					AND s.`Code Sous-Lot` IN ('Template Light', 'Template Europe')
				GROUP BY `v`.`mois`
				ORDER BY `v`.`mois` ASC";
	}

	private function getNb_instances_ORACLE_12() {
		return "SELECT COUNT(`pif`.`Code Serveur`) AS `nb`, `v`.`mois` AS `month`
				FROM
					`pif_bdd` AS `pif`
					INNER JOIN `slm_bdd` AS `slm`
						ON `pif`.`Code BDD` = `slm`.`nom_bdd`
					INNER JOIN `slm_valcofin` AS `v`
						ON `v`.`mois` = `pif`.`Mois Inventaire`
				WHERE 
					`v`.`mois` >= :d_start AND `v`.`mois` <= :d_end
					AND `v`.`validation_uo` LIKE :v_uo
					AND `slm`.`type_bdd` = 'ORACLE'
				GROUP BY `v`.`mois`
				ORDER BY `v`.`mois` ASC";
	}

	private function getNb_instances_SQL_12() {
		return "SELECT COUNT(`pif`.`Code Serveur`) AS `nb`, `v`.`mois` AS `month`
				FROM
					`pif_bdd` AS `pif`
					INNER JOIN `slm_bdd` AS `slm`
						ON `pif`.`Code BDD` = `slm`.`nom_bdd`
					INNER JOIN `slm_valcofin` AS `v`
						ON `v`.`mois` = `pif`.`Mois Inventaire`
				WHERE 
					`v`.`mois` >= :d_start AND `v`.`mois` <= :d_end
					AND `v`.`validation_uo` LIKE :v_uo
					AND `slm`.`type_bdd` = 'SQL SERVER'
				GROUP BY `v`.`mois`
				ORDER BY `v`.`mois` ASC";
	}

	private function getNb_ESX_12() {
		return "SELECT COUNT(`pif`.`Code Serveur`) AS `nb`, `v`.`mois` AS `month`
				FROM
					`pif_serveurs` AS `pif`
					INNER JOIN `slm_serveurs` AS `slm`
						ON `pif`.`Code Serveur` = `slm`.`nom_serveur`
					INNER JOIN `slm_valcofin` AS `v`
						ON `v`.`mois` = `pif`.`Mois Inventaire`
				WHERE 
					`v`.`mois` >= :d_start AND `v`.`mois` <= :d_end
					AND `v`.`validation_uo` LIKE :v_uo
					AND `slm`.`master` LIKE 'ESX%'
				GROUP BY `v`.`mois`
				ORDER BY `v`.`mois` ASC";
	}

	private function getNb_CITRIX_12() {
		return "SELECT COUNT(*) AS `nb`, `v`.`mois` AS `month`
				FROM
					`pif_serveurs` AS `pif`
					INNER JOIN `slm_serveurs` AS `slm`
						ON `pif`.`Code Serveur` = `slm`.`nom_serveur`
					INNER JOIN `slm_valcofin` AS `v`
						ON `v`.`mois` = `pif`.`Mois Inventaire`
				WHERE 
					`v`.`mois` >= :d_start AND `v`.`mois` <= :d_end
					AND `v`.`validation_uo` LIKE :v_uo
					AND `slm`.`System_Role` = 'Server CITRIX'
					AND `slm`.`date_sortie_perimetre_helios` = ''
				GROUP BY `v`.`mois`
				ORDER BY `v`.`mois` ASC";
	}

	// ***** Stocked ***** //

	// --- Gets for the current month

	private function getStockedNb_instances_SAP() {
		return "SELECT `value` as `nb` FROM `data_stocked` WHERE `date` = :month AND `type`='nbi_SAP'";
	}

	private function getStockedNb_instances_ORACLE() {
		return "SELECT `value` as `nb` FROM `data_stocked` WHERE `date` = :month AND `type`='nbi_ORACLE'";
	}

	private function getStockedNb_instances_SQL() {
		return "SELECT `value` as `nb` FROM `data_stocked` WHERE `date` = :month AND `type`='nbi_SQL'";
	}

	private function getStockedNb_ESX() {
		return "SELECT `value` as `nb` FROM `data_stocked` WHERE `date` = :month AND `type`='nb_ESX'";
	}

	private function getStockedNb_CITRIX() {
		return "SELECT `value` as `nb` FROM `data_stocked` WHERE `date` = :month AND `type`='nb_CITRIX'";
	}

	// --- Gets for the 12 last months

	private function getStockedNb_instances_SAP_12() {
		return "SELECT `value` AS `nb`, `date` AS `month`
				FROM `data_stocked`
				WHERE
					`date` >= :d_start AND `date` <= :d_end
					AND `type`='nbi_SAP'
				ORDER BY `date` ASC";
	}

	private function getStockedNb_instances_ORACLE_12() {
		return "SELECT `value` AS `nb`, `date` AS `month`
				FROM `data_stocked`
				WHERE
					`date` >= :d_start AND `date` <= :d_end
					AND `type`='nbi_ORACLE'
				ORDER BY `date` ASC";
	}

	private function getStockedNb_instances_SQL_12() {
		return "SELECT `value` AS `nb`, `date` AS `month`
				FROM `data_stocked`
				WHERE
					`date` >= :d_start AND `date` <= :d_end
					AND `type`='nbi_SQL'
				ORDER BY `date` ASC";
	}

	private function getStockedNb_ESX_12() {
		return "SELECT `value` AS `nb`, `date` AS `month`
				FROM `data_stocked`
				WHERE
					`date` >= :d_start AND `date` <= :d_end
					AND `type`='nb_ESX'
				ORDER BY `date` ASC";
	}

	private function getStockedNb_CITRIX_12() {
		return "SELECT `value` AS `nb`, `date` AS `month`
				FROM `data_stocked`
				WHERE
					`date` >= :d_start AND `date` <= :d_end
					AND `type`='nb_CITRIX'
				ORDER BY `date` ASC";
	}


	// ***** Stocked ***** //

	// --- Gets for the current month

	private function getNb_NETBACKUP() {
		return "SELECT SUM(`To`) AS `nb` FROM `data_netbackup` WHERE `month` LIKE :monthPerCent";
	}

	private function getNb_BT() {
		return "SELECT SUM(`nb_jobs`) AS `nb` FROM `data_bt` WHERE `date` LIKE :monthPerCent";
	}


	// --- Gets for the 12 last months

	private function getNb_NETBACKUP_12() {
		return "SELECT SUM(`To`) AS `nb`, `month`
				FROM `data_netbackup`
				WHERE `month` >= :d_start AND `month` <= :d_end
				GROUP BY `month`
				ORDER BY `month` ASC";
	}

	private function getNb_BT_12() {
		return "SELECT SUM(`nb_jobs`) AS `nb`, `date` AS `month`
				FROM `data_bt`
				WHERE `date` >= :d_start AND `date` <= :d_end
				GROUP BY `date`
				ORDER BY `date` ASC";
	}

}