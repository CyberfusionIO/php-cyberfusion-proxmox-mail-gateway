<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\Ruledb\ActionGroup;
use Cyberfusion\ProxmoxMGW\Requests\Config\Ruledb\AddActionGroupRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Ruledb\DeleteActionGroupRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Ruledb\DeleteWhatGroupRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Ruledb\GetActionRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class RuledbRulesEndpoint extends Endpoint
{
    /**
     * Delete group from 'what' list.
     *
     * @param DeleteWhatGroupRequest $request
     * @return Result
     */
    public function deleteWhatGroup(DeleteWhatGroupRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/rules/%d/what/%d', $request->id, $request->ogroup),
                method: 'DELETE',
            );
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(success: true);
    }

    /**
     * Get 'action' group list.
     *
     * @param GetActionRequest $request
     * @return Result
     */
    public function getAction(GetActionRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/rules/%d/action', $request->id),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $actionGroups = collect();
        foreach (Arr::get($data, 'data', []) as $group) {
            $actionGroups->push(new ActionGroup(
                id: Arr::get($group, 'id'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'actionGroups' => $actionGroups,
            ],
        );
    }

    /**
     * Add group to 'action' list.
     *
     * @param AddActionGroupRequest $request
     * @return Result
     */
    public function addActionGroup(AddActionGroupRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/rules/%d/action', $request->id),
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

    /**
     * Delete group from 'action' list.
     *
     * @param DeleteActionGroupRequest $request
     * @return Result
     */
    public function deleteActionGroup(DeleteActionGroupRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/rules/%d/action/%d', $request->id, $request->ogroup),
                method: 'DELETE',
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
