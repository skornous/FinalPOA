<?php

	namespace Helpers\i18n;

	class fr extends Translations {

		public function __construct() {

			parent::__construct();
		}

		protected function loadTranslation() {

			$this->_translations = [
				"APPNAME"      => "Unit Costing",
				// Actions
				"ADD"          => "Ajouter",
				"CREATE"       => "Nouveau",
				"MODIFY"       => "Modifier",
				"DELETE"       => "Supprimer",
				"SAVE"         => "Enregistrer",
				"SEARCH"       => "Rechercher",
				"REMOVE"       => "Retirer",
				"SELECT"       => "Choisissez une valeur",
				"OBJECT"       => "Objet",
				"SHOW"         => "Voir",
				"MORE"         => "Plus",
				// Menu content
				"HOME"         => "Accueil",
				"LANG"         => "Langue",
				"CONNECT"      => "Se connecter",
				"CONNEXION"    => "Connexion",
				"DECONNEXION"  => "Deconnexion",
				"MADMIN"       => "Menu d'administration",
				// User related
				"MUSERS"       => "Utilisateurs",
				"USERLIST"     => "Liste des utilisateurs",
				"CHANGEPSWD"   => "Modifier votre mot de passe",
				// languages names
				"LFR"          => "Français",
				"LEN"          => "Anglais",
				// country  names
				"FR"           => "France",
				// Error messages
				"E404"         => "Page non trouvée",
				"E404_TEXT"    => "Merci de bien vouloir contacter l'administrateur si l'erreur persiste",
				"E403"         => "Page non autorisée",
				"E403_TEXT"    => "Vous n'avez pas le droit de voir cette page",
				"ENODATE"      => "Pas de date définie",
				"ENODATE_TEXT" => "Ce script a besoin d'une date pour se lancer.<br>
			Merci de bien vouloir contacter l'administrateur pour avoir un lien de lancement de ce script correct.",

				"EUSEREXISTS"           => "L'utilisateur existe déjà",
				// Form Messages
				// Valid
				"FORMOK"                => "Le formulaire est valide",
				// Page contents
				// -- Global
				"YES"                   => "Oui",
				"NO"                    => "Non",
				"ID"                    => "Identifiant",
				"ACTIVE"                => "Actif",
				"DELETED"               => "Supprimé",
				"ADMIN"                 => "Administrateur",
				"USER"                  => "Utilisateur",
				"DEV"                   => "Développeur",
				"SELECTDATE"            => "Veuillez choisir une date",
				"DATEFORMAT"            => "jj/mm/aaaa",
				"FROM"                  => "du",
				"TO"                    => "au",
				"COMMENT"               => "Commentaire",
				"START"                 => "Début",
				"END"                   => "Fin",
				"DNOFIELDS"             => "Veuillez remplir tous les champs du formulaire.",
				"WELCOME"               => "Bienvenu",
				// -- User related
				"LOGIN"                 => "Login",
				"FNAME"                 => "Prénom",
				"LNAME"                 => "Nom",
				"EMAIL"                 => "Courriel",
				"PSWD"                  => "Mot de passe",
				"OLDPSWD"               => "Ancien mot de passe",
				"NEWPSWD"               => "Nouveau mot de passe",
				"NEWPSWDVERIF"          => "Retapez votre nouveau mot de passe",
				"DOLDPSWD"              => "L'ancien mot de passe ne correspond pas.",
				"DNEWPSWD"              => "Les deux nouveaux mot de passe saisis ne sont pas identiques.",
				"SPSWDMODIFY"           => "Le mot de passe a bien été modifié",
				"PSWDRULES"             => "Le mot de passe dtoi faire au moins 5 caractères",
				"NOUSERFOUND"           => "Pas d'utilisateurs trouvés",
				"SUSERCREATE"           => "L'utilisateur a bien été créé",
				"SUSERMODIFY"           => "L'utilisateur a bien été modifié",
				"SUSERDELETE"           => "L'utilisateur a bien été supprimé",
				"DNOACCOUNT"            => "Connexion impossible : Vous avez saisi des mauvaises information ou vous n'avez pas de compte. <br>Si le problème persiste, Veuillez contacter l'administrateur.",
				"DNOACTIVE"             => "Connexion impossible : Votre compte n'est pas actif. Veuillez contacter l'administrateur.",
				"DUSERDELETED"          => "Connexion impossible : Votre compte a été supprimé. Veuillez contacter l'administrateur.",
				// -- Form
				"FORMINCOMPLETE"        => "Formulaire incomplet",
				"MISSING_FIRSTNAME"     => "Le champ Prénom est vide",
				"MISSING_LASTNAME"      => "Le champ Nom est vide",
				"MISSING_EMAIL"         => "Le champ Email est vide",
				"MISSING_LOGIN"         => "Le champ Login est vide",
				"MISSING_PASSWORD"      => "Le champ Mot de passe est vide",
			];
		}
	}