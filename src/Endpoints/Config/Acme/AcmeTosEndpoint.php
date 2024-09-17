<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\Acme;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Config\Acme\AcmeTosGetRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

/**
 * Class AcmeTosEndpoint
 *
 * Endpoint for retrieving ACME TermsOfService URL from CA.
 */
class AcmeTosEndpoint extends Endpoint
{
    /**
     * Retrieve ACME TermsOfService URL from CA.
     *
     * @param AcmeTosGetRequest $request
     * @return Result
     */
    public function get(AcmeTosGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/acme/tos',
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
                'termsOfService' => $data['data'],
            ],
        );
    }
}
