<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class PostfixQshapeRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string|null $queue Postfix queue name.
     */
    public function __construct(
        public string $node,
        public ?string $queue = 'deferred',
    ) {
    }

    /**
     * Convert the request parameters to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'queue' => $this->queue,
        ], fn($value) => $value !== null);
    }
}
