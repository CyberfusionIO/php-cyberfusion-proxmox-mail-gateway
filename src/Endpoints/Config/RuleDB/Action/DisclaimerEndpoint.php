<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB\Action;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\Action\Disclaimer;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Action\DisclaimerGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Action\DisclaimerUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class DisclaimerEndpoint extends Endpoint
{
    /**
     * Read 'Disclaimer' object settings.
     *
     * @param DisclaimerGetRequest $request
     * @return Result
     */
    public function get(DisclaimerGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/action/disclaimer/%s', $request->id),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'disclaimer' => new Disclaimer(
                    id: Arr::get($data, 'id'),
                    // Add other properties here
                ),
            ],
        );
    }

    /**
     * Update 'Disclaimer' object.
     *
     * @param DisclaimerUpdateRequest $request
     * @return Result
     */
    public function update(DisclaimerUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/action/disclaimer/%s', $request->id),
                method: 'PUT',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
