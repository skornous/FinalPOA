<?php 

namespace Controllers;

use Controllers\AppController;
use Models\Entities\Team;

class DataController extends AppController {

	private $team;

	public function __construct() {
		parent::__construct();
		$this->loadModel('Team');
		$this->loadModel('Data');
		$this->team = null;
	}

	// ----- Actions ----- //
	public function showDatasForTeam($teamId, $state = null) {
		$team = $this->initTeam($teamId);

		$datas = $this->Data->getAll();
		// var_dump($datas);
		$compact = compact('team', 'datas');
		if (!is_null($state)) {
			$compact = array_merge($compact, compact('state'));
		}
		$this->render("data.team", $compact);
	}

	public function showRTDatas() {
		$this->showDatas("RT");
	}

	public function showSDatas() {
		$this->showDatas("S");
	}

	public function create($teamId) {
		$team = $this->initTeam($teamId);
		if ($_SESSION["User"]->can("add", "data") && $_SESSION["User"]->isPartOf($this->team->name)) {
			$formDatas = $_POST;
			$verif = $this->verifyCreateForm($formDatas);
			if($verif["err"] === 0) {
				// var_dump($formDatas);
				$state = $this->Data->create($formDatas);
				// $this->render("data.create." . strtolower($this->team->name), compact('team', 'state'));
			} else {
				$state = $verif["state"];
				// $this->render("data.create." . strtolower($this->team->name), compact('team', 'state', 'formDatas'));
			}
				$this->createForm($teamId, $state);
		} else {
			$this->render("errors.403");
		}
	}

	public function modify($teamId, $id) {
		$team = $this->initTeam($teamId);
		if ($_SESSION["User"]->can("edit", "data") && $_SESSION["User"]->isPartOf($this->team->name)) {
			$formDatas = $_POST;
			$verif = $this->verifyModifyForm($formDatas);
			if($verif["err"] === 0) {
				// var_dump($formDatas);
				$state = $this->Data->modify($formDatas);

				$datas = $this->Data->getAll();
				// var_dump($datas);
				$this->render("data.team", compact('team', 'datas', 'state'));
			} else {
				$state = $verif["state"];
				$this->redirect("/datas/" . strtolower($this->team->name) . "/modify/" . $id);
				$this->render("data.team", compact('team', 'state', 'formDatas'));
			}
		} else {
			$this->render("errors.403");
		}
	}

	public function delete($teamId, $id) {
		$team = $this->initTeam($teamId);
		if ($_SESSION["User"]->can("delete", "data") && $_SESSION["User"]->isPartOf($this->team->name)) {
			$formDatas = array("id" => htmlspecialchars($id));
			$verif = $this->verifyDeleteForm($formDatas);
			if($verif["err"] === 0) {
				// var_dump($formDatas);
				$state = $this->Data->delete($formDatas);
			} else {
				$state = $verif["state"];
			}
				$this->showDatasForTeam($teamId, $state);
		} else {
			$this->render("errors.403");
		}
	}

	// ----- Forms ----- //
	public function createForm($teamId, $state = null) {
		$team = $this->initTeam($teamId);
		if ($_SESSION["User"]->can("add", "data") && $_SESSION["User"]->isPartOf($this->team->name)) {
			if ($this->team->getHasMasterServer()) {
				$msList = $this->Data->getMasterServerList();
				$compact = compact('team', 'msList');
			} else {
				$compact = compact('team');
			}
			if(!is_null($state)) {
				$compact = array_merge($compact, compact('state'));
				// var_dump(array_merge($compact, compact('state')));exit;
			}
			$this->render("data.create." . lcfirst($team->name), $compact);
		} else {
			$this->render("errors.403");
		}
	}
	
	public function modifyForm($teamId, $id, $state = null) {
		$team = $this->initTeam($teamId);
		if ($_SESSION["User"]->can("edit", "data") && $_SESSION["User"]->isPartOf($this->team->name)) {
			$data = $this->Data->getById($id);
			if ($this->team->getHasMasterServer()) {
				$msList = $this->Data->getMasterServerList();
				$compact = compact('data', 'team', 'msList');
			} else {
				$compact = compact('data', 'team');
			}
			if(!is_null($state)) {
				$compact = array_merge($compact, compact('state'));
				// var_dump(array_merge($compact, compact('state')));exit;
			}
			$this->render("data.modify." . lcfirst($team->name), $compact);
		} else {
			$this->render("errors.403");
		}
	}

	public function showRTDatasForm($scriptDatas = null) {
		$this->showDatasForm("real_time", $scriptDatas);
	}

	public function showSDatasForm($scriptDatas = null) {
		$this->showDatasForm("stocked", $scriptDatas);
	}

	// ----- Verifiers ----- //
	private function verifyCreateForm($form) {
		return $this->verifyForm($form, $this->team->getRowsAsArray());
	}
	
	private function verifyModifyForm($form) {
		return $this->verifyForm($form, $this->team->getRowsAsArrayWithId());
	}
	
	private function verifyDeleteForm($form) {
		return $this->verifyForm($form, array("id"));
	}

	// ----- Private Methods ----- //
	private function initTeam($teamId) {
		if (is_null($this->team)) {
			$team = new Team();
			$team->exchangeArray($this->Team->getByName($teamId));
			$this->Data = $this->Data->initWithTeam($team);
			$this->team = $team;
		}
		return $this->team;
	}

	private function showDatas($shortType = "S") {
		$this->loadController("Script");
		$func = "show" . strtoupper($shortType) . "DatasForm";
		// var_dump($_POST);
		$this->registerScript("adds/js/charts");
		if ($shortType == "RT") {
			$this->$func($this->Script->getNbScriptDatas(false));
		} else if ($shortType == "S") {
			$this->$func($this->Script->getStockedDatas());
		}
	}

	private function showDatasForm($type = "stocked", $scriptDatas = null) {
		if ($_SESSION["User"]->can("see", "data")) {
			$this->loadController("Script");
			$view = "data.datas";
			if (!is_null($scriptDatas) && !empty($scriptDatas)) {
				$datas = $scriptDatas["datas"];
				$view = $scriptDatas["view"];
			}
			
			$months = $this->Script->getPeriod();
			// var_dump($datas);
			$this->render($view, compact('datas', 'months', 'type'));
		} else {
			$this->render("errors.403");
		}
	}
}