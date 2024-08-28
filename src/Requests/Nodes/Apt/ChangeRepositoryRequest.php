<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes\Apt;

class ChangeRepositoryRequest
{
    /**
     * @param string $node The cluster node name.
     * @param int $index Index within the file (starting from 0).
     * @param string $path Path to the containing file.
     * @param string|null $digest Digest to detect modifications.
     * @param bool|null $enabled Whether the repository should be enabled or not.
     */
    public function __construct(
        public string $node,
        public int $index,
        public string $path,
        public ?string $digest = null,
        public ?bool $enabled = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'index' => $this->index,
            'path' => $this->path,
            'digest' => $this->digest,
            'enabled' => $this->enabled,
        ]);
    }
}
