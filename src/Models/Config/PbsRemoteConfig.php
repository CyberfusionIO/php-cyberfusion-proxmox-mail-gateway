<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config;

class PbsRemoteConfig
{
    public function __construct(
        public string $remote,
        public ?string $datastore = null,
        public ?bool $disable = null,
        public ?string $fingerprint = null,
        public ?bool $includeStatistics = null,
        public ?int $keepDaily = null,
        public ?int $keepHourly = null,
        public ?int $keepLast = null,
        public ?int $keepMonthly = null,
        public ?int $keepWeekly = null,
        public ?int $keepYearly = null,
        public ?string $namespace = null,
        public ?string $notify = null,
        public ?int $port = null,
        public ?string $server = null,
        public ?string $username = null,
    ) {
    }
}
