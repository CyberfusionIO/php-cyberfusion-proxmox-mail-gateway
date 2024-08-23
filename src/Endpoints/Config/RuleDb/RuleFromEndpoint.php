<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDb;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDb\FromGroup;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\GetRuleFromRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\AddRuleFromGroupRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class RuleFromEndpoint extends Endpoint
{
    /**
     * Get 'from' group list.
     *
     * @param GetRuleFromRequest $request
     * @return Result
     */
    public function get(GetRuleFromRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/rules/%d/from', $request->id),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $fromGroups = collect();
        foreach (Arr::get($data, 'data', []) as $group) {
            $fromGroups->push(new FromGroup(
                id: Arr::get($group, 'id'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'fromGroups' => $fromGroups,
            ],
        );
    }

    /**
     * Add group to 'from' list.
     *
     * @param AddRuleFromGroupRequest $request
     * @return Result
     */
    public function addGroup(AddRuleFromGroupRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/rules/%d/from', $request->id),
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
