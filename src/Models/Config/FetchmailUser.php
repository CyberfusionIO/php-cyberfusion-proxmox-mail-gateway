<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config;

class FetchmailUser
{
    /**
     * @param string $id Unique ID
     * @param bool|null $enable Flag to enable or disable polling.
     * @param int|null $interval Only check this site every <interval> poll cycles. A poll cycle is 5 minutes.
     * @param bool|null $keep Keep retrieved messages on the remote mailserver.
     * @param string|null $pass The password used for server login.
     * @param int|null $port Port number.
     * @param string|null $protocol Specify the protocol to use when communicating with the remote mailserver.
     * @param string|null $server Server address (IP or DNS name).
     * @param bool|null $ssl Use SSL.
     * @param string|null $target The target email address (where to deliver fetched mails).
     * @param string|null $user The user identification to be used when logging in to the server.
     */
    public function __construct(
        public string $id,
        public ?bool $enable = null,
        public ?int $interval = null,
        public ?bool $keep = null,
        public ?string $pass = null,
        public ?int $port = null,
        public ?string $protocol = null,
        public ?string $server = null,
        public ?bool $ssl = null,
        public ?string $target = null,
        public ?string $user = null,
    ) {
    }
}
