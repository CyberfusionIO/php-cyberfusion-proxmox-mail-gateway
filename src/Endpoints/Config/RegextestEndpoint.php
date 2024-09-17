<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Config\RegextestRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class RegextestEndpoint extends Endpoint
{
    /**
     * Test Regex ignoring case
     *
     * @param RegextestRequest $request
     * @return Result
     */
    public function test(RegextestRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/regextest',
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
                'result' => $data['data'],
            ],
        );
    }
}
