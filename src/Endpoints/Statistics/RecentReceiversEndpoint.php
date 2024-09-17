<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Statistics;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\RecentReceiverStatistics;
use Cyberfusion\ProxmoxMGW\Requests\RecentReceiversRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

/**
 * Endpoint for fetching top recent mail receivers statistics.
 */
class RecentReceiversEndpoint extends Endpoint
{
    /**
     * Get top recent mail receivers statistics.
     *
     * @param RecentReceiversRequest $request
     *
     * @return Result
     */
    public function get(RecentReceiversRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/statistics/recentreceivers',
                method  : 'GET',
                params  : [
                    'hours' => $request->hours,
                    'limit' => $request->limit,
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
            $statistics->push(new RecentReceiverStatistics(
                count   : Arr::get($stat, 'count', 0),
                receiver: Arr::get($stat, 'receiver', ''),
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
