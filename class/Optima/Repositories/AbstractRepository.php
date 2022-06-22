<?php

namespace Optima\Repositories;

use Optima\Interfaces\OptimaRepositoryInterface;
use Optima\OptimaConnector;

/**
 *
 */
abstract class AbstractRepository implements OptimaRepositoryInterface {
    
    protected $connector;
    
    public function __construct() {
        $this->connector = OptimaConnector::getInstance();
    }
    
    /**
     * @throws \Exception
     */
    public function getTableName(): string
    {
        if (!isset($this->tableName)) {
            throw new \RuntimeException(\get_class($this) . ' must have a $tablename');
        }
        
        return $this->tableName;
    }
    
    /**
     * @return string
     */
    public function getRelationIdKey(): string
    {
        return $this->relationIdKey;
    }
    
    
}