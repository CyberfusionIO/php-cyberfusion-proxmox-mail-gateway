<?php

namespace Cyberfusion\ProxmoxMGW\Support;

use Illuminate\Support\Str;

class Cidr
{
    /**
     * The proxmox api requires a full cidr. So when a single ip is provided, add the /32 part.
     */
    public static function full(string $cidr): string
    {
        if (Str::contains($cidr, '/')) {
            return $cidr;
        }

        $range = 32;
        if (Str::contains($cidr, ':')) {
            $range = 128;
        }

        return sprintf('%s/%d', $cidr, $range);
    }
}
