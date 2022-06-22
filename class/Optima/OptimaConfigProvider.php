<?php

namespace Optima;

use stdClass;

/**
 *
 */
class OptimaConfigProvider {
    
    public static function loadConfig(): stdClass
    {
        // Temporary Config
        include __DIR__ . DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR . 'config.php';
        
        $configClass = new stdClass();
        foreach($config as $key => $value) {
            $configClass->{strtolower($key)} = $value;
        }
        
        return $configClass;
    }
}
