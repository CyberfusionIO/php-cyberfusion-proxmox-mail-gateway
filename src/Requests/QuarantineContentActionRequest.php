<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

/**
 * Class QuarantineContentActionRequest
 *
 * This class represents a request to execute an action on quarantined emails in the Proxmox Mail Gateway.
 */
class QuarantineContentActionRequest
{
    /**
     * @param string $action Action - specify what you want to do with the mail (whitelist, blacklist, deliver, delete).
     * @param string $id Unique IDs, separate with ;
     */
    public function __construct(
        public string $action,
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
            'action' => $this->action,
            'id' => $this->id,
        ];
    }
}
