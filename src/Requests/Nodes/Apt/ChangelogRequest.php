<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes\Apt;

class ChangelogRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $name Package name.
     * @param string|null $version Package version.
     */
    public function __construct(
        public string $node,
        public string $name,
        public ?string $version = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'version' => $this->version,
        ]);
    }
}
