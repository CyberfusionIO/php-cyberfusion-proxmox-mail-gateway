<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

/**
 * Class QuarantineContentGetRequest
 *
 * This class represents a request to get email data from the Proxmox Mail Gateway quarantine.
 */
class QuarantineContentGetRequest
{
    /**
     * @param string $id Unique ID
     * @param bool $raw Display 'raw' eml data. Deactivates size limit.
     */
    public function __construct(
        public string $id,
        public bool $raw = false,
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
            'raw' => $this->raw,
        ];
    }
}
