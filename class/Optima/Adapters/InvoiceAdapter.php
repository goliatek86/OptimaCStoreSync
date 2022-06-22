<?php

namespace Optima\Adapters;

use Optima\Entities\AbstractEntity;
use Optima\Enums\OptimaEnums;
use Optima\Extensions\OptimaClient;
use Optima\Interfaces\OptimaClientEntityInterface;
use Optima\Interfaces\OptimaEntityInterface;

/**
 *
 */
class InvoiceAdapter extends AbstractAdapter {
    public static function getMappedKeys(): array
    {
        return parent::getMappedKeys() + [
                'optima_invoice_id' => 'BZd_BZdID',
                'optima_client_id' => 'BZd_PodmiotID',
                'number' => 'BZd_NumerPelny',
                'nip' => 'BZd_SplitPayNipE',
                'date' => 'BZd_DataDok',
                'payment_term' => 'BZd_Termin',
                'sum' => 'BZd_Kwota',
                'currency' => 'BZd_Walut',
                'payed' => 'BZd_Rozliczono',
            ];
    }
}