<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Cluster;

class NodeAddRequest
{
    /**
     * @param string $fingerprint SSL certificate fingerprint.
     * @param string $hostrsapubkey Public SSH RSA key for the host.
     * @param string $ip IP address.
     * @param string $name Node name.
     * @param string $rootrsapubkey Public SSH RSA key for the root user.
     * @param int|null $maxcid Maximum used cluster node ID (used internally, do not modify).
     */
    public function __construct(
        public string $fingerprint,
        public string $hostrsapubkey,
        public string $ip,
        public string $name,
        public string $rootrsapubkey,
        public ?int $maxcid = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'fingerprint' => $this->fingerprint,
            'hostrsapubkey' => $this->hostrsapubkey,
            'ip' => $this->ip,
            'name' => $this->name,
            'rootrsapubkey' => $this->rootrsapubkey,
            'maxcid' => $this->maxcid,
        ], fn($value) => !is_null($value));
    }
}
