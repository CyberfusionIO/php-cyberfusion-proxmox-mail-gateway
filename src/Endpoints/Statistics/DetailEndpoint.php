<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Statistics;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\StatisticsDetail;
use Cyberfusion\ProxmoxMGW\Requests\StatisticsDetailRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class DetailEndpoint extends Endpoint
{
    public function get(StatisticsDetailRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/statistics/detail',
                method  : 'GET',
                params  : [
                    'address'   => $request->address,
                    'type'      => $request->type,
                    'day'       => $request->day,
                    'endtime'   => $request->endtime,
                    'filter'    => $request->filter,
                    'month'     => $request->month,
                    'orderby'   => $request->orderby,
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
            $statistics->push(new StatisticsDetail(
                blocked  : Arr::get($stat, 'blocked', false),
                bytes    : Arr::get($stat, 'bytes', 0),
                spamlevel: Arr::get($stat, 'spamlevel', 0.0),
                time     : Arr::get($stat, 'time', 0),
                receiver : Arr::get($stat, 'receiver'),
                sender   : Arr::get($stat, 'sender'),
                virusinfo: Arr::get($stat, 'virusinfo'),
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
