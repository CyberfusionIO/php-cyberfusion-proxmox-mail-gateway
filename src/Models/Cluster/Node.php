<?php

namespace Cyberfusion\ProxmoxMGW\Models\Cluster;

class Node
{
    /**
     * @param int $cid Cluster ID.
     * @param string|null $fingerprint SSL certificate fingerprint.
     * @param string|null $hostrsapubkey Public SSH RSA key for the host.
     * @param string|null $ip IP address.
     * @param string|null $name Node name.
     * @param string|null $rootrsapubkey Public SSH RSA key for the root user.
     * @param string|null $type Node type.
     */
    public function __construct(
        public int $cid,
        public ?string $fingerprint = null,
        public ?string $hostrsapubkey = null,
        public ?string $ip = null,
        public ?string $name = null,
        public ?string $rootrsapubkey = null,
        public ?string $type = null,
    ) {
    }
}
