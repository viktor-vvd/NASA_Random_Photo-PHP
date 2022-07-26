<?php

$action = 'show';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if (array_key_exists($action, $routes)) {
        list($controllerClass, $method) = explode('@', $routes[$action]);
        try {
            $controllerObj = new $controllerClass;
        } catch (\Exception $e) {
            die("Oops! Something went wrong: " . $e->getMessage());
        }   
        $controllerObj->$method();
} else {
    die("Unrecognized request!");
}
