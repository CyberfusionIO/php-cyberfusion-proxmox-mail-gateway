<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\VirusFilter;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\ReadVirusFilterRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\UpdateVirusFilterRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class VirusFilterEndpoint extends Endpoint
{
    /**
     * Read 'Virus Filter' object settings.
     *
     * @param ReadVirusFilterRequest $request
     * @return Result
     */
    public function read(ReadVirusFilterRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/virusfilter/%d', $request->ogroup, $request->id),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'virusFilter' => new VirusFilter(
                    id: Arr::get($data, 'id'),
                ),
            ],
        );
    }

    /**
     * Update 'Virus Filter' object.
     *
     * @param UpdateVirusFilterRequest $request
     * @return Result
     */
    public function update(UpdateVirusFilterRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/virusfilter/%d', $request->ogroup, $request->id),
                method: 'PUT',
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
