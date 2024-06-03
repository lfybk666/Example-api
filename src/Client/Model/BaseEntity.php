<?php
declare(strict_types=1);

namespace Danil\Api\Client\Model;

class BaseEntity
{
    protected int $id;

    public function getId(): int
    {
        return $this->id;
    }
}
