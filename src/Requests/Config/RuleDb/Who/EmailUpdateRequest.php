<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\Who;

class EmailUpdateRequest
{
    /**
     * @param string $email Email address.
     * @param int $id Object ID.
     * @param int $ogroup Object Groups ID.
     */
    public function __construct(
        public string $email,
        public int $id,
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
