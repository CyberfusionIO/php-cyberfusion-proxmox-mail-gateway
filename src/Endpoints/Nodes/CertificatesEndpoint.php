<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Certificates\IndexRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;

class CertificatesEndpoint extends Endpoint
{
    /**
     * Node index.
     *
     * @param IndexRequest $request
     * @return Result
     */
    public function index(IndexRequest $request): Result
    {
        // Implementation
    }
}
