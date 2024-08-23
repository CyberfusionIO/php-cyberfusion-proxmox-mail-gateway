<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Quarantine;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\BlacklistEntry;
use Cyberfusion\ProxmoxMGW\Requests\QuarantineBlacklistGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\QuarantineBlacklistAddRequest;
use Cyberfusion\ProxmoxMGW\Requests\QuarantineBlacklistDeleteRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

/**
 * Class QuarantineBlacklistEndpoint
 *
 * This class handles operations related to user blacklist in the Proxmox Mail Gateway.
 */
class QuarantineBlacklistEndpoint extends Endpoint
{
    /**
     * Show user blacklist.
     *
     * @param QuarantineBlacklistGetRequest $request The request object containing query parameters.
     * @return Result The result object containing the list of blacklist entries or error information.
     */
    public function get(QuarantineBlacklistGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/quarantine/blacklist',
                method: 'GET',
                params: $request->toArray(),
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $blacklistEntries = collect();
        foreach ($data as $item) {
            $blacklistEntries->push(new BlacklistEntry(
                address: Arr::get($item, 'address'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'blacklistEntries' => $blacklistEntries,
            ],
        );
    }

    /**
     * Add user blacklist entries.
     *
     * @param QuarantineBlacklistAddRequest $request The request object containing the address to add.
     * @return Result The result object indicating success or failure.
     */
    public function add(QuarantineBlacklistAddRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: '/quarantine/blacklist',
                method: 'POST',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(success: true);
    }

    /**
     * Delete user blacklist entries.
     *
     * @param QuarantineBlacklistDeleteRequest $request The request object containing the addresses to delete.
     * @return Result The result object indicating success or failure.
     */
    public function delete(QuarantineBlacklistDeleteRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: '/quarantine/blacklist',
                method: 'DELETE',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(success: true);
    }
}
