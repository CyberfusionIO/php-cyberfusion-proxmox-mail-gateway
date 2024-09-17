<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes\Apt;

class AddRepositoryRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $handle Handle that identifies a repository.
     * @param string|null $digest Digest to detect modifications.
     */
    public function __construct(
        public string $node,
        public string $handle,
        public ?string $digest = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'handle' => $this->handle,
            'digest' => $this->digest,
        ]);
    }
}
