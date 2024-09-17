<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\Whitelist;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\IpCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\IpGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\IpUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class IpEndpoint extends Endpoint
{
    /**
     * Add 'IP Address' object.
     *
     * @param IpCreateRequest $request
     *
     * @return Result
     */
    public function create(IpCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/whitelist/ip',
                method  : 'POST',
                params  : $request->toArray(),
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: [ 'id' => $data ]);
    }

    /**
     * Read 'IP Address' object settings.
     *
     * @param IpGetRequest $request
     *
     * @return Result
     */
    public function get(IpGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/whitelist/ip/%d', $request->id),
                method  : 'GET',
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
            data   : [
                'ip' => new Ip(
                    id: Arr::get($data, 'id'),
                ),
            ],
        );
    }

    /**
     * Update 'IP Address' object.
     *
     * @param IpUpdateRequest $request
     *
     * @return Result
     */
    public function update(IpUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/whitelist/ip/%d', $request->id),
                method  : 'PUT',
                params  : [
                    'ip' => $request->ip,
                ],
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
