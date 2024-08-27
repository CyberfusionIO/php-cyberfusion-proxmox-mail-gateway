<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\DkimDomain;
use Cyberfusion\ProxmoxMGW\Requests\DkimDomainCreateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class DkimDomainsEndpoint extends Endpoint
{
    /**
     * List DKIM-sign domains.
     *
     * @return Result The result object containing the list of DKIM domains or error information.
     */
    public function get(): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/dkim/domains',
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
            $domains->push(new DkimDomain(
                domain: Arr::get($domain, 'domain'),
                comment: Arr::get($domain, 'comment'),
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
     * Add DKIM-sign domain.
     *
     * @param DkimDomainCreateRequest $request
     * @return Result The result object indicating success or failure.
     */
    public function create(DkimDomainCreateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: '/config/dkim/domains',
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
}
