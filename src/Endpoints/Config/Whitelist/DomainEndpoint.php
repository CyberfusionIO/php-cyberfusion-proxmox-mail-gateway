<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\Whitelist;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\Whitelist\Domain;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\DomainCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\DomainUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class DomainEndpoint extends Endpoint
{
    /**
     * Add 'Domain' object.
     *
     * @param DomainCreateRequest $request
     * @return Result
     */
    public function create(DomainCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/whitelist/domain',
                method: 'POST',
                params: $request->toArray(),
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

    /**
     * Read 'Domain' object settings.
     *
     * @param int $id Object ID.
     * @return Result
     */
    public function get(int $id): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/whitelist/domain/%d', $id),
                method: 'GET',
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
                'domain' => new Domain(
                    id: Arr::get($data, 'data.id'),
                    domain: Arr::get($data, 'data.domain'),
                ),
            ],
        );
    }

    /**
     * Update 'Domain' object.
     *
     * @param DomainUpdateRequest $request
     * @return Result
     */
    public function update(DomainUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/whitelist/domain/%d', $request->id),
                method: 'PUT',
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
