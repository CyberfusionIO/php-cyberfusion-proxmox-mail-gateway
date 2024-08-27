<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\TlsPolicy;
use Cyberfusion\ProxmoxMGW\Requests\TlsPolicyCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\TlsPolicyDeleteRequest;
use Cyberfusion\ProxmoxMGW\Requests\TlsPolicyGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\TlsPolicyUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class TlsPolicyEndpoint extends Endpoint
{
    /**
     * List tls_policy entries.
     *
     * @return Result
     */
    public function get(): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/tlspolicy',
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $policies = collect();
        foreach (Arr::get($data, 'data', []) as $policy) {
            $policies->push(new TlsPolicy(
                destination: Arr::get($policy, 'destination'),
                policy: Arr::get($policy, 'policy'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'policies' => $policies,
            ],
        );
    }

    /**
     * Add tls_policy entry.
     *
     * @param TlsPolicyCreateRequest $request
     * @return Result
     */
    public function create(TlsPolicyCreateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: '/config/tlspolicy',
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
     * Read tls_policy entry.
     *
     * @param TlsPolicyGetRequest $request
     * @return Result
     */
    public function getPolicy(TlsPolicyGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/tlspolicy/%s', $request->destination),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $policy = new TlsPolicy(
            destination: Arr::get($data, 'data.destination'),
            policy: Arr::get($data, 'data.policy'),
        );

        return new Result(
            success: true,
            data: [
                'policy' => $policy,
            ],
        );
    }

    /**
     * Update tls_policy entry.
     *
     * @param TlsPolicyUpdateRequest $request
     * @return Result
     */
    public function update(TlsPolicyUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/tlspolicy/%s', $request->destination),
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

    /**
     * Delete a tls_policy entry
     *
     * @param TlsPolicyDeleteRequest $request
     * @return Result
     */
    public function delete(TlsPolicyDeleteRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/tlspolicy/%s', $request->destination),
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
}
