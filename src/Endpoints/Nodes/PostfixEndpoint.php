<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\DiscardVerifyCacheRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class PostfixEndpoint extends Endpoint
{
    /**
     * Discards the address verification cache.
     *
     * @param DiscardVerifyCacheRequest $request
     * @return Result
     */
    public function discardVerifyCache(DiscardVerifyCacheRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: "/nodes/{$request->node}/postfix/discard_verify_cache",
                method: 'POST',
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
