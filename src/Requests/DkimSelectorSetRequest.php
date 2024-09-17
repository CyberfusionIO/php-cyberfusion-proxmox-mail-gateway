<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class DkimSelectorSetRequest
{
    /**
     * @param int $keysize Number of bits for the RSA-Key
     * @param string $selector DKIM Selector
     * @param bool|null $force Overwrite existing key
     */
    public function __construct(
        public int $keysize,
        public string $selector,
        public ?bool $force = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'keysize' => $this->keysize,
            'selector' => $this->selector,
            'force' => $this->force,
        ], fn($value) => !is_null($value));
    }
}
