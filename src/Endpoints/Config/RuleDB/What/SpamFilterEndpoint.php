<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB\What;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\What\SpamFilter;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\What\SpamFilterGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\What\SpamFilterUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class SpamFilterEndpoint extends Endpoint
{
    /**
     * Read 'Spam Filter' object settings.
     *
     * @param SpamFilterGetRequest $request
     * @return Result
     */
    public function get(SpamFilterGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/spamfilter/%d', $request->ogroup, $request->id),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'spamFilter' => new SpamFilter(
                    id: Arr::get($data, 'id'),
                    spamlevel: Arr::get($data, 'spamlevel'),
                ),
            ],
        );
    }

    /**
     * Update 'Spam Filter' object.
     *
     * @param SpamFilterUpdateRequest $request
     * @return Result
     */
    public function update(SpamFilterUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/spamfilter/%d', $request->ogroup, $request->id),
                method: 'PUT',
                params: [
                    'spamlevel' => $request->spamlevel,
                ],
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
