<?php

namespace Optima\Interfaces;

/**
 *
 */
interface OptimaRepositoryInterface
{
    public function get(int $id): OptimaEntityInterface;
    public function getAll(): \Generator;
    public function isUpdate(): bool;
}