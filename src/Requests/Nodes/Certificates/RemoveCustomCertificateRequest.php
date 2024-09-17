<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes\Certificates;

class RemoveCustomCertificateRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $type The TLS certificate type (API or SMTP certificate).
     * @param bool $restart Restart pmgproxy.
     */
    public function __construct(
        public string $node,
        public string $type,
        public bool $restart = false,
    ) {
    }
}
