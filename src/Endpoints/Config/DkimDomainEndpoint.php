<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\DkimDomain;
use Cyberfusion\ProxmoxMGW\Requests\DkimDomainDeleteRequest;
use Cyberfusion\ProxmoxMGW\Requests\DkimDomainGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\DkimDomainUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class DkimDomainEndpoint extends Endpoint
{
    /**
     * Delete a DKIM-sign domain.
     *
     * @param DkimDomainDeleteRequest $request
     * @return Result
     */
    public function delete(DkimDomainDeleteRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/dkim/domains/%s', $request->domain),
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
     * @param DkimDomainGetRequest $request
     * @return Result
     */
    public function get(DkimDomainGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/dkim/domains/%s', $request->domain),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'dkimDomain' => new DkimDomain(
                    domain: Arr::get($data, 'domain'),
                    comment: Arr::get($data, 'comment'),
                ),
            ],
        );
    }

    /**
     * Update DKIM-sign domain data (comment).
     *
     * @param DkimDomainUpdateRequest $request
     * @return Result
     */
    public function update(DkimDomainUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/dkim/domains/%s', $request->domain),
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
