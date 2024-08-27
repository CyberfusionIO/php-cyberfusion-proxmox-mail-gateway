<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config;

class AcmePluginsAddRequest
{
    /**
     * @param string $id ACME Plugin ID name
     * @param string $type ACME challenge type.
     * @param string|null $api API plugin name
     * @param string|null $data DNS plugin data. (base64 encoded)
     * @param bool|null $disable Flag to disable the config.
     * @param string|null $nodes List of cluster node names.
     * @param int|null $validationDelay Extra delay in seconds to wait before requesting validation. Allows to cope with a long TTL of DNS records.
     */
    public function __construct(
        public string $id,
        public string $type,
        public ?string $api = null,
        public ?string $data = null,
        public ?bool $disable = null,
        public ?string $nodes = null,
        public ?int $validationDelay = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'type' => $this->type,
            'api' => $this->api,
            'data' => $this->data,
            'disable' => $this->disable,
            'nodes' => $this->nodes,
            'validation-delay' => $this->validationDelay,
        ], fn($value) => !is_null($value));
    }
}
