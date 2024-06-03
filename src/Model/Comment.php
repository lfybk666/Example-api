<?php
declare(strict_types=1);

namespace Danil\Api\Model;

use Danil\Api\Client\Model\BaseEntity;

class Comment extends BaseEntity
{
    private string $name;

    private string $text;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

}
