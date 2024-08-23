<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Quarantine;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\QuarantineSpamStatus;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class QuarantineSpamStatusEndpoint extends Endpoint
{
    /**
     * Get Spam Quarantine Status
     *
     * @return Result
     */
    public function getStatus(): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/quarantine/spamstatus',
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $spamStatus = new QuarantineSpamStatus(
            avgbytes: Arr::get($data, 'avgbytes'),
            avgspam: Arr::get($data, 'avgspam'),
            count: Arr::get($data, 'count'),
            mbytes: Arr::get($data, 'mbytes'),
        );

        return new Result(
            success: true,
            data: [
                'spamStatus' => $spamStatus,
            ],
        );
    }
}
