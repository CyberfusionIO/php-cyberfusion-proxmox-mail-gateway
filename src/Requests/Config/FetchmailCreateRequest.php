<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config;

class FetchmailCreateRequest
{
    /**
     * @param string $pass The password used for server login.
     * @param string $protocol Specify the protocol to use when communicating with the remote mailserver.
     * @param string $server Server address (IP or DNS name).
     * @param string $target The target email address (where to deliver fetched mails).
     * @param string $user The user identification to be used when logging in to the server.
     * @param bool|null $enable Flag to enable or disable polling.
     * @param int|null $interval Only check this site every <interval> poll cycles. A poll cycle is 5 minutes.
     * @param bool|null $keep Keep retrieved messages on the remote mailserver.
     * @param int|null $port Port number.
     * @param bool|null $ssl Use SSL.
     */
    public function __construct(
        public string $pass,
        public string $protocol,
        public string $server,
        public string $target,
        public string $user,
        public ?bool $enable = null,
        public ?int $interval = null,
        public ?bool $keep = null,
        public ?int $port = null,
        public ?bool $ssl = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'pass' => $this->pass,
            'protocol' => $this->protocol,
            'server' => $this->server,
            'target' => $this->target,
            'user' => $this->user,
            'enable' => $this->enable,
            'interval' => $this->interval,
            'keep' => $this->keep,
            'port' => $this->port,
            'ssl' => $this->ssl,
        ], fn($value) => !is_null($value));
    }
}
