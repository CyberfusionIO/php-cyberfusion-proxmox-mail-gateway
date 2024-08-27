<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Nodes\QshapeResult;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\PostfixQshapeRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class PostfixEndpoint extends Endpoint
{
    /**
     * Print Postfix queue domain and age distribution.
     *
     * @param PostfixQshapeRequest $request
     * @return Result
     */
    public function qshape(PostfixQshapeRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: "/nodes/{$request->node}/postfix/qshape",
                method: 'GET',
                params: $request->toArray(),
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $qshapeResults = collect();
        foreach (Arr::get($data, 'data', []) as $resultData) {
            $qshapeResults->push(new QshapeResult($resultData));
        }

        return new Result(
            success: true,
            data: [
                'qshapeResults' => $qshapeResults,
            ],
        );
    }
}
