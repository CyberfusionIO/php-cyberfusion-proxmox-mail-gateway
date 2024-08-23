<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Statistics;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\DomainStatistics;
use Cyberfusion\ProxmoxMGW\Requests\DomainsRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

/**
 * Endpoint for fetching mail domains statistics.
 */
class DomainsEndpoint extends Endpoint
{
    /**
     * Get mail domains statistics.
     *
     * @param DomainsRequest $request
     *
     * @return Result
     */
    public function get(DomainsRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/statistics/domains',
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
            $statistics->push(new DomainStatistics(
                bytes_in      : Arr::get($stat, 'bytes_in', 0),
                bytes_out     : Arr::get($stat, 'bytes_out', 0),
                count_in      : Arr::get($stat, 'count_in', 0),
                count_out     : Arr::get($stat, 'count_out', 0),
                domain        : Arr::get($stat, 'domain', ''),
                spamcount_in  : Arr::get($stat, 'spamcount_in', 0),
                spamcount_out : Arr::get($stat, 'spamcount_out', 0),
                viruscount_in : Arr::get($stat, 'viruscount_in', 0),
                viruscount_out: Arr::get($stat, 'viruscount_out', 0),
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
