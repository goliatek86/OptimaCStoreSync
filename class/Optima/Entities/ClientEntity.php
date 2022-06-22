<?php

namespace Optima\Entities;

use Optima\Helpers\OptimaHelper;

/**
 *
 * @property string $Knt_KrajISO
 * @property void   $Knt_Email
 * @property void   $Knt_Kraj
 */
class ClientEntity extends AbstractEntity {
    
    public function morphCountry(): int
    {
        return OptimaHelper::getCountryIdFromIso(!empty($this->Knt_KrajISO) ? $this->Knt_KrajISO : 'PL');
    }
    
    public function morphPassword(): string
    {
        return md5($this->Knt_Email);
    }
    
    public function morphRejestrowany(): bool {
        return true;
    }
}