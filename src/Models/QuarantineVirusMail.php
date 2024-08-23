<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class QuarantineVirusMail
{
    public function __construct(
        public int $bytes,
        public string $envelope_sender,
        public string $from,
        public string $id,
        public string $receiver,
        public ?string $sender,
        public string $subject,
        public int $time,
        public string $virusname,
    ) {
    }
}
