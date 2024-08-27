<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class DkimSelector
{
    /**
     * @param int|null $keysize Number of bits for the RSA-Key
     * @param string|null $record DKIM TXT record
     * @param string|null $selector DKIM Selector
     */
    public function __construct(
        public ?int $keysize,
        public ?string $record,
        public ?string $selector,
    ) {
    }
}
