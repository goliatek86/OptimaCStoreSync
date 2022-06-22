<?php

namespace Optima\Interfaces;

use Optima\Interfaces\OptimaEntityInterface;

/**
 *
 */
interface OptimaAdapterInterface {
    public static function syncObjects(OptimaEntityInterface $entity, \GenericObject $object): void;
    public static function getMappedKeys(): array;
}