<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\Rule;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\CreateRuleRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class RuleDBRulesEndpoint extends Endpoint
{
    /**
     * Get list of rules.
     *
     * @return Result
     */
    public function list(): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/ruledb/rules',
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $rules = collect();
        foreach (Arr::get($data, 'data', []) as $rule) {
            $rules->push(new Rule(
                id: Arr::get($rule, 'id'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'rules' => $rules,
            ],
        );
    }

    /**
     * Create new rule.
     *
     * @param CreateRuleRequest $request
     * @return Result
     */
    public function create(CreateRuleRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/ruledb/rules',
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
