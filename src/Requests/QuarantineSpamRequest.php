<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class QuarantineSpamRequest
{
    public function __construct(
        public ?int $endtime = null,
        public ?string $pmail = null,
        public ?int $starttime = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'endtime' => $this->endtime,
            'pmail' => $this->pmail,
            'starttime' => $this->starttime,
        ], fn($value) => $value !== null);
    }
}
