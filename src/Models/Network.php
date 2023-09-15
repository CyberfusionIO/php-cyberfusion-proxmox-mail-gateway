<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class Network
{
    public function __construct(
        public int $size,
        public string $comment,
        public string $prefix,
        public string $cidr
    ) {
    }
}
