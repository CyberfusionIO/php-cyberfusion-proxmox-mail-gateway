<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes\Certificates;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Certificates\CustomCertificateIndexRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Certificates\RemoveCustomCertificateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Certificates\UploadCustomCertificateRequest;
use Cyberfusion\ProxmoxMGW\Models\Nodes\Certificates\CustomCertificate;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class CustomCertificateEndpoint extends Endpoint
{
    /**
     * Certificate index.
     *
     * @param CustomCertificateIndexRequest $request
     * @return Result
     */
    public function index(CustomCertificateIndexRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/certificates/custom', $request->node),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $customCertificates = collect();
        foreach (Arr::get($data, 'data', []) as $cert) {
            $customCertificates->push(new CustomCertificate(
                // Add properties as needed
            ));
        }

        return new Result(
            success: true,
            data: [
                'customCertificates' => $customCertificates,
            ],
        );
    }

    /**
     * DELETE custom certificate chain and key.
     *
     * @param RemoveCustomCertificateRequest $request
     * @return Result
     */
    public function remove(RemoveCustomCertificateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/certificates/custom/%s', $request->node, $request->type),
                method: 'DELETE',
                params: [
                    'restart' => $request->restart,
                ],
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
     * Upload or update custom certificate chain and key.
     *
     * @param UploadCustomCertificateRequest $request
     * @return Result
     */
    public function upload(UploadCustomCertificateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/certificates/custom/%s', $request->node, $request->type),
                method: 'POST',
                params: [
                    'certificates' => $request->certificates,
                    'force' => $request->force,
                    'key' => $request->key,
                    'restart' => $request->restart,
                ],
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $certificateInfo = new CertificateInfo(
            filename: Arr::get($data, 'filename'),
            fingerprint: Arr::get($data, 'fingerprint'),
            issuer: Arr::get($data, 'issuer'),
            notafter: Arr::get($data, 'notafter'),
            notbefore: Arr::get($data, 'notbefore'),
            pem: Arr::get($data, 'pem'),
            publicKeyBits: Arr::get($data, 'public-key-bits'),
            publicKeyType: Arr::get($data, 'public-key-type'),
            san: Arr::get($data, 'san', []),
            subject: Arr::get($data, 'subject'),
        );

        return new Result(
            success: true,
            data: [
                'certificateInfo' => $certificateInfo,
            ],
        );
    }
}
