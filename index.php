<?php
// Generate constant ROOT which contain root's path of our projet (index.php in our case)
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

session_start();

// Calling main Models and Controller
require_once(ROOT . 'app/Models.php');
require_once(ROOT . 'app/Controller.php');
require_once(ROOT . 'app/Form.php');

// Split parameters and store them into $params array
$params = isset($_GET['p']) ? explode('/', $_GET['p']) : [""];

// If there is at least 1 parameter
if ($params[0] != "") {
    // Store first parameter in $controller by puting first letter in upper case (if it's not already the case)
    $controller = ucfirst($params[0]);

    // Store second parameter in $action if exist, else it takes value 'index'
    $action = isset($params[1]) ? $params[1] : 'index';

    // If controller exist
    if (file_exists(ROOT . 'controllers/' . $controller . '.php')) {
        // Calling controller that match with the parameter asked
        require_once(ROOT . 'controllers/' . $controller . '.php');

        // Instantiate the controller
        $controller = new $controller();

        // If method exist
        if (method_exists($controller, $action)) {
            unset($params[0]);
            unset($params[1]);
            call_user_func_array([$controller, $action], $params);
            // Calling the method
            // $controller->$action();
        }
        // If no method exist
        else {
            // Sending 404 response as error
            http_response_code(404);
            echo "La page demandée n'existe pas";
        }
    }
    // If no controller exist
    else {
        // Sending 404 response as error
        http_response_code(404);
        echo "La page demandée n'existe pas";
    }
}
// If there is no parameter in the URL
else {
    // We call the default controller (Main.php in our case)
    require_once(ROOT . 'controllers/Main.php');

    // Instantiate the controller
    $controller = new Main();

    // We call the default method (index in our case)
    $controller->index();
}
