<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB\When;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\When\Timeframe;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\When\TimeframeCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\When\TimeframeDeleteRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\When\TimeframeGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\When\TimeframeUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class TimeframeEndpoint extends Endpoint
{
    /**
     * Add 'TimeFrame' object.
     *
     * @param TimeframeCreateRequest $request
     * @return Result
     */
    public function create(TimeframeCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/when/%d/timeframe', $request->ogroup),
                method: 'POST',
                params: [
                    'start' => $request->start,
                    'end' => $request->end,
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
                'id' => Arr::get($data, 'data'),
            ],
        );
    }

    /**
     * Read 'TimeFrame' object settings.
     *
     * @param TimeframeGetRequest $request
     * @return Result
     */
    public function get(TimeframeGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/when/%d/timeframe/%d', $request->ogroup, $request->id),
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
                'timeframe' => new Timeframe(
                    id: Arr::get($data, 'data.id'),
                    start: Arr::get($data, 'data.start'),
                    end: Arr::get($data, 'data.end'),
                ),
            ],
        );
    }

    /**
     * Update 'TimeFrame' object.
     *
     * @param TimeframeUpdateRequest $request
     * @return Result
     */
    public function update(TimeframeUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/when/%d/timeframe/%d', $request->ogroup, $request->id),
                method: 'PUT',
                params: [
                    'start' => $request->start,
                    'end' => $request->end,
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
     * Remove an object from the 'when' group.
     *
     * @param TimeframeDeleteRequest $request
     * @return Result
     */
    public function delete(TimeframeDeleteRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/when/%d/objects/%d', $request->ogroup, $request->id),
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
