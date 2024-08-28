<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\AcmeCertIndexRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\RevokeCertRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\NewCertRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\RenewCertRequest;
use Cyberfusion\ProxmoxMGW\Models\Nodes\AcmeCertificate;
use Cyberfusion\ProxmoxMGW\Support\Result;

class AcmeCertificateEndpoint extends Endpoint
{
    /**
     * ACME Certificate index.
     *
     * @param AcmeCertIndexRequest $request
     * @return Result
     */
    public function index(AcmeCertIndexRequest $request): Result
    {
        // Implementation
    }

    /**
     * Revoke existing certificate from CA.
     *
     * @param RevokeCertRequest $request
     * @return Result
     */
    public function revoke(RevokeCertRequest $request): Result
    {
        // Implementation
    }

    /**
     * Order a new certificate from ACME-compatible CA.
     *
     * @param NewCertRequest $request
     * @return Result
     */
    public function new(NewCertRequest $request): Result
    {
        // Implementation
    }

    /**
     * Renew existing certificate from CA.
     *
     * @param RenewCertRequest $request
     * @return Result
     */
    public function renew(RenewCertRequest $request): Result
    {
        // Implementation
    }
}
