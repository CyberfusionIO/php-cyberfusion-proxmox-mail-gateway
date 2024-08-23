<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDb\Action;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\Action\CreateBccActionRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class ActionBccEndpoint extends Endpoint
{
    /**
     * Create 'BCC' object.
     *
     * @param CreateBccActionRequest $request
     * @return Result
     */
    public function create(CreateBccActionRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/ruledb/action/bcc',
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
                'id' => $data['data'],
            ],
        );
    }
}
