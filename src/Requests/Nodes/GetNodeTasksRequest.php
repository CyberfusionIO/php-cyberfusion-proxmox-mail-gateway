<?php

namespace Cyberfusion\ProxmoxPVE\Requests\Nodes;

class GetNodeTasksRequest
{
    /**
     * @param string $node The cluster node name.
     * @param bool|null $errors Include errors.
     * @param int|null $limit Limit number of results.
     * @param int|null $since Only list tasks since this UNIX epoch.
     * @param int|null $start Offset for listing.
     * @param string|null $statusfilter List of Task States that should be returned.
     * @param string|null $typefilter Only list tasks of this type (e.g., aptupdate, saupdate).
     * @param int|null $until Only list tasks until this UNIX epoch.
     * @param string|null $userfilter Only list tasks from this user.
     */
    public function __construct(
        public string $node,
        public ?bool $errors = null,
        public ?int $limit = null,
        public ?int $since = null,
        public ?int $start = null,
        public ?string $statusfilter = null,
        public ?string $typefilter = null,
        public ?int $until = null,
        public ?string $userfilter = null,
    ) {
    }
}
