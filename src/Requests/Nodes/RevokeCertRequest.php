<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class RevokeCertRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $type The TLS certificate type (API or SMTP certificate).
     */
    public function __construct(
        public string $node,
        public string $type,
    ) {
    }
}
