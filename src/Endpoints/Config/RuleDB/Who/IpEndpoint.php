<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB\Who;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\Who\Ip;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who\IpCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who\IpGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who\IpUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
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
                endpoint: sprintf('/config/ruledb/who/%d/ip', $request->ogroup),
                method: 'POST',
                params: [
                    'ip' => $request->ip,
                ],
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'id' => $data,
            ],
        );
    }

    /**
     * Read 'IP Address' object settings.
     *
     * @param IpGetRequest $request
     * @return Result
     */
    public function get(IpGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/who/%d/ip/%d', $request->ogroup, $request->id),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'ip' => new Ip(
                    id: Arr::get($data, 'id'),
                    ip: Arr::get($data, 'ip'),
                ),
            ],
        );
    }

    /**
     * Update 'IP Address' object.
     *
     * @param IpUpdateRequest $request
     * @return Result
     */
    public function update(IpUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/who/%d/ip/%d', $request->ogroup, $request->id),
                method: 'PUT',
                params: [
                    'ip' => $request->ip,
                ],
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
