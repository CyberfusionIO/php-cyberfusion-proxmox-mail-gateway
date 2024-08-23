<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class QuarantineSpamMail
{
    public function __construct(
        public int $bytes,
        public string $envelope_sender,
        public string $from,
        public string $id,
        public string $receiver,
        public ?string $sender,
        public float $spamlevel,
        public string $subject,
        public int $time,
    ) {
    }
}
