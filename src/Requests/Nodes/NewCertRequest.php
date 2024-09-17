<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class NewCertRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $type The TLS certificate type (API or SMTP certificate).
     * @param bool $force Overwrite existing custom certificate.
     */
    public function __construct(
        public string $node,
        public string $type,
        public bool $force = false,
    ) {
    }
}
