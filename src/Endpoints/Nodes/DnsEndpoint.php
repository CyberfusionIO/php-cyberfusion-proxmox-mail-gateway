<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Nodes\DnsSettings;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\DnsGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\DnsUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class DnsEndpoint extends Endpoint
{
    /**
     * Read DNS settings.
     *
     * @param DnsGetRequest $request
     * @return Result
     */
    public function get(DnsGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/dns', $request->node),
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
                'dnsSettings' => new DnsSettings(
                    dns1: Arr::get($data, 'dns1'),
                    dns2: Arr::get($data, 'dns2'),
                    dns3: Arr::get($data, 'dns3'),
                    search: Arr::get($data, 'search'),
                ),
            ],
        );
    }

    /**
     * Write DNS settings.
     *
     * @param DnsUpdateRequest $request
     * @return Result
     */
    public function update(DnsUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/dns', $request->node),
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
