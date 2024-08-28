<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\Whitelist;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\IpCreateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class IpEndpoint extends Endpoint
{
    /**
     * Add 'IP Address' object.
     *
     * @param IpCreateRequest $request
     * @return Result
     */
    public function create(IpCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/whitelist/ip',
                method: 'POST',
                params: $request->toArray(),
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['id' => $data]);
    }
}
