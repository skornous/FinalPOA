<?php
	use \Helpers\Router\Router;
	use \Helpers\Lang;

	define('APPNAME', "Game server");
	define('ROOT', dirname(__FILE__));

	// Load Autoloader to use with namespaces
	if (!defined('SITE_ROOT')) {
		define('SITE_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
		require(SITE_ROOT . 'Autoloader.php');
	}

	define('BASE_URL', "/FinalPOA");

	// Sessions last max 30 min
	if (isset($_SESSION) && isset($_SESSION["LAST_ACTIVITY"])) {
		if (time() - $_SESSION["LAST_ACTIVITY"] > 1800) { // session lasted more than 30 minutes
			session_unset(); // unset $_SESSION variable for the run-time 
			session_destroy(); // destroy the session datas
		}
	}

	session_start();
	$_SESSION["LAST_ACTIVITY"] = time();

	if (!isset($_SESSION["lang"])) {
		$_SESSION["lang"] = new Lang();
	}
	if (isset($_GET["lang"]) && $_SESSION["lang"]::supportedLanguage($_GET["lang"])) {
		$_SESSION["lang"]->locale = $_GET["lang"];
	}

	$router = new Router($_GET["url"]);

	// --- Need to be logged in pages ---
	if (isset($_SESSION["User"]) && !empty($_SESSION["User"])) { // user is logged in

		// Server's
		// -- GET methods
		$router->get('/servers/modify/:id', "Server#modifyForm")->with("id", "[0-9]+");
		$router->get('/servers/delete/:id', "Server#delete")->with("id", "[0-9]+");
		$router->get('/servers/create', "Server#createForm");
		$router->get('/servers/:id', "Server#show")->with("id", "[0-9]+");
		$router->get('/servers', "Server#showAll");
		// -- POST methods
		$router->post('/servers/:id', "Server#modify")->with("id", "[0-9]+");
		$router->post('/servers', "Server#create");

		//Game's
		// -- GET methods
//		$router->get('/game/:id', "Index#game")->with("id", "[0-9]+");
		// -- POST methods

		// Script's
		// -- GET methods
		// $router->post('/scripts/show_datas', "Server#create");

		$router->get('/disconnect', "Index#logout");

	} else { // no user logged in

		$router->get('/connect', "Index#login");
		$router->post('/connect', "Index#register");

	}


	// --- No need to be logged in pages ---

	// Games
	$router->get('/game/:id', "Index#game")->with("id", "[0-9]+");

	// Errors
	$router->get('/404', "Error#_404");
	$router->get('/403', "Error#_403");
	$router->get('/:page', "Error#_404")->with("page", "[\w]+");;
	// Home 
	$router->get('/', "Index#home");

	$router->run();