<?php

namespace Optima\Repositories;

use Optima\Builders\QueryBuilder;
use Optima\Entities\ClientEntity;
use Optima\Interfaces\OptimaEntityInterface;

/**
 *
 */
class ClientRepository extends AbstractRepository {
    
    protected $entityClass = ClientEntity::class;
    protected $tableName = 'Kontrahenci';
    protected $relationIdKey = 'Knt_KntId';
    /**
     * @throws \Exception
     */
    public function get(int $id): OptimaEntityInterface
    {
        $query = new QueryBuilder($this->getTableName());
        $query->select('*')->where($this->getRelationIdKey(), $id)->first();

        $this->connector->query($query->getSql());
    
        return $this->connector->getFirst($this->entityClass);
    }
    
    /**
     * @return \Generator
     * @throws \Exception
     */
    public function getAll() : \Generator
    {
        $query = new QueryBuilder($this->getTableName());
        $query->select('*');
        $this->connector->query($query->getSql());
        
        foreach($this->connector->getResults($this->entityClass) as $object) {
            yield $object;
        }
    }
    
    public function isUpdate(): bool
    {
        return false;
    }
}