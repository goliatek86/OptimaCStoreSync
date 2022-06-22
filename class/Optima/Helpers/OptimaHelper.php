<?php

namespace Optima\Helpers;

/**
 *
 */
class OptimaHelper
{
    public static function getCountryIdFromIso(string $iso_code = 'PL'): int
    {
        global /** @var \Sql $sql */$sql;
    
        $iso_code = static::correctIso($iso_code);
        
        try {
            $sql->select('countries')->where('iso_code', '=', $iso_code)->execute();
        } catch (\Exception $exception) {
            \Debug::log($exception->getMessage());
        }
        
        return $sql->getField(0, 'id');
    }
    
    public static function correctIso(string $iso_code): string
    {
        //TODO Create Mapping class
        $correct_iso = [
            'UAE' => 'AE',
            'USA' => 'US',
            'EA' => 'AE',
            'EL' => 'GR',
            'Kuwejt' => 'KW',
            'UK' => 'GB',
        ];
        
        return $correct_iso[$iso_code] ?? $iso_code;
    }
    
}