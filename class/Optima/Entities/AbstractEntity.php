<?php

namespace Optima\Entities;

use Optima\Interfaces\OptimaEntityInterface;

/**
 *
 */
abstract class AbstractEntity implements OptimaEntityInterface
{
    /**
     * @param $field
     *
     * @return void
     */
    public function __get($field)
    {
        if (method_exists($this, 'morph' . ucfirst($field))) {
            return $this->{'morph' . ucfirst($field)}();
        }
    }
    
    /**
     * @param $field
     * @param $value
     *
     * @return void
     */
    public function __set($field, $value)
    {
        $this->{$field} = $value;
    }
    
    /**
     * @param $name
     *
     * @return void
     */
    public function __isset($name)
    {
        // TODO: Implement __isset() method.
    }
}