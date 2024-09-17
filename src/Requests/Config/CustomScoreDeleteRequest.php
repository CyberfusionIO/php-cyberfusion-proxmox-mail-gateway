<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config;

class CustomScoreDeleteRequest
{
    /**
     * @param string $name The name of the rule.
     * @param string|null $digest Prevent changes if current configuration file has a different digest.
     */
    public function __construct(
        public string $name,
        public ?string $digest = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'digest' => $this->digest,
        ], fn($value) => $value !== null);
    }
}
