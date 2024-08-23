<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB\Action;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDb\Action\Bcc;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\Action\BccGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\Action\BccUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class BccEndpoint extends Endpoint
{
    /**
     * Read 'BCC' object settings.
     *
     * @param BccGetRequest $request
     * @return Result
     */
    public function get(BccGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/action/bcc/%s', $request->id),
                method: 'GET',
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
                'bcc' => new Bcc(
                    id: Arr::get($data, 'id'),
                ),
            ],
        );
    }

    /**
     * Update 'BCC' object.
     *
     * @param BccUpdateRequest $request
     * @return Result
     */
    public function update(BccUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/action/bcc/%s', $request->id),
                method: 'PUT',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(success: true);
    }
}
