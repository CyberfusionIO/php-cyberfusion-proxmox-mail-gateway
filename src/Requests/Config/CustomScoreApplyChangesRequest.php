<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config;

class CustomScoreApplyChangesRequest
{
    /**
     * @param string|null $digest Prevent changes if current configuration file has a different digest.
     * @param bool $restartDaemon If set, also restarts pmg-smtp-filter. This is necessary for the changes to work.
     */
    public function __construct(
        public ?string $digest = null,
        public bool $restartDaemon = false,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'digest' => $this->digest,
            'restart-daemon' => $this->restartDaemon,
        ], fn($value) => $value !== null);
    }
}
