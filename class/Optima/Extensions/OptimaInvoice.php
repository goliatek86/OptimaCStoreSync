<?php

namespace Optima\Extensions;

/**
 *
 */
class OptimaInvoice extends \GenericObject {
    
    private $tablename = 'optima_invoices';
    
    public function validate(): bool
    {
        return true;
    }
}