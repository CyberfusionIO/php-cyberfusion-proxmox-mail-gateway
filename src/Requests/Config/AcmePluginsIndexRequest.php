<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config;

class AcmePluginsIndexRequest
{
    /**
     * @param string|null $type Only list ACME plugins of a specific type
     */
    public function __construct(
        public ?string $type = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
        ], fn($value) => !is_null($value));
    }
}
