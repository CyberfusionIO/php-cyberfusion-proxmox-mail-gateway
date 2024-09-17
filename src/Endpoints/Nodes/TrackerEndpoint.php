<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\ListMailsRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\MailLogRequest;
use Cyberfusion\ProxmoxMGW\Models\Nodes\Mail;
use Cyberfusion\ProxmoxMGW\Models\Nodes\MailLog;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class TrackerEndpoint extends Endpoint
{
    /**
     * Read mail list.
     *
     * @param ListMailsRequest $request
     * @return Result
     */
    public function listMails(ListMailsRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/tracker', $request->node),
                method: 'GET',
                params: $request->toArray(),
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR)['data'];
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $mails = collect();
        foreach ($data as $mail) {
            $mails->push(new Mail($mail['client'] ?? null, $mail['dstatus'], $mail['from'], $mail['id'], $mail['msgid'] ?? null, $mail['qid'] ?? null, $mail['relay'] ?? null, $mail['rstatus'] ?? null, $mail['size'] ?? null, $mail['time'], $mail['to']));
        }

        return new Result(
            success: true,
            data: [
                'mails' => $mails,
            ],
        );
    }

    /**
     * Get the detailed syslog entries for a specific mail ID.
     *
     * @param MailLogRequest $request
     * @return Result
     */
    public function getMailLog(MailLogRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/tracker/%s', $request->node, $request->id),
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

        return new Result(
            success: true,
            data: [
                'mailLog' => new MailLog($data),
            ],
        );
    }
}
