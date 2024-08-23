<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB\Action;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Action\DisclaimerCreateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class DisclaimerEndpoint extends Endpoint
{
    /**
     * Create 'Disclaimer' object.
     *
     * @param DisclaimerCreateRequest $request
     * @return Result
     */
    public function create(DisclaimerCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/ruledb/action/disclaimer',
                method: 'POST',
                params: $request->toArray(),
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(
            success: true,
            data: [
                'id' => Arr::get($data, 'data'),
            ],
        );
    }
}
