<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class RenewCertRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $type The TLS certificate type (API or SMTP certificate).
     * @param bool $force Force renewal even if expiry is more than 30 days away.
     */
    public function __construct(
        public string $node,
        public string $type,
        public bool $force = false,
    ) {
    }
}
