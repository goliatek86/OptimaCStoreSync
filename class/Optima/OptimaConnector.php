<?php

namespace Optima;

use SingletonTrait;

/**
 *
 */
class OptimaConnector
{
    
    use SingletonTrait;
    
    private $config;
    private $connection;
    private $statement;
    
    public function loadConfig(): void
    {
        $this->config = OptimaConfigProvider::loadConfig();
    }
    
    public function connect(): void
    {
        $this->connection = sqlsrv_connect($this->config->host, [
            'Database' => $this->config->database,
            'UID' => $this->config->uid,
            'PWD' => $this->config->pwd,
        ]);
    }
    
    public function query(string $query): void
    {
        $this->statement = sqlsrv_query($this->connection, $query, [], [
            'Scrollable' => SQLSRV_CURSOR_STATIC,
        ]);
        if($this->statement === false) {
            \Debug::dump(print_r(sqlsrv_errors(), true));
        }
    }
    
    public function getResults(string $class = null): \Generator
    {
        $result = [];
        $cloned_statement = $this->statement;
        for ($iteration = 0; $iteration<=sqlsrv_num_rows($cloned_statement); $iteration++) {
            $record = sqlsrv_fetch_object($cloned_statement, $class);
            if(!empty($record)) {
                yield $record;
            }
        }
    }
    
    public function getFirst(string $class = null) : array
    {
        //Simple Ommit action to prevent first element
        $query_result = iterator_to_array($this->getResults($class));
        
        return array_shift($query_result);
    }
    
    /**
     * protected construct
     **/
    protected function __construct()
    {
        $this->loadConfig();
        $this->connect();
    }
}