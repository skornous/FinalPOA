<?php

	namespace Models\Entities;

	class User extends Entity {

		private $id;
		private $firstname;
		private $lastname;
		private $email;
		private $login;
		private $password;
		private $active;
		private $deleted;
		private $teams;
		private $auths;

		public function __construct() {

			parent::__construct();
		}

		public function exchangeArray($data) {

			$this->id = (isset($data["id"])) ? $data["id"] : null;
			$this->firstname = (isset($data["firstname"])) ? $data["firstname"] : null;
			$this->lastname = (isset($data["lastname"])) ? $data["lastname"] : null;
			$this->login = (isset($data["login"])) ? $data["login"] : null;
			$this->email = (isset($data["email"])) ? $data["email"] : null;
			$this->active = (isset($data["active"])) ? (bool)$data["active"] : null;
			$this->deleted = (isset($data["deleted"])) ? (bool)$data["deleted"] : null;
			if (isset($data["password"])) {
				$this->setPassword($data["password"]);
			}
			$this->teams = (isset($data["teams"])) ? $data["teams"] : null;
			$this->auths = (isset($data["auths"])) ? $data["auths"] : null;

			return $this;
		}

		public function isPartOf($teamLookup) {

			// teams not defined yet
			if ($this->teams === null || empty($this->teams)) {
				return false;
			}

			// what to compare to ?
			if (is_int($teamLookup)) {
				$searchID = 'id';
			} else {
				if (is_string($teamLookup)) {
					$searchID = 'name';
				} else {
					return false;
				}
			}

			// search for the team
			foreach ($this->teams as $team) {
				// part of the admin team = part of every teams
				if ($team['id'] == 0 || $team['name'] == "Admin") {
					return true;
				}
				if ($team[$searchID] == $teamLookup) {
					return true;
				}
			}

			// team not found
			return false;
		}

		public function isStrictlyPartOf($teamLookup) {

			// teams not defined yet
			if ($this->teams === null || empty($this->teams)) {
				return false;
			}

			// what to compare to ?
			if (is_int($teamLookup)) {
				$searchID = 'id';
			} else {
				if (is_string($teamLookup)) {
					$searchID = 'name';
				} else {
					return false;
				}
			}

			// search for the team
			foreach ($this->teams as $team) {
				if ($team[$searchID] == $teamLookup) {
					return true;
				}
			}

			// team not found
			return false;
		}

		public function extractTeamsIds() {

			if ($this->teams === null || empty($this->teams)) {
				return [];
			}
			$teamsIds = [];
			foreach ($this->teams as $team) {
				$teamsIds[] = $team['id'];
			}

			return $teamsIds;
		}

		public function can($action = null, $object = null) {

			// does the action and the object are rigthly sets ?
			if (is_null($action) || is_null($object)) {
				return false;
			}
			// does the user have all the existing rights ?
			if (array_key_exists("all", $this->auths) && in_array("all", $this->auths["all"])) {
				return true;
			}
			// does the user have the right to do that action on any objects ?
			if (array_key_exists("all", $this->auths) && in_array($action, $this->auths["all"])) {
				return true;
			}
			// does the user have all rights on the given object ?
			if (array_key_exists($object, $this->auths) && in_array("all", $this->auths[$object])) {
				return true;
			}
			// does the user can do the given action on the given object ?
			// var_dump($this->auths);
			return (array_key_exists($object, $this->auths) && in_array($action, $this->auths[$object]));
		}

		/*public function canAccessEditMenu() {
			return (
				$this->canAccessEditMenuOnObject("user")	||
				$this->canAccessEditMenuOnObject("data")
			);
		}*/

		public function canAccessEditMenuOnObject($object = null) {

			if (is_null($object)) {
				return false;
			}

			return (
				$this->can("add", $object) ||
				$this->can("see", $object) ||
				$this->can("edit", $object) ||
				$this->can("delete", $object)
			);
		}

		// ----- Static functions ----- //
		public static function createFromArray($data) {

			$user = new User();
			$user->exchangeArray($data);

			return $user;
		}

		// ----- Getters & Setters ----- //
		public function getId() {

			return $this->id;
		}

		public function setId($id) {

			$this->id = $id;

			return $this;
		}

		public function getFirstname() {

			return $this->firstname;
		}

		public function setFirstname($firstname) {

			$this->firstname = $firstname;

			return $this;
		}

		public function getLastname() {

			return $this->lastname;
		}

		public function setLastname($lastname) {

			$this->lastname = $lastname;

			return $this;
		}

		public function getLogin() {

			return $this->login;
		}

		public function setLogin($login) {

			$this->login = $login;

			return $this;
		}

		public function getEmail() {

			return $this->email;
		}

		public function setEmail($email) {

			$this->email = $email;

			return $this;
		}

		public function getActive() {

			return $this->active;
		}

		public function setActive($active) {

			$this->active = $active;

			return $this;
		}

		public function getDeleted() {

			return $this->deleted;
		}

		public function setDeleted($deleted) {

			$this->deleted = $deleted;

			return $this;
		}

		public function getPassword() {

			return $this->password;
		}

		public function setPassword($password) {

			$this->password = md5($password);

			return $this;
		}

		public function getTeams() {

			return $this->teams;
		}

		public function setTeams($teams) {

			$this->teams = $teams;

			return $this;
		}

		public function getAuths() {

			return $this->auths;
		}

		public function setAuths($auths) {

			$this->auths = $auths;

			return $this;
		}
	}