<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

/**
 * Class RuleFromGroupDeleteRequest
 *
 * This class represents a request to delete a group from the 'from' list of a rule in the Proxmox Mail Gateway.
 */
class RuleFromGroupDeleteRequest
{
    /**
     * @param int $id Rule ID.
     * @param int $ogroup Groups ID.
     */
    public function __construct(
        public int $id,
        public int $ogroup,
    ) {
    }
}
