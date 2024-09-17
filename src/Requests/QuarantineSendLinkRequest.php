<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class QuarantineSendLinkRequest
{
    public function __construct(
        public string $mail,
    ) {
    }

    public function toArray(): array
    {
        return [
            'mail' => $this->mail,
        ];
    }
}
