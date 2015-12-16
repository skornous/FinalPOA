<?php

	namespace Controllers;

	use Controllers\AppController;
	use \Models\Entities\User;

	class ScriptController extends AppController {

		private $scriptPath;

		public function __construct() {

			parent::__construct();
			$this->loadModel('Script');
			$this->scriptPath = ROOT . DIRECTORY_SEPARATOR . 'Scripts' . DIRECTORY_SEPARATOR;
		}

		public function getNbScriptDatas($saving = true) {

			if ((isset($_GET) && isset($_GET["month"])) || (isset($_POST) && isset($_POST["month"]))) {
				$date = htmlspecialchars((isset($_POST["month"]) ? $_POST["month"] : $_GET["month"]));
				$currMonth = ["month" => date("Y-m-t", strtotime($date))];
				$scripts = [
					// "nb_server" => "nb_serveurs",
					"nbi_SAP"    => "nb_instances_SAP",
					"nbi_ORACLE" => "nb_instances_ORACLE",
					"nbi_SQL"    => "nb_instances_SQL",
					"nb_ESX"     => "nb_ESX",
					"nb_CITRIX"  => "nb_CITRIX",
				];
				// get datas for this month
				foreach ($scripts as $var => $func) {
					$currMonth[$var] = $this->Script->getScriptInfo($func, $date, false);
				}
				$currMonth["nb_NETBACKUP"] = $this->Script->getInfo("nb_NETBACKUP", $date);
				$currMonth["nb_BT"] = $this->Script->getInfo("nb_BT", $date);
				// var_dump($currMonth);
				$datas = [
					"currentMonth" => $this->applyCoefs($currMonth),
				];
				if (!$saving) {
					$monthMinus12 = ["endMonth" => date("Y-m-t", strtotime($date))];
					// get datas for the 12 months
					foreach ($scripts as $var => $func) {
						$monthMinus12[$var] = $this->Script->getScriptInfo12($func, $date, false);
					}
					$monthMinus12["nb_NETBACKUP"] = $this->Script->getInfo12("nb_NETBACKUP", $date);
					$monthMinus12["nb_BT"] = $this->Script->getInfo12("nb_BT", $date);

					$datas["monthMinus12"] = $this->applyCoefs($monthMinus12);
				}

				$scriptDatas = ["view" => "data.datas", "datas" => $datas];
			} else {
				$scriptDatas = ["view" => "errors.scriptNoDate", "datas" => null];
			}

			// var_dump($scriptDatas);

			return $scriptDatas;
		}

		public function getStockedDatas() {

			if ((isset($_GET) && isset($_GET["month"])) || (isset($_POST) && isset($_POST["month"]))) {
				$date = htmlspecialchars((isset($_POST) ? $_POST["month"] : $_GET["month"]));
				$currMonth = ["month" => date("Y-m-t", strtotime($date))];
				$scripts = [
					// "nb_server" => "nb_serveurs",
					"nbi_SAP"    => "nb_instances_SAP",
					"nbi_ORACLE" => "nb_instances_ORACLE",
					"nbi_SQL"    => "nb_instances_SQL",
					"nb_ESX"     => "nb_ESX",
					"nb_CITRIX"  => "nb_CITRIX",
					// "nb_BT" => "nb_BT",
					// "nb_NETBACKUP" => "nb_NETBACKUP",
				];
				// get datas for this month
				foreach ($scripts as $var => $func) {
					$currMonth[$var] = $this->Script->getStockedInfo($func, $date);
				}
				$currMonth["nb_NETBACKUP"] = $this->Script->getInfo("nb_NETBACKUP", $date);
				$currMonth["nb_BT"] = $this->Script->getInfo("nb_BT", $date);

				$monthMinus12 = ["endMonth" => date("Y-m-t", strtotime($date))];
				// get datas for the 12 months
				foreach ($scripts as $var => $func) {
					$monthMinus12[$var] = $this->Script->getStockedInfo12($func, $date);
				}

				$monthMinus12["nb_NETBACKUP"] = $this->Script->getInfo12("nb_NETBACKUP", $date);
				$monthMinus12["nb_BT"] = $this->Script->getInfo12("nb_BT", $date);

				$datas = [
					"currentMonth" => $this->applyCoefs($currMonth),
					"monthMinus12" => $this->applyCoefs($monthMinus12),
				];

				$scriptDatas = ["view" => "data.datas", "datas" => $datas];
			} else {
				$scriptDatas = ["view" => "errors.scriptNoDate", "datas" => null];
			}

			// var_dump($scriptDatas);

			return $scriptDatas;
		}

		public function getPeriod() {

			$now = date("Y-m-t");
			$nowMinus6monthes = date("Y-m-t", strtotime($now . "-6 months"));
			// var_dump($now, $nowMinus6monthes);
			$tmpPeriod = $this->Script->getPeriod($now, $nowMinus6monthes);
			// var_dump($tmpPeriod);
			$period = [];
			foreach ($tmpPeriod as $month) {
				$period[] = date("Y-m", strtotime($month["mois"]));
			}

			return $period;
		}

		public function saveDatas() {

			$datas = $this->getNbScriptDatas(true);
			$datas = $datas["datas"]["currentMonth"];
			foreach ($datas as $key => $value) {
				if ($key != "month" && $key != "nb_BT" && $key != "nb_NETBACKUP") {
					// var_dump($this->Script->alreadySaved($key, $datas["month"]), $key, $datas["month"]);
					// echo "<hr>";
					if (!$this->Script->alreadySaved($key, $datas["month"])) {
						// var_dump($key, $value);
						$this->Script->stockDatas($key, $value, $datas["month"]);
					}
				}
			}
			// var_dump($datas);
		}

		protected function run($script, $variables = []) {

			$script = explode(".", $script);
			extract($variables);
			$lang = $this->lang;
			require($this->scriptPath . str_replace('.', DIRECTORY_SEPARATOR, $script) . '.php');
		}

		// -- Private method -- //
		private function applyCoefs($datas) {

			if (is_array($datas["nbi_SQL"]) && is_array($datas["nbi_ORACLE"])) {
				foreach ($datas["nbi_SQL"] as $key => $value) {
					$datas["nbi_SQL"][$key] = floatval($value) * 10.62;
				}
				foreach ($datas["nbi_ORACLE"] as $key => $value) {
					$coef = floatval($datas["nbi_SAP"][$key]) + (floatval($datas["nbi_SAP"][$key]) * 0.25);
					$datas["nbi_ORACLE"][$key] = floatval($value) - $coef;
				}
			} else {
				$datas["nbi_SQL"] = floatval($datas["nbi_SQL"]) * 10.62;
				$datas["nbi_ORACLE"] = floatval($datas["nbi_ORACLE"]) - (floatval($datas["nbi_SAP"]) + (floatval($datas["nbi_SAP"]) * 0.25));
			}

			return $datas;
		}
	}