<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB\Who;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who\NetworkCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who\NetworkGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who\NetworkUpdateRequest;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\Who\Network;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class NetworkEndpoint extends Endpoint
{
    /**
     * Add 'IP Network' object.
     *
     * @param NetworkCreateRequest $request
     * @return Result
     */
    public function create(NetworkCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/who/%d/network', $request->ogroup),
                method: 'POST',
                params: $request->toArray(),
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['id' => Arr::get($data, 'data')]);
    }

    /**
     * Read 'IP Network' object settings.
     *
     * @param NetworkGetRequest $request
     * @return Result
     */
    public function get(NetworkGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/who/%d/network/%d', $request->ogroup, $request->id),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: ['network' => new Network(id: Arr::get($data, 'data.id'), cidr: Arr::get($data, 'data.cidr'))],
        );
    }

    /**
     * Update 'IP Network' object.
     *
     * @param NetworkUpdateRequest $request
     * @return Result
     */
    public function update(NetworkUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/who/%d/network/%d', $request->ogroup, $request->id),
                method: 'PUT',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
