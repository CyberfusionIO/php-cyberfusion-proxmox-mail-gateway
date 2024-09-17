<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config;

class PbsCreateRequest
{
    /**
     * @param string $remote Proxmox Backup Server ID.
     * @param string $server Proxmox Backup Server address.
     * @param string $datastore Proxmox Backup Server datastore name.
     * @param string|null $password Password or API token secret for the user on the Proxmox Backup Server.
     * @param string|null $fingerprint Certificate SHA 256 fingerprint.
     * @param int|null $port Non-default port for Proxmox Backup Server.
     * @param string|null $username Username or API token ID on the Proxmox Backup Server
     * @param string|null $namespace Proxmox Backup Server namespace in the datastore, defaults to the root NS.
     * @param string|null $notify Specify when to notify via e-mail
     * @param int|null $keepDaily Keep backups for the last <N> different days.
     * @param int|null $keepHourly Keep backups for the last <N> different hours.
     * @param int|null $keepLast Keep the last <N> backups.
     * @param int|null $keepMonthly Keep backups for the last <N> different months.
     * @param int|null $keepWeekly Keep backups for the last <N> different weeks.
     * @param int|null $keepYearly Keep backups for the last <N> different years.
     * @param bool|null $disable Flag to disable (deactivate) the entry.
     * @param bool|null $includeStatistics Include statistics in scheduled backups
     */
    public function __construct(
        public string $remote,
        public string $server,
        public string $datastore,
        public ?string $password = null,
        public ?string $fingerprint = null,
        public ?int $port = null,
        public ?string $username = null,
        public ?string $namespace = null,
        public ?string $notify = null,
        public ?int $keepDaily = null,
        public ?int $keepHourly = null,
        public ?int $keepLast = null,
        public ?int $keepMonthly = null,
        public ?int $keepWeekly = null,
        public ?int $keepYearly = null,
        public ?bool $disable = null,
        public ?bool $includeStatistics = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'remote' => $this->remote,
            'server' => $this->server,
            'datastore' => $this->datastore,
            'password' => $this->password,
            'fingerprint' => $this->fingerprint,
            'port' => $this->port,
            'username' => $this->username,
            'namespace' => $this->namespace,
            'notify' => $this->notify,
            'keep-daily' => $this->keepDaily,
            'keep-hourly' => $this->keepHourly,
            'keep-last' => $this->keepLast,
            'keep-monthly' => $this->keepMonthly,
            'keep-weekly' => $this->keepWeekly,
            'keep-yearly' => $this->keepYearly,
            'disable' => $this->disable,
            'include-statistics' => $this->includeStatistics,
        ], fn($value) => $value !== null);
    }
}
