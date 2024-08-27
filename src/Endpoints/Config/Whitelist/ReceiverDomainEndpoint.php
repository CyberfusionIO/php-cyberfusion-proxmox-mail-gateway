<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\Whitelist;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\ReceiverDomainCreateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class ReceiverDomainEndpoint extends Endpoint
{
    /**
     * Add 'Domain' object.
     *
     * @param ReceiverDomainCreateRequest $request
     * @return Result
     */
    public function create(ReceiverDomainCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/whitelist/receiver_domain',
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
}
