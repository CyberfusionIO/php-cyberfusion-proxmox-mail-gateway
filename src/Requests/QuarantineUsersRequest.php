<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

/**
 * Class QuarantineUsersRequest
 *
 * This class represents a request to list users with whitelist/blacklist settings in the Proxmox Mail Gateway.
 */
class QuarantineUsersRequest
{
    /**
     * @param string|null $list If set, limits the result to the given list (BL or WL).
     */
    public function __construct(
        public ?string $list = null,
    ) {
    }

    /**
     * Convert the request parameters to an array.
     *
     * @return array An array of non-null parameters.
     */
    public function toArray(): array
    {
        return array_filter([
            'list' => $this->list,
        ], fn($value) => $value !== null);
    }
}
