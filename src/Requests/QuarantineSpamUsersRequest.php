<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class QuarantineSpamUsersRequest
{
    public function __construct(
        public ?int $endtime = null,
        public string $quarantine_type = 'spam',
        public ?int $starttime = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'endtime' => $this->endtime,
            'quarantine-type' => $this->quarantine_type,
            'starttime' => $this->starttime,
        ], fn($value) => $value !== null);
    }
}
