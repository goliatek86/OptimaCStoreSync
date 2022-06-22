<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'init_boot.php';

if(strpos($argv[1], ':') !== false) {
    $file_part = array_shift($argv);
    $class_part = array_shift($argv);
    $class_definition = (array) explode(':', $class_part);
    [$class_name, $method_name] = $class_definition;
    
    try {
        $class_name = 'Optima\\' . str_replace('/', '\\', $class_name);
        \Core::auto_load($class_name);
        $class = new $class_name();
        if(method_exists($class, $method_name)) {
            $class->$method_name(...$argv);
        } else {
            echo "Method not exists\n";
        }
    } catch (\Throwable $exception) {
        echo $exception->getMessage();
    }

}