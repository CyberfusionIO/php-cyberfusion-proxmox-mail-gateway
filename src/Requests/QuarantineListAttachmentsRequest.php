<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

/**
 * Class QuarantineListAttachmentsRequest
 *
 * This class represents a request to list attachments for an email in the Proxmox Mail Gateway quarantine.
 */
class QuarantineListAttachmentsRequest
{
    /**
     * @param string $id Unique ID
     */
    public function __construct(
        public string $id,
    ) {
    }

    /**
     * Convert the request parameters to an array.
     *
     * @return array An array of parameters.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
        ];
    }
}
