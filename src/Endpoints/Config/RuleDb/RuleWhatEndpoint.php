<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDb;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDb\RuleWhatGroup;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\RuleWhatGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\RuleWhatAddRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class RuleWhatEndpoint extends Endpoint
{
    /**
     * Get 'what' group list.
     *
     * @param RuleWhatGetRequest $request
     * @return Result
     */
    public function get(RuleWhatGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/rules/%d/what', $request->id),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $whatGroups = collect();
        foreach (Arr::get($data, 'data', []) as $group) {
            $whatGroups->push(new RuleWhatGroup(
                id: Arr::get($group, 'id'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'whatGroups' => $whatGroups,
            ],
        );
    }

    /**
     * Add group to 'what' list.
     *
     * @param RuleWhatAddRequest $request
     * @return Result
     */
    public function add(RuleWhatAddRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/rules/%d/what', $request->id),
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
