<?php


use Optima\Services\OptimaSyncService;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'init_boot.php';

$sync_service = new OptimaSyncService();

$sync_service->syncClients();
$sync_service->syncInvoices();