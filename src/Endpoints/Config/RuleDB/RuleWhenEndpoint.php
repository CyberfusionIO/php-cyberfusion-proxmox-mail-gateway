<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\WhenGroup;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\RuleWhenGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\RuleWhenAddRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class RuleWhenEndpoint extends Endpoint
{
    /**
     * Get 'when' group list.
     *
     * @param RuleWhenGetRequest $request
     * @return Result
     */
    public function get(RuleWhenGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/rules/%d/when', $request->id),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $whenGroups = collect();
        foreach (Arr::get($data, 'data', []) as $group) {
            $whenGroups->push(new WhenGroup(
                id: Arr::get($group, 'id'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'whenGroups' => $whenGroups,
            ],
        );
    }

    /**
     * Add group to 'when' list.
     *
     * @param RuleWhenAddRequest $request
     * @return Result
     */
    public function addWhenGroup(RuleWhenAddRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/rules/%d/when', $request->id),
                method: 'POST',
                params: [
                    'ogroup' => $request->ogroup,
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
