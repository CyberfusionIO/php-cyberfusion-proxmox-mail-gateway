<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config;

class PbsRemoteUpdateRequest
{
    /**
     * @param string $remote Proxmox Backup Server ID.
     * @param string|null $datastore Proxmox Backup Server datastore name.
     * @param string|null $delete A list of settings you want to delete.
     * @param string|null $digest Prevent changes if current configuration file has a different digest. This can be used to prevent concurrent modifications.
     * @param bool|null $disable Flag to disable (deactivate) the entry.
     * @param string|null $fingerprint Certificate SHA 256 fingerprint.
     * @param bool|null $includeStatistics Include statistics in scheduled backups
     * @param int|null $keepDaily Keep backups for the last <N> different days. If there is more than one backup for a single day, only the latest one is kept.
     * @param int|null $keepHourly Keep backups for the last <N> different hours. If there is more than one backup for a single hour, only the latest one is kept.
     * @param int|null $keepLast Keep the last <N> backups.
     * @param int|null $keepMonthly Keep backups for the last <N> different months. If there is more than one backup for a single month, only the latest one is kept.
     * @param int|null $keepWeekly Keep backups for the last <N> different weeks. If there is more than one backup for a single week, only the latest one is kept.
     * @param int|null $keepYearly Keep backups for the last <N> different years. If there is more than one backup for a single year, only the latest one is kept.
     * @param string|null $namespace Proxmox Backup Server namespace in the datastore, defaults to the root NS.
     * @param string|null $notify Specify when to notify via e-mail
     * @param string|null $password Password or API token secret for the user on the Proxmox Backup Server.
     * @param int|null $port Non-default port for Proxmox Backup Server.
     * @param string|null $server Proxmox Backup Server address.
     * @param string|null $username Username or API token ID on the Proxmox Backup Server
     */
    public function __construct(
        public string $remote,
        public ?string $datastore = null,
        public ?string $delete = null,
        public ?string $digest = null,
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
        public ?string $server = null,
        public ?string $username = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'remote' => $this->remote,
            'datastore' => $this->datastore,
            'delete' => $this->delete,
            'digest' => $this->digest,
            'disable' => $this->disable,
            'fingerprint' => $this->fingerprint,
            'include-statistics' => $this->includeStatistics,
            'keep-daily' => $this->keepDaily,
            'keep-hourly' => $this->keepHourly,
            'keep-last' => $this->keepLast,
            'keep-monthly' => $this->keepMonthly,
            'keep-weekly' => $this->keepWeekly,
            'keep-yearly' => $this->keepYearly,
            'namespace' => $this->namespace,
            'notify' => $this->notify,
            'password' => $this->password,
            'port' => $this->port,
            'server' => $this->server,
            'username' => $this->username,
        ], fn($value) => !is_null($value));
    }
}
