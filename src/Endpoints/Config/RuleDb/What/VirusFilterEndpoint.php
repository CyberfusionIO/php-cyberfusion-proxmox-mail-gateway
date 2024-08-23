<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDb\What;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\What\VirusFilterCreateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class VirusFilterEndpoint extends Endpoint
{
    /**
     * Add 'Virus Filter' object.
     *
     * @param VirusFilterCreateRequest $request
     * @return Result
     */
    public function create(VirusFilterCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/virusfilter', $request->ogroup),
                method: 'POST',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['id' => Arr::get($data, 'data')]);
    }
}
