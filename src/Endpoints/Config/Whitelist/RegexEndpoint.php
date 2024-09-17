<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\Whitelist;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\Whitelist\Regex;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\RegexCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\RegexGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\RegexUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class RegexEndpoint extends Endpoint
{
    /**
     * Add 'Regular Expression' object.
     *
     * @param RegexCreateRequest $request
     * @return Result
     */
    public function create(RegexCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/whitelist/regex',
                method: 'POST',
                params: [
                    'regex' => $request->regex,
                ],
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
                'id' => $data,
            ],
        );
    }

    /**
     * Read 'Regular Expression' object settings.
     *
     * @param RegexGetRequest $request
     * @return Result
     */
    public function get(RegexGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/whitelist/regex/%d', $request->id),
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
                'regex' => new Regex(
                    id: Arr::get($data, 'id'),
                ),
            ],
        );
    }

    /**
     * Update 'Regular Expression' object.
     *
     * @param RegexUpdateRequest $request
     * @return Result
     */
    public function update(RegexUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/whitelist/regex/%d', $request->id),
                method: 'PUT',
                params: [
                    'regex' => $request->regex,
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
