<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Cluster;

class JoinClusterRequest
{
    /**
     * @param string $fingerprint SSL certificate fingerprint.
     * @param string $master_ip IP address.
     * @param string $password Superuser password.
     */
    public function __construct(
        public string $fingerprint,
        public string $master_ip,
        public string $password,
    ) {
    }

    /**
     * Convert the request parameters to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'fingerprint' => $this->fingerprint,
            'master_ip' => $this->master_ip,
            'password' => $this->password,
        ];
    }
}
