<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Statistics;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\RejectCountStatistics;
use Cyberfusion\ProxmoxMGW\Requests\RejectCountRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

/**
 * Endpoint for fetching early SMTP reject count statistics.
 */
class RejectCountEndpoint extends Endpoint
{
    /**
     * Get early SMTP reject count statistics.
     *
     * @param RejectCountRequest $request
     *
     * @return Result
     */
    public function get(RejectCountRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/statistics/rejectcount',
                method  : 'GET',
                params  : [
                    'day'       => $request->day,
                    'endtime'   => $request->endtime,
                    'month'     => $request->month,
                    'starttime' => $request->starttime,
                    'timespan'  => $request->timespan,
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
            $statistics->push(new RejectCountStatistics(
                index           : Arr::get($stat, 'index', 0),
                pregreet_rejects: Arr::get($stat, 'pregreet_rejects', 0),
                rbl_rejects     : Arr::get($stat, 'rbl_rejects', 0),
                time            : Arr::get($stat, 'time', 0),
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
