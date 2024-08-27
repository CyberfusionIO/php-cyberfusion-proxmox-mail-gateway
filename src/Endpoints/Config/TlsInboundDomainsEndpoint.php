<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\TlsInboundDomain;
use Cyberfusion\ProxmoxMGW\Requests\TlsInboundDomainCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\TlsInboundDomainDeleteRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class TlsInboundDomainsEndpoint extends Endpoint
{
    /**
     * List tls_inbound_domains entries.
     *
     * @return Result The result object containing the list of domains or error information.
     */
    public function get(): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/tls-inbound-domains',
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
            $domains->push(new TlsInboundDomain($domain));
        }

        return new Result(
            success: true,
            data: [
                'domains' => $domains,
            ],
        );
    }

    /**
     * Add new tls_inbound_domains entry.
     *
     * @param TlsInboundDomainCreateRequest $request
     * @return Result The result object indicating success or failure.
     */
    public function create(TlsInboundDomainCreateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: '/config/tls-inbound-domains',
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
     * Delete a tls_inbound_domains entry.
     *
     * @param TlsInboundDomainDeleteRequest $request
     * @return Result The result object indicating success or failure.
     */
    public function delete(TlsInboundDomainDeleteRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/tls-inbound-domains/%s', $request->domain),
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
