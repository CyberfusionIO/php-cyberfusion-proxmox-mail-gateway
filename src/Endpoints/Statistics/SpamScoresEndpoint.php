<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Statistics;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\SpamScoreStatistics;
use Cyberfusion\ProxmoxMGW\Requests\SpamScoresRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

/**
 * Endpoint for fetching spam scores statistics.
 */
class SpamScoresEndpoint extends Endpoint
{
    /**
     * Get spam scores statistics.
     *
     * @param SpamScoresRequest $request
     *
     * @return Result
     */
    public function get(SpamScoresRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/statistics/spamscores',
                method  : 'GET',
                params  : [
                    'day'       => $request->day,
                    'endtime'   => $request->endtime,
                    'month'     => $request->month,
                    'starttime' => $request->starttime,
                    'year'      => $request->year,
                ],
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $statistics = collect();
        foreach (Arr::get($data, 'data', []) as $stat) {
            $statistics->push(new SpamScoreStatistics(
                count: Arr::get($stat, 'count', 0),
                level: Arr::get($stat, 'level', ''),
                ratio: Arr::get($stat, 'ratio', 0.0),
            ));
        }

        return new Result(
            success: true,
            data   : [
                'statistics' => $statistics,
            ],
        );
    }
}
