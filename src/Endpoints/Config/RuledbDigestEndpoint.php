<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

/**
 * Class RuledbDigestEndpoint
 *
 * This endpoint handles operations related to the rule database digest in the Proxmox Mail Gateway.
 */
class RuledbDigestEndpoint extends Endpoint
{
    /**
     * Get the rule database digest.
     *
     * This method is used internally for cluster synchronization.
     *
     * @return Result The result containing the rule database digest or error information.
     */
    public function get(): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/ruledb/digest',
                method: 'GET',
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
                'digest' => $data['data'],
            ],
        );
    }
}
