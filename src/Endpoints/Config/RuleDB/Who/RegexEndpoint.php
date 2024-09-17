<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB\Who;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\Who\Regex;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who\RegexCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who\RegexGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who\RegexUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class RegexEndpoint extends Endpoint
{
    /**
     * Read 'Regular Expression' object settings.
     *
     * @param RegexGetRequest $request
     *
     * @return Result
     */
    public function get(RegexGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/who/%d/regex/%d', $request->ogroup, $request->id),
                method  : 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data   : [
                'regex' => new Regex(
                    id   : Arr::get($data, 'id'),
                    regex: Arr::get($data, 'regex'),
                ),
            ],
        );
    }

    /**
     * Update 'Regular Expression' object.
     *
     * @param RegexUpdateRequest $request
     *
     * @return Result
     */
    public function update(RegexUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/who/%d/regex/%d', $request->ogroup, $request->id),
                method  : 'PUT',
                params  : [
                    'regex' => $request->regex,
                ],
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }

    /**
     * Add 'Regular Expression' object.
     *
     * @param RegexCreateRequest $request
     *
     * @return Result
     */
    public function create(RegexCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/who/%d/regex', $request->ogroup),
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
}
