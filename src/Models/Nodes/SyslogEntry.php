<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes;

/**
 * Class SyslogEntry
 *
 * This class represents a single syslog entry.
 */
class SyslogEntry
{
    /**
     * @param int $n Line number.
     * @param string $t Line text.
     */
    public function __construct(
        public int $n,
        public string $t,
    ) {
    }
}
