<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\RuleToGroup;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\AddRuleToGroupRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\GetRuleToRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class RuleToEndpoint extends Endpoint
{
    /**
     * Get 'to' group list.
     *
     * @param GetRuleToRequest $request
     * @return Result
     */
    public function get(GetRuleToRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/rules/%d/to', $request->id),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $groups = collect();
        foreach (Arr::get($data, 'data', []) as $group) {
            $groups->push(new RuleToGroup(
                id: Arr::get($group, 'id'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'groups' => $groups,
            ],
        );
    }

    /**
     * Add group to 'to' list.
     *
     * @param AddRuleToGroupRequest $request
     * @return Result
     */
    public function addGroup(AddRuleToGroupRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/rules/%d/to', $request->id),
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
