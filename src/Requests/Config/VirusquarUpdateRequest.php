<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config;

class VirusquarUpdateRequest
{
    /**
     * @param bool|null $allowhrefs Allow to view hyperlinks.
     * @param string|null $delete A list of settings you want to delete.
     * @param string|null $digest Prevent changes if current configuration file has a different digest. This can be used to prevent concurrent modifications.
     * @param int|null $lifetime Quarantine life time (days)
     * @param bool|null $viewimages Allow to view images.
     */
    public function __construct(
        public ?bool $allowhrefs = null,
        public ?string $delete = null,
        public ?string $digest = null,
        public ?int $lifetime = null,
        public ?bool $viewimages = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'allowhrefs' => $this->allowhrefs,
            'delete' => $this->delete,
            'digest' => $this->digest,
            'lifetime' => $this->lifetime,
            'viewimages' => $this->viewimages,
        ], fn($value) => !is_null($value));
    }
}
