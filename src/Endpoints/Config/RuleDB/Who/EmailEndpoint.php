<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB\Who;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDb\Who\EmailObject;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\Who\EmailCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\Who\EmailGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\Who\EmailUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class EmailEndpoint extends Endpoint
{
    /**
     * Add 'Mail address' object.
     *
     * @param EmailCreateRequest $request
     * @return Result
     */
    public function create(EmailCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/who/%d/email', $request->ogroup),
                method: 'POST',
                params: $request->toArray(),
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['id' => $data['data']]);
    }

    /**
     * Read 'Mail address' object settings.
     *
     * @param EmailGetRequest $request
     * @return Result
     */
    public function get(EmailGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/who/%d/email/%d', $request->ogroup, $request->id),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'emailObject' => new EmailObject(
                    id: Arr::get($data, 'data.id'),
                    email: Arr::get($data, 'data.email'),
                ),
            ],
        );
    }

    /**
     * Update 'Mail address' object.
     *
     * @param EmailUpdateRequest $request
     * @return Result
     */
    public function update(EmailUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/who/%d/email/%d', $request->ogroup, $request->id),
                method: 'PUT',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
