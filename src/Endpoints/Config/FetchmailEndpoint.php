<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\FetchmailUser;
use Cyberfusion\ProxmoxMGW\Requests\Config\FetchmailCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\FetchmailDeleteRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\FetchmailGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\FetchmailUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class FetchmailEndpoint extends Endpoint
{
    /**
     * List fetchmail users.
     *
     * @return Result
     */
    public function list(): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/fetchmail',
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        $users = collect();
        foreach ($data as $userData) {
            $users->push(new FetchmailUser(
                id: Arr::get($userData, 'id'),
                enable: Arr::get($userData, 'enable'),
                interval: Arr::get($userData, 'interval'),
                keep: Arr::get($userData, 'keep'),
                pass: Arr::get($userData, 'pass'),
                port: Arr::get($userData, 'port'),
                protocol: Arr::get($userData, 'protocol'),
                server: Arr::get($userData, 'server'),
                ssl: Arr::get($userData, 'ssl'),
                target: Arr::get($userData, 'target'),
                user: Arr::get($userData, 'user'),
            ));
        }

        return new Result(success: true, data: ['users' => $users]);
    }

    /**
     * Create fetchmail user configuration.
     *
     * @param FetchmailCreateRequest $request
     * @return Result
     */
    public function create(FetchmailCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/fetchmail',
                method: 'POST',
                params: $request->toArray(),
            );

            $id = $response->getBody()->getContents();
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['id' => $id]);
    }

    /**
     * Delete a fetchmail configuration entry.
     *
     * @param FetchmailDeleteRequest $request
     * @return Result
     */
    public function delete(FetchmailDeleteRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/fetchmail/%s', $request->id),
                method: 'DELETE',
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }

    /**
     * Read fetchmail user configuration.
     *
     * @param FetchmailGetRequest $request
     * @return Result
     */
    public function get(FetchmailGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/fetchmail/%s', $request->id),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'user' => new FetchmailUser(
                    id: Arr::get($data, 'id'),
                    enable: Arr::get($data, 'enable'),
                    interval: Arr::get($data, 'interval'),
                    keep: Arr::get($data, 'keep'),
                    pass: Arr::get($data, 'pass'),
                    port: Arr::get($data, 'port'),
                    protocol: Arr::get($data, 'protocol'),
                    server: Arr::get($data, 'server'),
                    ssl: Arr::get($data, 'ssl'),
                    target: Arr::get($data, 'target'),
                    user: Arr::get($data, 'user'),
                ),
            ],
        );
    }

    /**
     * Update fetchmail user configuration.
     *
     * @param FetchmailUpdateRequest $request
     * @return Result
     */
    public function update(FetchmailUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/fetchmail/%s', $request->id),
                method: 'PUT',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
