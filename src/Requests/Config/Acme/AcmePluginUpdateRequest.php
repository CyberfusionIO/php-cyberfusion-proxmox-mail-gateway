<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Acme;

class AcmePluginUpdateRequest
{
    /**
     * @param string $id ACME Plugin ID name
     * @param string|null $api API plugin name
     * @param string|null $data DNS plugin data. (base64 encoded)
     * @param string|null $delete A list of settings you want to delete.
     * @param string|null $digest Prevent changes if current configuration file has a different digest. This can be used to prevent concurrent modifications.
     * @param bool|null $disable Flag to disable the config.
     * @param string|null $nodes List of cluster node names.
     * @param int|null $validationDelay Extra delay in seconds to wait before requesting validation. Allows to cope with a long TTL of DNS records.
     */
    public function __construct(
        public string $id,
        public ?string $api = null,
        public ?string $data = null,
        public ?string $delete = null,
        public ?string $digest = null,
        public ?bool $disable = null,
        public ?string $nodes = null,
        public ?int $validationDelay = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'api' => $this->api,
            'data' => $this->data,
            'delete' => $this->delete,
            'digest' => $this->digest,
            'disable' => $this->disable,
            'nodes' => $this->nodes,
            'validation-delay' => $this->validationDelay,
        ], fn($value) => !is_null($value));
    }
}
