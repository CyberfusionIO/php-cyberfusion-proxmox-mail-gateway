<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Domain;
use Cyberfusion\ProxmoxMGW\Requests\Config\DomainGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\DomainUpdateRequest;
use Cyberfusion\ProxmoxMGW\Requests\DomainCreateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class DomainsEndpoint extends Endpoint
{
    /**
     * List relay domains.
     *
     * @return Result
     */
    public function list(): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/domains',
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $domains = collect();
        foreach (Arr::get($data, 'data', []) as $domain) {
            $domains->push(new Domain(
                comment: Arr::get($domain, 'comment'),
                domain: Arr::get($domain, 'domain'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'domains' => $domains,
            ],
        );
    }

    /**
     * Add relay domain.
     *
     * @param DomainCreateRequest $request
     * @return Result
     */
    public function create(DomainCreateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: '/config/domains',
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
     * Delete a relay domain.
     *
     * @param DomainDeleteRequest $request
     * @return Result
     */
    public function delete(DomainDeleteRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/domains/%s', $request->domain),
                method: 'DELETE',
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }

    /**
     * Read Domain data (comment).
     *
     * @param DomainGetRequest $request
     * @return Result
     */
    public function get(DomainGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/domains/%s', $request->domain),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'domain' => new Domain(
                    domain: Arr::get($data, 'domain'),
                    comment: Arr::get($data, 'comment'),
                ),
            ],
        );
    }

    /**
     * Update relay domain data (comment).
     *
     * @param DomainUpdateRequest $request
     * @return Result
     */
    public function update(DomainUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/domains/%s', $request->domain),
                method: 'PUT',
                params: [
                    'comment' => $request->comment,
                ],
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
