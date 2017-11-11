<?php
//header('HTTP/1.0 404 Not Found');

// constante=>define

define("ROOT",str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));	// [ avec le var et le www ]
define("WEBROOT",str_replace('index.php','',$_SERVER['SCRIPT_NAME']));	// [ sans le var et le www ] on prend dans $server le chemin vers index, puis on retire 'index' pour juste avoir le path/chemin
define("KERNEL",ROOT."kernel");
define("MODEL",KERNEL."/model/"); 										// On prend le chemin de root et on ajoute le chemin pour aller au kernel puis model pour les classes
define("CSS",WEBROOT."/css/");
define("JS",WEBROOT."js/");
define("CONTROLLER",KERNEL."/controller/");
define("VIEW",KERNEL."/view/");
define("IMG",WEBROOT."/img");


if(!empty($_GET['p'])) {				// on regarde si on a un lien avec un controller ou non du type forum/ controllerName/....
	$params = explode ('/',$_GET['p']);
	$controller = $params[0];
	} else {
		$controller = "accueil";
		$paramas = array();
	}

	if(!empty($params[1])) {			// on regarde aussi si il y a une action genre forum/controller/action
		$action = $params[1];
	} else {
		$action = 'index';
	}
	$controller = 'controller'.$controller;
    $path = CONTROLLER.$controller.".php";

	if(file_exists($path)) {
		require_once($path);  // on appele le controller concerné, on a le chemin défini en constante, on le termine avec la variable prise dans le GET

		$controller = new $controller ();
		if(method_exists($controller,$action)) {

		    if(isset($params)) {
                unset($params[0]);
                unset($params[1]);
              print_r($controller);
                call_user_func_array(array($controller, $action), $params); // (callback =) topic::read() || La fonction va appeler elle même la méthode du controller, en ajoutant les paramètres, soit ils seront là, soit le paramètre sera juste un '()'
            } else {

		        $params[]="";
                call_user_func_array(array($controller, $action), $params);
             }
		    } else {
				//header('location : /Accueil.php');
		}
	} else {
        $params[]="";
        $controller = "controlleraccueil";
        $path = CONTROLLER.$controller.".php";
        $controller = new $controller ();
        echo $path;
        call_user_func_array(array($controller, "index"), $params);
	}





/*



░░░░░▄▄▄▄▀▀▀▀▀▀▀▀▄▄▄▄▄▄░░░░░░░
░░░░░█░░░░▒▒▒▒▒▒▒▒▒▒▒▒░░▀▀▄░░░░
░░░░█░░░▒▒▒▒▒▒░░░░░░░░▒▒▒░░█░░░
░░░█░░░░░░▄██▀▄▄░░░░░▄▄▄░░░░█░░
░▄▀▒▄▄▄▒░█▀▀▀▀▄▄█░░░██▄▄█░░░░█░
█░▒█▒▄░▀▄▄▄▀░░░░░░░░█░░░▒▒▒▒▒░█
█░▒█░█▀▄▄░░░░░█▀░░░░▀▄░░▄▀▀▀▄▒█
░█░▀▄░█▄░█▀▄▄░▀░▀▀░▄▄▀░░░░█░░█░
░░█░░░▀▄▀█▄▄░█▀▀▀▄▄▄▄▀▀█▀██░█░░
░░░█░░░░██░░▀█▄▄▄█▄▄█▄█ █ ░█░░░
░░░░█░░░░▀▀▄░█░░░█░█▀██ █ █░█░░
░░░░░▀▄░░░░░▀▀▄▄▄█▄█▄█▄█▄▀░░█░░
░░░░░░░▀▄▄░▒▒▒▒░░░░░░░░░░▒░░░█░
░░░░░░░░░░▀▀▄▄░▒▒▒▒▒▒▒▒▒▒░░░░█░
░░░░░░░░░░░░░░▀▄▄▄▄▄░░░░░░░░█░░



█▀▀ㅤ█  █ㅤ █ㅤ █ㅤ ▀▀█▀▀ㅤㅤ█ㅤ █ㅤ █▀▀▄ 　
▀▀█ㅤ█▀▀█ㅤ █ㅤ █ㅤ   █ㅤㅤㅤ █ █ㅤ █ ㅤ █ 　
▀▀▀ㅤ▀ ㅤ▀ㅤ ▀▀▀▀ㅤㅤ ▀ㅤ ㅤ ▀▀▀▀ㅤ █▀▀ 　
ㅤㅤㅤㅤㅤㅤ▄▀▀▄ㅤ█▀▀▄ㅤ █▀▀▄
ㅤㅤㅤㅤㅤㅤ█▄▄█ㅤ█ ㅤ █ㅤ█ ㅤ █
ㅤㅤㅤㅤㅤㅤ█ㅤ █ㅤ█ ㅤ █ㅤ█▄▄▀

─────███────██
──────████───███
────────████──███
─────────████─█████
████████──█████████
████████████████████
████████████████████
█████████████████████
█████████████████████
█████████████████████
██─────██████████████
███────────█████████
█──█───────────████
█──────────────██
██──────────────█────────▄███████▄
██───███▄▄──▄▄███──────▄██$█████$██▄
██──█▀───▀███────█───▄██$█████████$██▄
██──█───█──██───█─█──█$█████████████$█
██──█──────██─────█──█████████████████
██──██────██▀█───█─────██████████████
─█───██████──▀████───────███████████
──────────────────█───────█████████
─────────────▀▀████──────███████████
────────────────█▀──────██───████▀─▀█
────────────────▀█──────█─────▀█▀───█
──▄▄▄▄▄▄▄────────██────█───████▀───██
─█████████████────▀█──█───███▀──▄▄██
─█▀██▀██▀████▀█████▀──█───██████▀─▀█
─█────────█▄─────────██───████▀───██
─██▄████▄──██────────██───██──▄▄▄██
──██▄▄▄▄▄██▀─────────██──█████▀───█
─────────███────────███████▄────███
────────███████─────█████████████
───────▄██████████████████████
████████─██████████████████
─────────██████████████
────────███████████
───────█████
──────████
─────████

ㅤ ㅤ ㅤ ㅤ ㅤ ▀▀█▀▀ㅤ█▀▀█ㅤ█ㅤ▄█ㅤ█▀▀
ㅤㅤ ㅤㅤ ㅤ ㅤㅤ█ ㅤㅤ█▄▄█ㅤ█▀▀▄ ㅤ█▀▀
ㅤ ㅤ ㅤ ㅤ ㅤ ㅤ ▀ㅤ ㅤ▀ㅤ ▀ㅤ▀ㅤㅤ▀ㅤ▀▀▀

█▀▄▀█ㅤ█ ㅤ █ㅤ ㅤ█▀▄▀█ ▄▀▀▄ █▀▀▄ █▀▀ █ ㅤ █ㅤ█
█─▀─█ㅤ█▄▄█ㅤㅤ █─▀─█ █ ㅤ █ █ ㅤ █ █▀▀ █▄▄█ㅤ█
█ㅤㅤ █ㅤ▄▄▄█ㅤ ㅤ█ㅤㅤ█ ─▀▀ ─ ▀ ㅤ ▀ ▀▀▀ ▄▄▄█ㅤ▄*/


?>
