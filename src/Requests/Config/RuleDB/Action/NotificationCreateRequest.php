<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Action;

class NotificationCreateRequest
{
    /**
     * @param string $name Action name.
     * @param string $body The Notification Body
     * @param string $subject The Notification subject
     * @param string $to The Receiver E-Mail address
     * @param bool|null $attach Attach original E-Mail
     * @param string|null $info Informational comment.
     */
    public function __construct(
        public string $name,
        public string $body,
        public string $subject,
        public string $to,
        public ?bool $attach = null,
        public ?string $info = null,
    ) {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'body' => $this->body,
            'subject' => $this->subject,
            'to' => $this->to,
            'attach' => $this->attach,
            'info' => $this->info,
        ], fn($value) => !is_null($value));
    }
}
