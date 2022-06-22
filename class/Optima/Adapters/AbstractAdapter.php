<?php

namespace Optima\Adapters;

use Optima\Interfaces\OptimaAdapterInterface;
use Optima\Interfaces\OptimaEntityInterface;

/**
 *
 */
class AbstractAdapter implements OptimaAdapterInterface {
    
    public static function syncObjects(OptimaEntityInterface $entity, \GenericObject $object): void
    {
        foreach(static::getMappedKeys() as $attribute_to => $attribute_from) {
            if(\is_array($attribute_from)) {
                $attribute_string = '';
                foreach($attribute_from as $attribute) {
                    $attribute_string .= $entity->{$attribute};
                }
                $object->setField($attribute_to, $attribute_string);
            } else {
                $object->setField($attribute_to, $entity->{$attribute_from});
            }
            
        }
        $object->save();
    }
    
    public static function getMappedKeys(): array
    {
        return [];
    }
}