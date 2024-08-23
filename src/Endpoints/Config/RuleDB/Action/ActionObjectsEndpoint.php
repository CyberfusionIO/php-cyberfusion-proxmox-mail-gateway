<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB\Action;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDb\Action\ActionObject;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\Action\DeleteActionObjectRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class ActionObjectsEndpoint extends Endpoint
{
    /**
     * List 'actions' objects.
     *
     * @return Result
     */
    public function list(): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/ruledb/action/objects',
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $actionObjects = collect();
        foreach (Arr::get($data, 'data', []) as $item) {
            $actionObjects->push(new ActionObject(
                id: Arr::get($item, 'id'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'actionObjects' => $actionObjects,
            ],
        );
    }

    /**
     * Delete 'actions' object.
     *
     * @param DeleteActionObjectRequest $request
     * @return Result
     */
    public function delete(DeleteActionObjectRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/action/objects/%s', $request->id),
                method: 'DELETE',
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
