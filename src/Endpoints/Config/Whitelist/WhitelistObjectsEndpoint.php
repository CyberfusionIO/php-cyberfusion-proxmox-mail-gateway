<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\Whitelist;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\Whitelist\WhitelistObject;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\WhitelistObjectDeleteRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\WhitelistEmailCreateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class WhitelistObjectsEndpoint extends Endpoint
{
    /**
     * Get list of all SMTP whitelist entries.
     *
     * @return Result
     */
    public function get(): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/whitelist/objects',
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $whitelistObjects = collect();
        foreach (Arr::get($data, 'data', []) as $object) {
            $whitelistObjects->push(new WhitelistObject(
                id: Arr::get($object, 'id'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'whitelistObjects' => $whitelistObjects,
            ],
        );
    }

    /**
     * Remove an object from the SMTP whitelist.
     *
     * @param WhitelistObjectDeleteRequest $request
     * @return Result
     */
    public function delete(WhitelistObjectDeleteRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/whitelist/objects/%d', $request->id),
                method: 'DELETE',
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
     * Add 'Mail address' object.
     *
     * @param WhitelistEmailCreateRequest $request
     * @return Result
     */
    public function createEmail(WhitelistEmailCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/whitelist/email',
                method: 'POST',
                params: [
                    'email' => $request->email,
                ],
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(
            success: true,
            data: [
                'id' => Arr::get($data, 'data'),
            ],
        );
    }
}
