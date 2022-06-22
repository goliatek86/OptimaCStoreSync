<?php

namespace Optima\Extensions;

use Optima\Enums\OptimaEnums;

/**
 *
 */
class OptimaClient extends \Client {
    /**
     * @param int $id
     */
    public function __construct(int $id = 0)
    {
        $this->setIdentityField(OptimaEnums::CLIENT_TABLE_ID_KEY);
        parent::__construct($id);
    }
}