<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes\Postfix;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Postfix\DeleteQueueRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Postfix\ListMailQueueRequest;
use Cyberfusion\ProxmoxMGW\Models\Nodes\Postfix\QueuedMail;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class QueueEndpoint extends Endpoint
{
    /**
     * Delete all mails in the queue.
     *
     * @param DeleteQueueRequest $request
     * @return Result
     */
    public function deleteQueue(DeleteQueueRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/postfix/queue/%s', $request->node, $request->queue),
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
     * List the mail queue for a specific domain.
     *
     * @param ListMailQueueRequest $request
     * @return Result
     */
    public function listMailQueue(ListMailQueueRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/postfix/queue/%s', $request->node, $request->queue),
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

        $queuedMails = collect();
        foreach (Arr::get($data, 'data', []) as $item) {
            $queuedMails->push(new QueuedMail(
                arrival_time: Arr::get($item, 'arrival_time'),
                message_size: Arr::get($item, 'message_size'),
                sender: Arr::get($item, 'sender'),
                receiver: Arr::get($item, 'receiver'),
                reason: Arr::get($item, 'reason'),
                queue_id: Arr::get($item, 'queue_id'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'queuedMails' => $queuedMails,
            ],
        );
    }
}
