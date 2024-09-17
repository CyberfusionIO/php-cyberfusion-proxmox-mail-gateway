<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes;

class PbsJob
{
    /**
     * @param string $datastore Proxmox Backup Server datastore name.
     * @param bool|null $disable Flag to disable (deactivate) the entry.
     * @param string|null $fingerprint Certificate SHA 256 fingerprint.
     * @param bool|null $includeStatistics Include statistics in scheduled backups.
     * @param int|null $keepDaily Keep backups for the last <N> different days.
     * @param int|null $keepHourly Keep backups for the last <N> different hours.
     * @param int|null $keepLast Keep the last <N> backups.
     * @param int|null $keepMonthly Keep backups for the last <N> different months.
     * @param int|null $keepWeekly Keep backups for the last <N> different weeks.
     * @param int|null $keepYearly Keep backups for the last <N> different years.
     * @param string|null $namespace Proxmox Backup Server namespace in the datastore.
     * @param string|null $notify Specify when to notify via e-mail.
     * @param string|null $password Password or API token secret for the user on the Proxmox Backup Server.
     * @param int|null $port Non-default port for Proxmox Backup Server.
     * @param string $remote Proxmox Backup Server ID.
     * @param string $server Proxmox Backup Server address.
     * @param string|null $username Username or API token ID on the Proxmox Backup Server.
     */
    public function __construct(
        public string $datastore,
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
        public ?string $password = null,
        public ?int $port = null,
        public string $remote,
        public string $server,
        public ?string $username = null,
    ) {
    }
}
