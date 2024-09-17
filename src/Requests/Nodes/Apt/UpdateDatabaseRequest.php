<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes\Apt;

class UpdateDatabaseRequest
{
    /**
     * @param string $node The cluster node name.
     * @param bool $notify Send notification mail about new packages (to email address specified for user 'root@pam').
     * @param bool $quiet Only produces output suitable for logging, omitting progress indicators.
     */
    public function __construct(
        public string $node,
        public bool $notify = false,
        public bool $quiet = false,
    ) {
    }

    public function toArray(): array
    {
        return [
            'notify' => $this->notify,
            'quiet' => $this->quiet,
        ];
    }
}
