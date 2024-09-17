<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB\Who;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who\ObjectDeleteRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class ObjectEndpoint extends Endpoint
{
    /**
     * Remove an object from the 'who' group.
     *
     * @param ObjectDeleteRequest $request
     * @return Result
     */
    public function delete(ObjectDeleteRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/who/%d/objects/%d', $request->ogroup, $request->id),
                method: 'DELETE',
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
