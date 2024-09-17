<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Action;

class NotificationUpdateRequest
{
    /**
     * @param string $id Action Object ID.
     * @param string|null $name Action name.
     * @param string|null $body The Notification Body
     * @param string|null $subject The Notification subject
     * @param string|null $to The Receiver E-Mail address
     * @param bool|null $attach Attach original E-Mail
     * @param string|null $info Informational comment.
     */
    public function __construct(
        public string $id,
        public ?string $name = null,
        public ?string $body = null,
        public ?string $subject = null,
        public ?string $to = null,
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
            'id' => $this->id,
            'name' => $this->name,
            'body' => $this->body,
            'subject' => $this->subject,
            'to' => $this->to,
            'attach' => $this->attach,
            'info' => $this->info,
        ], fn($value) => !is_null($value));
    }
}
