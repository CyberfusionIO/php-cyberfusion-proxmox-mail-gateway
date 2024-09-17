<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes\Postfix;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Postfix\FlushQueuesRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class FlushQueuesEndpoint extends Endpoint
{
    /**
     * Flush the queue: attempt to deliver all queued mail.
     *
     * @param FlushQueuesRequest $request
     * @return Result
     */
    public function flushQueues(FlushQueuesRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/postfix/flush_queues', $request->node),
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
