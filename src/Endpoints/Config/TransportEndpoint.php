<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\TransportMap;
use Cyberfusion\ProxmoxMGW\Requests\TransportListRequest;
use Cyberfusion\ProxmoxMGW\Requests\TransportCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\TransportDeleteRequest;
use Cyberfusion\ProxmoxMGW\Requests\TransportReadRequest;
use Cyberfusion\ProxmoxMGW\Requests\TransportUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class TransportEndpoint extends Endpoint
{
    /**
     * List transport map entries.
     *
     * @param TransportListRequest $request
     * @return Result
     */
    public function list(TransportListRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/transport',
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

        $transportMaps = collect();
        foreach (Arr::get($data, 'data', []) as $item) {
            $transportMaps->push(new TransportMap(
                comment: Arr::get($item, 'comment'),
                domain: Arr::get($item, 'domain'),
                host: Arr::get($item, 'host'),
                port: Arr::get($item, 'port'),
                protocol: Arr::get($item, 'protocol'),
                use_mx: Arr::get($item, 'use_mx'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'transportMaps' => $transportMaps,
            ],
        );
    }

    /**
     * Add transport map entry.
     *
     * @param TransportCreateRequest $request
     * @return Result
     */
    public function create(TransportCreateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: '/config/transport',
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
     * Delete a transport map entry.
     *
     * @param TransportDeleteRequest $request
     * @return Result
     */
    public function delete(TransportDeleteRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/transport/%s', $request->domain),
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
     * Read transport map entry.
     *
     * @param TransportReadRequest $request
     * @return Result
     */
    public function read(TransportReadRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/transport/%s', $request->domain),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $transportMap = new TransportMap(
            comment: Arr::get($data, 'comment'),
            domain: Arr::get($data, 'domain'),
            host: Arr::get($data, 'host'),
            port: Arr::get($data, 'port'),
            protocol: Arr::get($data, 'protocol'),
            use_mx: Arr::get($data, 'use_mx'),
        );

        return new Result(
            success: true,
            data: [
                'transportMap' => $transportMap,
            ],
        );
    }

    /**
     * Update transport map entry.
     *
     * @param TransportUpdateRequest $request
     * @return Result
     */
    public function update(TransportUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/transport/%s', $request->domain),
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
