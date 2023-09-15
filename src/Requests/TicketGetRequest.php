<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class TicketGetRequest
{
    public function __construct(
        public string $username,
        public string $password,
        public string $realm = 'pam',
    ) {
    }
}
