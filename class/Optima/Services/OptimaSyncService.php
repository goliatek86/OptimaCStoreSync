<?php

namespace Optima\Services;

use Optima\Adapters\ClientAdapter;
use Optima\Adapters\InvoiceAdapter;
use Optima\Enums\OptimaEnums;
use Optima\Extensions\OptimaClient;
use Optima\Extensions\OptimaInvoice;
use Optima\Interfaces\OptimaAdapterInterface;
use Optima\Interfaces\OptimaRepositoryInterface;
use Optima\Repositories\ClientRepository;
use Optima\Repositories\InvoicesRepository;

/**
 *
 */
class OptimaSyncService {
    
    public function __construct() {
        $this->checkMigrations();
    }
    
    public function syncClients() : void
    {
        $this->syncObjects( new ClientAdapter(), new ClientRepository(), OptimaClient::class );
    }
    public function syncInvoices() : void
    {
        $this->syncObjects( new InvoiceAdapter(), new InvoicesRepository(), OptimaInvoice::class );
    }
    
    public  function syncObjects(OptimaAdapterInterface $adapter, OptimaRepositoryInterface $repository, string $objectClass): void
    {
        try {
            foreach($repository->getAll() as $invoice) {
                $invoice_obj = new $objectClass($invoice->{$repository->getRelationIdKey()});
                if(!$invoice_obj->exists() || $repository->isUpdate()) {
                    $adapter::syncObjects($invoice, $invoice_obj);
                }
            }
        } catch (\Exception $exception) {
            \Debug::dump($exception->getMessage());
        }
    }
    
    private function checkMigrations(): void
    {
        global $sql;
        
        if(!$sql->query('SHOW COLUMNS FROM `klienci` LIKE \'' . OptimaEnums::CLIENT_TABLE_ID_KEY . '\'')) {
            $migration_path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'migration.sql';
            $migrations = file_get_contents($migration_path);
            $queries = explode(';', $migrations);
            foreach($queries as $query) {
                $sql->query($query);
            }
        }
    }
}