<?php

namespace YWatchman\ProxmoxMGW\Result;

use Illuminate\Contracts\Support\Arrayable;

class Network implements Arrayable
{
    protected int $size;

    protected string $comment;

    protected string $prefix;

    protected string $cidr;

    public function __construct(int $size, string $comment, string $prefix, string $cidr)
    {
        $this->size = $size;
        $this->comment = $comment;
        $this->prefix = $prefix;
        $this->cidr = $cidr;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    public function getCidr(): string
    {
        return $this->cidr;
    }

    public function toArray(): array
    {
        return [
            'cidr' => $this->getCidr(),
            'comment' => $this->getComment(),
            'prefix' => $this->getPrefix(),
            'prefix_size' => $this->getSize(),
        ];
    }
}
