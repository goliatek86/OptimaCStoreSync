<?php

namespace Optima\Repositories;

use Optima\Builders\QueryBuilder;
use Optima\Entities\InvoiceEntity;
use Optima\Interfaces\OptimaEntityInterface;

/**
 *
 */
class InvoicesRepository extends AbstractRepository {
    
    protected $entityClass = InvoiceEntity::class;
    protected $tableName = 'BnkZdarzenia';
    protected $relationIdKey = 'BZd_BZdID';
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
        $query->where($this->getWhereArguments());
        $this->connector->query($query->getSql());
        
        foreach($this->connector->getResults($this->entityClass) as $object) {
            yield $object;
        }
    }
    
    private function getWhereArguments(): array
    {
        return [
            'BZd_DokumentTyp' => 2
        ];
    }
    
    public function isUpdate(): bool
    {
        return true;
    }
}