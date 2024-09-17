<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Nodes\Subscription;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\SubscriptionDeleteRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\SubscriptionGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\SubscriptionUpdateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\SubscriptionSetRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class SubscriptionEndpoint extends Endpoint
{
    /**
     * Delete subscription key.
     *
     * @param SubscriptionDeleteRequest $request
     * @return Result
     */
    public function delete(SubscriptionDeleteRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/subscription', $request->node),
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

    /**
     * Read subscription info.
     *
     * @param SubscriptionGetRequest $request
     * @return Result
     */
    public function get(SubscriptionGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/subscription', $request->node),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true);
            $subscription = new Subscription($data);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(
            success: true,
            data: ['subscription' => $subscription],
        );
    }

    /**
     * Update subscription info.
     *
     * @param SubscriptionUpdateRequest $request
     * @return Result
     */
    public function update(SubscriptionUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/subscription', $request->node),
                method: 'POST',
                params: ['force' => $request->force],
            );
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(success: true);
    }

    /**
     * Set subscription key.
     *
     * @param SubscriptionSetRequest $request
     * @return Result
     */
    public function set(SubscriptionSetRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/subscription', $request->node),
                method: 'PUT',
                params: ['key' => $request->key],
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
