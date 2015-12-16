<?php 

namespace Helpers\i18n;

class fr extends Translations {

	public function __construct() {
		parent::__construct();
	}

	protected function loadTranslation() {
		$this->_translations = array(
			"APPNAME" => "Unit Costing",
		// Actions
			"ADD" => "Ajouter",
			"CREATE" => "Nouveau",
			"MODIFY" => "Modifier",
			"DELETE" => "Supprimer",
			"SAVE" => "Enregistrer",
			"SEARCH" => "Rechercher",
			"REMOVE" => "Retirer",
			"SELECT" => "Choisissez une valeur",
			"OBJECT" => "Objet",
			"SHOW" => "Voir",
			"MORE" => "Plus",
		// Menu content
			"HOME" => "Accueil",
			"LANG" => "Langue",
			"CONNECT" => "Se connecter",
			"CONNEXION" => "Connexion",
			"DECONNEXION" => "Deconnexion",
			"MADMIN" => "Menu d'administration",
			// User related
			"MUSERS" => "Utilisateurs",
			"USERLIST" => "Liste des utilisateurs",
			"CHANGEPSWD" => "Modifier votre mot de passe",
			// Datas related
			"MDATAADMIN" => "Menu d'administration des données",
			"MDATA" => "Menu de données",
			"DATAS" => "Données",
			"RTDATAS" => "Données en temps réel",
			"SDATAS" => "Données stockées",
			"DATALIST" => "Editer ou Supprimer des données",
			// Netbackup Team related
			"M_NETBACKUP" => "Netbackup",
			// -- Master servers related
			"M_MSERVER" => "Master servers",
			"MSERVERLIST" => "Editer ou Supprimer des master servers",
			// BT Team related
			"M_BT" => "BT",
			// Citrix Team related
			"M_CITRIX" => "Citrix",
		// languages names
			"LFR" => "Français",
			"LEN" => "Anglais",
		// country  names
			"FR" => "France",
			"IN" => "Inde",
		// Error messages
			"E404" => "Page non trouvée",
			"E404_TEXT" => "Merci de bien vouloir contacter l'administrateur si l'erreur persiste",
			"E403" => "Page non autorisée",
			"E403_TEXT" => "Vous n'avez pas le droit de voir cette page",
			"ENODATE" => "Pas de date définie",
			"ENODATE_TEXT" => "Ce script a besoin d'une date pour se lancer.<br>
			Merci de bien vouloir contacter l'administrateur pour avoir un lien de lancement de ce script correct.",

			"EUSEREXISTS" => "L'utilisateur existe déjà",
		// Form Messages
			// -- Data error
			"MISSING_TO" => "Le champs \"To\" est vide",
			"MISSING_NB_JOBS " => "Le champs \"nb_jobs\" est vide",
			"MISSING_MONTH" => "Le champs \"mois\" est vide",
			"MISSING_DATE" => "Le champs \"date\" est vide",
			"MISSING_MASTER_SERVER" => "Le champs \"master_server\" est vide",
		// Valid
			"FORMOK" => "Le formulaire est valide",
		// Page contents
		// -- Global
			"YES" => "Oui",
			"NO" => "Non",
			"ID" => "Identifiant",
			"ACTIVE" => "Actif",
			"DELETED" => "Supprimé",
			"ADMIN" => "Administrateur",
			"USER" => "Utilisateur",
			"DEV" => "Développeur",
			"SELECTDATE" => "Veuillez choisir une date",
			"DATEFORMAT" => "jj/mm/aaaa",
			"FROM" => "du",
			"TO" => "au",
			"COMMENT" => "Commentaire",
			"START" => "Début",
			"END" => "Fin",
			"EDS" => "Date de début estimée",
			"EDE" => "Date de fin estimée",
			"REALDS" => "Date de début réelle",
			"REALDE" => "Date de fin réelle",
			"CANCELLED" => "Annulé",
			"DNOFIELDS" => "Veuillez remplir tous les champs du formulaire.",
			"MKINFOTITLE" => "Informations sur la mise en forme de la documentation",
			"MKINFO" => "Mettre des # en début de ligne pour les titres<br>
				Utiliser * ou - pour faire des listes à points<br>
				Utiliser des nombres pour faire des listes numériques<br>
				Utiliser [mot](url) pour les liens, pour les images, ajouter un ! au début ![img](url)<br>
				Utiliser * ou _ pour mettre en italique<br>
				Utiliser ** ou __ pour mettre en gras<br>
				Entourer le code en ligne avec des `<br>
				Indenter les blocs de code avec 4 espaces<br>
				Utiliser > en début de ligne pour les citations",
			"MAXSIZE" => "Taille maximum du fichier",
			"AUTHFORMAT" => "Formats autorisés",
			"WELCOME" => "Bienvenu",
			"PLEASE_LOGIN" => "Merci de bien vouloir vous connecter",
		// -- User related
			"LOGIN" => "Login",
			"FNAME" => "Prénom",
			"LNAME" => "Nom",
			"EMAIL" => "Courriel",
			"PSWD" => "Mot de passe",
			"OLDPSWD" => "Ancien mot de passe",
			"NEWPSWD" => "Nouveau mot de passe",
			"NEWPSWDVERIF" => "Retapez votre nouveau mot de passe",
			"DOLDPSWD" => "L'ancien mot de passe ne correspond pas.",
			"DNEWPSWD" => "Les deux nouveaux mot de passe saisis ne sont pas identiques.",
			"SPSWDMODIFY" => "Le mot de passe a bien été modifié",
			"PSWDRULES" => "Le mot de passe dtoi faire au moins 5 caractères",
			"NOUSERFOUND" => "Pas d'utilisateurs trouvés",
			"SUSERCREATE" => "L'utilisateur a bien été créé",
			"SUSERMODIFY" => "L'utilisateur a bien été modifié",
			"SUSERDELETE" => "L'utilisateur a bien été supprimé",
			"DNOACCOUNT" => "Connexion impossible : Vous avez saisi des mauvaises information ou vous n'avez pas de compte. <br>Si le problème persiste, Veuillez contacter l'administrateur.",
			"DNOACTIVE" => "Connexion impossible : Votre compte n'est pas actif. Veuillez contacter l'administrateur.",
			"DUSERDELETED" => "Connexion impossible : Votre compte a été supprimé. Veuillez contacter l'administrateur.",
		// -- Form 
			"FORMINCOMPLETE" => "Formulaire incomplet",
			"MISSING_FIRSTNAME" => "Le champ Prénom est vide",
			"MISSING_LASTNAME" => "Le champ Nom est vide",
			"MISSING_EMAIL" => "Le champ Email est vide",
			"MISSING_LOGIN" => "Le champ Login est vide",
			"MISSING_PASSWORD" => "Le champ Mot de passe est vide",
		// -- Team related
			"TEAMS" => "Equipes",
			"NOTEAMS" => "Ne fait partit d'aucune équipe",
		// -- Graph related
			"GRAPH" => "Graphique",
			"GRAPHS" => "Graphiques",
			"ANALYSEGRAPHS" => "Analyses graphiques",
		// -- Server related
			"MSERVER" => "Master server",
			"NOMSERVERFOUND" => "Pas de master server trouvés",
			"EMSERVEREXISTS" => "Le master server existe déjà",
			"SMSERVERCREATE" => "Le master server a bien été créé",
			"SMSERVERMODIFY" => "Le master server a bien été modifié",
			"SMSERVERDELETE" => "Le master server a bien été supprimé",
		// -- Data related
			"NODATAFOUND" => "Pas de données trouvées",
			"EDATAEXISTS" => "Cette donnée existe déjà",
			"SDATACREATED" => "Donnée crée",
			"SDATAMODIFY" => "Donnée modifiée",
			"SDATADELETE" => "Donnée supprimée",
		// -- Other details
			"README" => "readme pour dev",
			"NAME" => "Nom",
			"PROFIT" => "Avantage",
			"PROGRESSION" => "Avancement",
			"PPROGRESSION" => "Avancement projet",
			"NEEDED" => "Champ obligatoire",
			"ISSU" => "Ce rôle a toutes les autorisations possibles. C'est un \"super user\".",
		); 
	}
}