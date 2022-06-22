<?php

namespace Optima\Builders;

/**
 *
 */
class QueryBuilder {
    /**
     * @var string
     */
    private $tableName;
    /**
     * @var string
     */
    private $select = '*';
    
    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }
    
    /**
     * @return string
     */
    public function getSelect(): string
    {
        return $this->select;
    }
    
    /**
     * @return array
     */
    public function getWhereArray(): ?array
    {
        return $this->whereArray;
    }
    /**
     * @var array
     */
    private $whereArray;
    
    /**
     * @param string $tableName
     */
    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;
    }
    
    /**
     * @param string|array      $field
     * @param string      $statement
     * @param string|null $value
     *
     * @return QueryBuilder
     */
    public function where($field, string $statement = '=', string $value = null) : QueryBuilder
    {
        if(\is_array($field)) {
            foreach($field as $key => $array_value) {
                $this->where($key, $array_value);
            }
        }
        if($value === null) {
            $value = $statement;
            $statement = '=';
        }
        
        $this->whereArray[] = '`' . $field . '` ' . $statement . ' \'' . $value . '\'';
        
        return $this;
    }
    
    public function select(string $select = '*') : QueryBuilder
    {
        $this->select = $select;
    
        return $this;
    }
    
    public function first() : QueryBuilder
    {
        $this->select = ' TOP 1 ' . $this->select ;
    
        return $this;
    }
    
    public function getSql(): string
    {
        $query = 'SELECT ' . $this->getSelect() . ' FROM CDN.' . $this->getTableName();
        if(($where_array = $this->getWhereArray()) !== null) {
            $query .= ' WHERE ' . implode(' AND ' , $where_array);
        }

        return trim($query);
    }
    
}