<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\Who;

class EmailCreateRequest
{
    /**
     * @param string $email Email address.
     * @param int $ogroup Object Groups ID.
     */
    public function __construct(
        public string $email,
        public int $ogroup,
    ) {
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
        ];
    }
}
