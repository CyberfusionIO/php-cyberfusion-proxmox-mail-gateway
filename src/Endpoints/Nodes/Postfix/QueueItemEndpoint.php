<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes\Postfix;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Postfix\DeleteQueuedMailRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Postfix\ReadQueuedMailRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Postfix\FlushQueuedMailRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class QueueItemEndpoint extends Endpoint
{
    /**
     * Delete one message with the named queue ID.
     *
     * @param DeleteQueuedMailRequest $request
     * @return Result
     */
    public function deleteQueuedMail(DeleteQueuedMailRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/postfix/queue/%s/%s', $request->node, $request->queue, $request->queue_id),
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
     * Get the contents of a queued mail.
     *
     * @param ReadQueuedMailRequest $request
     * @return Result
     */
    public function readQueuedMail(ReadQueuedMailRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/postfix/queue/%s/%s', $request->node, $request->queue, $request->queue_id),
                method: 'GET',
                params: $request->toArray(),
            );

            $content = $response->getBody()->getContents();
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(
            success: true,
            data: [
                'content' => $content,
            ],
        );
    }

    /**
     * Schedule immediate delivery of deferred mail with the specified queue ID.
     *
     * @param FlushQueuedMailRequest $request
     * @return Result
     */
    public function flushQueuedMail(FlushQueuedMailRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/postfix/queue/%s/%s', $request->node, $request->queue, $request->queue_id),
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
