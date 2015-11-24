<?php 

namespace Helpers\i18n;

class en extends Translations {

	public function __construct() {
		parent::__construct();
	}

	protected function loadTranslation() {
		$this->_translations = array(
			"APPNAME" => "Unit Costing",
		// Actions
			"ADD" => "Add",
			"CREATE" => "New",
			"MODIFY" => "Modify",
			"DELETE" => "Delete",
			"SAVE" => "Save",
			"SEARCH" => "Search",
			"REMOVE" => "Remove",
			"SELECT" => "Select a value",
			"OBJECT" => "Object",
			"SHOW" => "Show",
			"MORE" => "More",
		// Menu content
			"HOME" => "Home page",
			"LANG" => "Language",
			"CONNECT" => "Log in",
			"CONNEXION" => "Log in",
			"DECONNEXION" => "Log out",
			"MADMIN" => "Administration's menu",
			// User related
			"MUSERS" => "Users",
			"USERLIST" => "User list",
			"CHANGEPSWD" => "Change your password",
			// Datas related
			"MDATAADMIN" => "Data's administration menu",
			"MDATA" => "Data's menu",
			"DATAS" => "Datas",
			"RTDATAS" => "Real time datas",
			"SDATAS" => "Saved datas",
			"DATALIST" => "Edit or Delete datas",
			// Netbackup Team related
			"M_NETBACKUP" => "Netbackup",
			// -- Master servers related
			"M_MSERVER" => "Master servers",
			"MSERVERLIST" => "Edit or delete master servers",
			// BT Team related
			"M_BT" => "BT",
			// Citrix Team related
			"M_CITRIX" => "Citrix",
		// languages names
			"LFR" => "French",
			"LEN" => "English",
		// country  names
			"FR" => "France",
			"IN" => "India",
		// Error messages
			"E404" => "Page not found",
			"E404_TEXT" => "Please contact the administrator if the error persist",
			"E403" => "Forbidden access",
			"E403_TEXT" => "You don't have the authorization to go to this page",
			"ENODATE" => "No date defined",
			"ENODATE_TEXT" => "This script need a date to be launched.<br>
			Please contact the administrator to have a correct link to start this script",
			"EUSEREXISTS" => "User already exists",
		// Form Messages
			// -- Data error
			"MISSING_TO" => "Field \"To\" is empty",
			"MISSING_NB_JOBS " => "Field \"nb_jobs\" is empty",
			"MISSING_MONTH" => "Field \"month\" is empty",
			"MISSING_DATE" => "Field \"date\" is empty",
			"MISSING_MASTER_SERVER" => "Field \"master_server\" is empty",
		// Valid
			"FORMOK" => "Form is valid",
		// Page contents
		// -- Global
			"YES" => "Yes",
			"NO" => "No",
			"ID" => "Identifier",
			"ACTIVE" => "Active",
			"DELETED" => "Deleted",
			"ADMIN" => "Administrator",
			"USER" => "User",
			"DEV" => "Developer",
			"SELECTDATE" => "Please select a date",
			"DATEFORMAT" => "dd/mm/yyyy",
			"FROM" => "from",
			"TO" => "to",
			"COMMENT" => "Comment",
			"START" => "Start",
			"END" => "End",
			"EDS" => "Estimated date start",
			"EDE" => "Estimated date end",
			"REALDS" => "Real date start",
			"REALDE" => "Real date end",
			"CANCELLED" => "Cancelled",
			"DNOFIELDS" => "Veuillez remplir tous les champs du formulaire.",
			"MKINFOTITLE" => "How to add style to the documentation",
			"MKINFO" => "Use, at the begining of a line, as many # as the title level you want to show<br>
				Use * or - at the begining of a line to make a bullet point list<br>
				Use numbers at the begining of a line to make a numbered list<br>
				Use [word](url) for a link, for an image add an ! at the begining ![img](url)<br>
				Use * or _ to render some italic text<br>
				Use ** or __ to render bold text<br>
				Surround inline code with `<br>
				Use 4 spaces for blocks of code<br>
				Use > in the begining of a line to quote",
			"MAXSIZE" => "Max file size",
			"AUTHFORMAT" => "Allowed filetypes",
			"WELCOME" => "Welcome",
			"PLEASE_LOGIN" => "Please, log in",
		// -- User related
			"LOGIN" => "Login",
			"FNAME" => "First name",
			"LNAME" => "Last name",
			"EMAIL" => "Email",
			"PSWD" => "Password",
			"OLDPSWD" => "Old password",
			"NEWPSWD" => "New password",
			"NEWPSWDVERIF" => "Re-enter your new password",
			"DOLDPSWD" => "Old password incorrect",
			"DNEWPSWD" => "Password verification failed. The password and it's verification are not identical",
			"SPSWDMODIFY" => "Password successfuly changed",
			"PSWDRULES" => "Password need to be at least 5 characters long",
			"NOUSERFOUND" => "No user found",
			"SUSERCREATE" => "User successfully created",
			"SUSERMODIFY" => "User successfully updated",
			"SUSERDELETE" => "User successfully deleted",
			"DNOACCOUNT" => "Connection failed : Login or password incorrect. <br>If the problem persist, please contact the administrator.",
			"DNOACTIVE" => "Connection failed : Your account has been disactivated or is not active yet. Please contact the administrator if this is not a normal behaviour.",
			"DUSERDELETED" => "Connection failed : Your account has been deleted. Please contact the administrator if this is not a normal behaviour.",
			// -- Form 
			"FORMINCOMPLETE" => "Incomplete form",
			"MISSING_FIRSTNAME" => "Field First Name is empty",
			"MISSING_LASTNAME" => "Field Last Name is empty",
			"MISSING_EMAIL" => "Field Email is empty",
			"MISSING_LOGIN" => "Field Login is empty",
			"MISSING_PASSWORD" => "Field Password is empty",
		// -- Team related
			"TEAMS" => "Teams",
			"NOTEAMS" => "No part of any team",
		// -- Graph related
			"GRAPH" => "Graph",
			"GRAPHS" => "Graphs",
			"ANALYSEGRAPHS" => "Graphical analyzes",
		// -- Server related
			"MSERVER" => "Master server",
			"NOMSERVERFOUND" => "No master server found",
			"EMSERVEREXISTS" => "Master server already exists",
			"SMSERVERCREATE" => "Master server created",
			"SMSERVERMODIFY" => "Master server modified",
			"SMSERVERDELETE" => "Master server deleted",
		// -- Data related
			"NODATAFOUND" => "No data found",
			"EDATAEXISTS" => "This data already exists",
			"SDATACREATED" => "Data created",
			"SDATAMODIFY" => "Data modified",
			"SDATADELETE" => "Data deleted",
		// -- Other details
			"README" => "developer's readme",
			"NAME" => "Name",
			"PROFIT" => "Profit",
			"PROGRESSION" => "Advancement",
			"PPROGRESSION" => "Project advancement",
			"NEEDED" => "Needed field",
			"ISSU" => "This role has all the authorizations possible. This is a \"super user\".",
		); 
	}
}