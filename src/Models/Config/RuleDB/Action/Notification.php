<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\Action;

class Notification
{
    /**
     * @param string $id Action Object ID.
     * @param bool $attach Attach original E-Mail
     * @param string $body The Notification Body
     * @param string|null $info Informational comment.
     * @param string $name Action name.
     * @param string $subject The Notification subject
     * @param string $to The Receiver E-Mail address
     */
    public function __construct(
        public string $id,
        public bool $attach,
        public string $body,
        public ?string $info,
        public string $name,
        public string $subject,
        public string $to,
    ) {
    }
}
