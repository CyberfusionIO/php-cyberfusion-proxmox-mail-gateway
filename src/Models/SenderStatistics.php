<?php

namespace Cyberfusion\ProxmoxMGW\Models;

/**
 * Model representing sender address statistics.
 */
class SenderStatistics
{
    /**
     * @param int $bytes Mail traffic (Bytes).
     * @param string $sender Sender email.
     * @param int|null $count Mail count.
     * @param int|null $viruscount Number of sent virus mails.
     */
    public function __construct(
        public int    $bytes,
        public string $sender,
        public ?int   $count = null,
        public ?int   $viruscount = null,
    ) {
    }
}
