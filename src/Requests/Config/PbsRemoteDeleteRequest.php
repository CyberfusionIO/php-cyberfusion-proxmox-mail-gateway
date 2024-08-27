<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config;

class PbsRemoteDeleteRequest
{
    /**
     * @param string $remote Profile ID.
     */
    public function __construct(
        public string $remote,
    ) {
    }
}
