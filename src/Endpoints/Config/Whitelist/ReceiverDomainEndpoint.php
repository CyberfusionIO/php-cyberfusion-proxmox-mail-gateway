<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\Whitelist;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\Whitelist\ReceiverDomain;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\ReceiverDomainCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\ReceiverDomainGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\ReceiverDomainUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class ReceiverDomainEndpoint extends Endpoint
{
    /**
     * Add 'Domain' object.
     *
     * @param ReceiverDomainCreateRequest $request
     *
     * @return Result
     */
    public function create(ReceiverDomainCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/whitelist/receiver_domain',
                method  : 'POST',
                params  : $request->toArray(),
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
            data   : [
                'id' => Arr::get($data, 'data'),
            ],
        );
    }

    /**
     * Read 'Domain' object settings.
     *
     * @param ReceiverDomainGetRequest $request
     *
     * @return Result
     */
    public function get(ReceiverDomainGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/whitelist/receiver_domain/%d', $request->id),
                method  : 'GET',
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
            data   : [
                'receiverDomain' => new ReceiverDomain(
                    id: Arr::get($data, 'id'),
                ),
            ],
        );
    }

    /**
     * Update 'Domain' object.
     *
     * @param ReceiverDomainUpdateRequest $request
     *
     * @return Result
     */
    public function update(ReceiverDomainUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/whitelist/receiver_domain/%d', $request->id),
                method  : 'PUT',
                params  : [
                    'domain' => $request->domain,
                ],
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
