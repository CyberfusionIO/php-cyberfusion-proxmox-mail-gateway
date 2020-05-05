<?php


namespace YWatchman\ProxmoxMGW\Result;


use Illuminate\Contracts\Support\Arrayable;

class Network implements Arrayable
{

    /** @var $size int */
    protected $size;

    /** @var $comment string */
    protected $comment;

    /** @var $prefix string */
    protected $prefix;

    /** @var $cidr string */
    protected $cidr;

    public function __construct(int $size, string $comment, string $prefix, string $cidr)
    {
        $this->size = $size;
        $this->comment = $comment;
        $this->prefix = $prefix;
        $this->cidr = $cidr;
    }

    /**
     * Get prefix size.
     *
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Get Proxmox comment.
     *
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * Get prefix.
     *
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * Get CIDR.
     *
     * @return string
     */
    public function getCidr(): string
    {
        return $this->cidr;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'cidr' => $this->getCidr(),
            'comment' => $this->getComment(),
            'prefix' => $this->getPrefix(),
            'prefix_size' => $this->getSize(),
        ];
    }
}
