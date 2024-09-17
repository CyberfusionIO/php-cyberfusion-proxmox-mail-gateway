<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Quarantine;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\WhitelistEntry;
use Cyberfusion\ProxmoxMGW\Requests\QuarantineWhitelistGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\QuarantineWhitelistAddRequest;
use Cyberfusion\ProxmoxMGW\Requests\QuarantineWhitelistDeleteRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class QuarantineWhitelistEndpoint extends Endpoint
{
    /**
     * Show user whitelist.
     *
     * @param QuarantineWhitelistGetRequest $request
     * @return Result
     */
    public function get(QuarantineWhitelistGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/quarantine/whitelist',
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

        $whitelistEntries = collect();
        foreach ($data as $item) {
            $whitelistEntries->push(new WhitelistEntry(
                address: Arr::get($item, 'address'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'whitelistEntries' => $whitelistEntries,
            ],
        );
    }

    /**
     * Add user whitelist entries.
     *
     * @param QuarantineWhitelistAddRequest $request
     * @return Result
     */
    public function add(QuarantineWhitelistAddRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: '/quarantine/whitelist',
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
     * Delete user whitelist entries.
     *
     * @param QuarantineWhitelistDeleteRequest $request
     * @return Result
     */
    public function delete(QuarantineWhitelistDeleteRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: '/quarantine/whitelist',
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
