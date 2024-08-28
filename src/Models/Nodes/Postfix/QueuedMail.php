<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes\Postfix;

class QueuedMail
{
    /**
     * @param int $arrival_time
     * @param int $message_size
     * @param string $sender
     * @param string $receiver
     * @param string $reason
     * @param string $queue_id
     */
    public function __construct(
        public int $arrival_time,
        public int $message_size,
        public string $sender,
        public string $receiver,
        public string $reason,
        public string $queue_id,
    ) {
    }
}
