<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes\Certificates;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Certificates\CertificateInfoRequest;
use Cyberfusion\ProxmoxMGW\Models\Nodes\Certificates\CertificateInfo;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class CertificateInfoEndpoint extends Endpoint
{
    /**
     * Get information about the node's certificates.
     *
     * @param CertificateInfoRequest $request
     * @return Result
     */
    public function get(CertificateInfoRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/certificates/info', $request->node),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $certificateInfos = collect();
        foreach (Arr::get($data, 'data', []) as $certInfo) {
            $certificateInfos->push(new CertificateInfo(
                filename: Arr::get($certInfo, 'filename'),
                fingerprint: Arr::get($certInfo, 'fingerprint'),
                issuer: Arr::get($certInfo, 'issuer'),
                notafter: Arr::get($certInfo, 'notafter'),
                notbefore: Arr::get($certInfo, 'notbefore'),
                pem: Arr::get($certInfo, 'pem'),
                publicKeyBits: Arr::get($certInfo, 'public-key-bits'),
                publicKeyType: Arr::get($certInfo, 'public-key-type'),
                san: Arr::get($certInfo, 'san', []),
                subject: Arr::get($certInfo, 'subject'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'certificateInfos' => $certificateInfos,
            ],
        );
    }
}
