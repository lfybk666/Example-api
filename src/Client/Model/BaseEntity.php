<?php
declare(strict_types=1);

namespace Lfybk666\Api\Client\Model;

class BaseEntity
{
    protected int $id;

    public function getId(): int
    {
        return $this->id;
    }
}
