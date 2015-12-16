<?php

	namespace Helpers\i18n;

	class en extends Translations {

		public function __construct() {

			parent::__construct();
		}

		protected function loadTranslation() {

			$this->_translations = [
				"APPNAME"               => "Games",
				// Actions
				"ADD"                   => "Add",
				"CREATE"                => "New",
				"MODIFY"                => "Modify",
				"DELETE"                => "Delete",
				"SAVE"                  => "Save",
				"SEARCH"                => "Search",
				"REMOVE"                => "Remove",
				"SELECT"                => "Select a value",
				"OBJECT"                => "Object",
				"SHOW"                  => "Show",
				"MORE"                  => "More",
				// Menu content
				"HOME"                  => "Home page",
				"LANG"                  => "Language",
				"CONNECT"               => "Log in",
				"CONNEXION"             => "Log in",
				"DECONNEXION"           => "Log out",
				"MADMIN"                => "Administration's menu",
				// User related
				"MUSERS"                => "Users",
				"USERLIST"              => "User list",
				"CHANGEPSWD"            => "Change your password",
				// languages names
				"LFR"                   => "French",
				"LEN"                   => "English",
				// country  names
				"FR"                    => "France",
				// Error messages
				"E404"                  => "Page not found",
				"E404_TEXT"             => "Click here to go back to life",
				"E403"                  => "Forbidden access",
				"E403_TEXT"             => "You don't have the authorization to go to this page",
				"ENODATE"               => "No date defined",
				"ENODATE_TEXT"          => "This script need a date to be launched.<br>
			Please contact the administrator to have a correct link to start this script",
				"EUSEREXISTS"           => "User already exists",
				// Form Messages
				// Valid
				"FORMOK"                => "Form is valid",
				// Page contents
				// -- Global
				"YES"                   => "Yes",
				"NO"                    => "No",
				"ID"                    => "Identifier",
				"ACTIVE"                => "Active",
				"DELETED"               => "Deleted",
				"ADMIN"                 => "Administrator",
				"USER"                  => "User",
				"DEV"                   => "Developer",
				"SELECTDATE"            => "Please select a date",
				"DATEFORMAT"            => "dd/mm/yyyy",
				"FROM"                  => "from",
				"TO"                    => "to",
				"COMMENT"               => "Comment",
				"START"                 => "Start",
				"END"                   => "End",
				"DNOFIELDS"             => "Veuillez remplir tous les champs du formulaire.",
				"WELCOME"               => "Welcome",
				// -- User related
				"LOGIN"                 => "Login",
				"FNAME"                 => "First name",
				"LNAME"                 => "Last name",
				"EMAIL"                 => "Email",
				"PSWD"                  => "Password",
				"OLDPSWD"               => "Old password",
				"NEWPSWD"               => "New password",
				"NEWPSWDVERIF"          => "Re-enter your new password",
				"DOLDPSWD"              => "Old password incorrect",
				"DNEWPSWD"              => "Password verification failed. The password and it's verification are not identical",
				"SPSWDMODIFY"           => "Password successfuly changed",
				"PSWDRULES"             => "Password need to be at least 5 characters long",
				"NOUSERFOUND"           => "No user found",
				"SUSERCREATE"           => "User successfully created",
				"SUSERMODIFY"           => "User successfully updated",
				"SUSERDELETE"           => "User successfully deleted",
				"DNOACCOUNT"            => "Connection failed : Login or password incorrect. <br>If the problem persist, please contact the administrator.",
				"DNOACTIVE"             => "Connection failed : Your account has been disactivated or is not active yet. Please contact the administrator if this is not a normal behaviour.",
				"DUSERDELETED"          => "Connection failed : Your account has been deleted. Please contact the administrator if this is not a normal behaviour.",
				// -- Form
				"FORMINCOMPLETE"        => "Incomplete form",
				"MISSING_FIRSTNAME"     => "Field First Name is empty",
				"MISSING_LASTNAME"      => "Field Last Name is empty",
				"MISSING_EMAIL"         => "Field Email is empty",
				"MISSING_LOGIN"         => "Field Login is empty",
				"MISSING_PASSWORD"      => "Field Password is empty",
			];
		}
	}