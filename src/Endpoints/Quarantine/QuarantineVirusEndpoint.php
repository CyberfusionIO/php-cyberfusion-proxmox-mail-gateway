<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Quarantine;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\QuarantineVirusMail;
use Cyberfusion\ProxmoxMGW\Requests\QuarantineVirusRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class QuarantineVirusEndpoint extends Endpoint
{
    /**
     * Get a list of quarantined virus mails in the given timeframe.
     *
     * @param QuarantineVirusRequest $request
     * @return Result
     */
    public function getVirusMails(QuarantineVirusRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/quarantine/virus',
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

        $virusMails = collect();
        foreach ($data as $item) {
            $virusMails->push(new QuarantineVirusMail(
                bytes: Arr::get($item, 'bytes'),
                envelope_sender: Arr::get($item, 'envelope_sender'),
                from: Arr::get($item, 'from'),
                id: Arr::get($item, 'id'),
                receiver: Arr::get($item, 'receiver'),
                sender: Arr::get($item, 'sender'),
                subject: Arr::get($item, 'subject'),
                time: Arr::get($item, 'time'),
                virusname: Arr::get($item, 'virusname'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'virusMails' => $virusMails,
            ],
        );
    }
}
