<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes;

class Mail
{
    /**
     * @param string|null $client Client address
     * @param string $dstatus Delivery status.
     * @param string $from Sender email address.
     * @param string $id Unique ID.
     * @param string|null $msgid SMTP message ID.
     * @param string|null $qid Postfix qmgr ID.
     * @param string|null $relay ID of relayed mail.
     * @param string|null $rstatus Delivery status of relayed mail.
     * @param float|null $size The size of the raw email.
     * @param int $time Delivery timestamp.
     * @param string $to Receiver email address.
     */
    public function __construct(
        public ?string $client,
        public string $dstatus,
        public string $from,
        public string $id,
        public ?string $msgid,
        public ?string $qid,
        public ?string $relay,
        public ?string $rstatus,
        public ?float $size,
        public int $time,
        public string $to,
    ) {
    }
}
