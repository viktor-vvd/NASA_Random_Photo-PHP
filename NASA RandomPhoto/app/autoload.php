<?php

// autoloader for the controllers classes
spl_autoload_register(function($className) {
    $controllerPath = CONTROLLERS_DIR . "/{$className}.php";
    if (is_readable($controllerPath)) {
        include_once $controllerPath;
    }
});

// autoloader for the models classes
spl_autoload_register(function($className) {
    $modelPath = MODELS_DIR . "/{$className}.php";
    if (is_readable($modelPath)) {
        include_once $modelPath;
    }
});

// autoloader for the all another classes
spl_autoload_register(function($className) {
    $coreClassPath = CLASSES_DIR . "/{$className}.php";
    if (is_readable($coreClassPath)) {
        include_once $coreClassPath;
    }
});