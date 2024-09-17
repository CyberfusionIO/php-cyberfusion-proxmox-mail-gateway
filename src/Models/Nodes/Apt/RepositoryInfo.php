<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes\Apt;

class RepositoryInfo
{
    /**
     * @param string $digest Common digest of all files.
     * @param array $errors List of problematic repository files.
     * @param array $files List of parsed repository files.
     * @param array $infos Additional information/warnings for APT repositories.
     * @param array $standardRepos List of standard repositories and their configuration status.
     */
    public function __construct(
        public string $digest,
        public array $errors,
        public array $files,
        public array $infos,
        public array $standardRepos,
    ) {
    }
}
