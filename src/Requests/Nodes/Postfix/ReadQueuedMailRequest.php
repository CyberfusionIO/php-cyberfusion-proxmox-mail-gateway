<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes\Postfix;

class ReadQueuedMailRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $queue Postfix queue name.
     * @param string $queue_id The Message queue ID.
     * @param bool $body Include body content.
     * @param bool $decode_header Decodes the header fields.
     * @param bool $header Show message header content.
     */
    public function __construct(
        public string $node,
        public string $queue,
        public string $queue_id,
        public bool $body = false,
        public bool $decode_header = false,
        public bool $header = true,
    ) {
    }

    public function toArray(): array
    {
        return [
            'body' => $this->body ? 1 : 0,
            'decode-header' => $this->decode_header ? 1 : 0,
            'header' => $this->header ? 1 : 0,
        ];
    }
}
