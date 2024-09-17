<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config;

class UpdateClamavConfigRequest
{
    /**
     * @param bool|null $archiveblockencrypted Whether to mark encrypted archives and documents as heuristic virus match. A match does not necessarily result in an immediate block, it just raises the Spam Score by 'clamav_heuristic_score'.
     * @param int|null $archivemaxfiles Number of files to be scanned within an archive, a document, or any other kind of container. Warning: disabling this limit or setting it too high may result in severe damage to the system.
     * @param int|null $archivemaxrec Nested archives are scanned recursively, e.g. if a ZIP archive contains a TAR  file,  all files within it will also be scanned. This options specifies how deeply the process should be continued. Warning: setting this limit too high may result in severe damage to the system.
     * @param int|null $archivemaxsize Files larger than this limit (in bytes) won't be scanned.
     * @param string|null $dbmirror ClamAV database mirror server.
     * @param string|null $delete A list of settings you want to delete.
     * @param string|null $digest Prevent changes if current configuration file has a different digest. This can be used to prevent concurrent modifications.
     * @param int|null $maxcccount This option sets the lowest number of Credit Card or Social Security numbers found in a file to generate a detect.
     * @param int|null $maxscansize Sets the maximum amount of data (in bytes) to be scanned for each input file.
     * @param bool|null $safebrowsing Enables support for Google Safe Browsing. (deprecated option, will be ignored)
     * @param bool|null $scriptedupdates Enables ScriptedUpdates (incremental download of signatures)
     */
    public function __construct(
        public ?bool $archiveblockencrypted = null,
        public ?int $archivemaxfiles = null,
        public ?int $archivemaxrec = null,
        public ?int $archivemaxsize = null,
        public ?string $dbmirror = null,
        public ?string $delete = null,
        public ?string $digest = null,
        public ?int $maxcccount = null,
        public ?int $maxscansize = null,
        public ?bool $safebrowsing = null,
        public ?bool $scriptedupdates = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'archiveblockencrypted' => $this->archiveblockencrypted,
            'archivemaxfiles' => $this->archivemaxfiles,
            'archivemaxrec' => $this->archivemaxrec,
            'archivemaxsize' => $this->archivemaxsize,
            'dbmirror' => $this->dbmirror,
            'delete' => $this->delete,
            'digest' => $this->digest,
            'maxcccount' => $this->maxcccount,
            'maxscansize' => $this->maxscansize,
            'safebrowsing' => $this->safebrowsing,
            'scriptedupdates' => $this->scriptedupdates,
        ], fn($value) => !is_null($value));
    }
}
