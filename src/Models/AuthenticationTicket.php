<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class AuthenticationTicket
{
    public function __construct(
        public string $username,
        public ?string $ticket = null,
        public ?string $role = null,
        public ?string $csrf = null,
    ) {
    }
}
