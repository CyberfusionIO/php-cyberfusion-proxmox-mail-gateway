<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Statistics;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\ContactStatistics;
use Cyberfusion\ProxmoxMGW\Requests\ContactRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class ContactEndpoint extends Endpoint
{
    public function get(ContactRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/statistics/contact',
                method  : 'GET',
                params  : [
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
            $statistics->push(new ContactStatistics(
                bytes     : Arr::get($stat, 'bytes', 0),
                contact   : Arr::get($stat, 'contact', ''),
                count     : Arr::get($stat, 'count'),
                viruscount: Arr::get($stat, 'viruscount'),
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
