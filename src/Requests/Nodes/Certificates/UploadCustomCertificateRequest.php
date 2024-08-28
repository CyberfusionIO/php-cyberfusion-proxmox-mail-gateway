<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes\Certificates;

class UploadCustomCertificateRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $type The TLS certificate type (API or SMTP certificate).
     * @param string $certificates PEM encoded certificate (chain).
     * @param string $key PEM encoded private key.
     * @param bool $force Overwrite existing custom or ACME certificate files.
     * @param bool $restart Restart services.
     */
    public function __construct(
        public string $node,
        public string $type,
        public string $certificates,
        public string $key,
        public bool $force = false,
        public bool $restart = false,
    ) {
    }
}
