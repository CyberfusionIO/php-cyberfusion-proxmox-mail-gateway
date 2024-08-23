<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDb;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDb\RuleConfig;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\RuleConfigGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\RuleConfigUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class RuleConfigEndpoint extends Endpoint
{
    /**
     * Get common rule properties.
     *
     * @param RuleConfigGetRequest $request
     * @return Result
     */
    public function get(RuleConfigGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/rules/%d/config', $request->id),
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
                'ruleConfig' => new RuleConfig(
                    active: Arr::get($data, 'active'),
                    direction: Arr::get($data, 'direction'),
                    id: Arr::get($data, 'id'),
                    name: Arr::get($data, 'name'),
                    priority: Arr::get($data, 'priority'),
                ),
            ],
        );
    }

    /**
     * Set rule properties.
     *
     * @param RuleConfigUpdateRequest $request
     * @return Result
     */
    public function update(RuleConfigUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/rules/%d/config', $request->id),
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
