<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\RuleFromGroupDeleteRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

/**
 * Class RuleFromGroupDeleteEndpoint
 *
 * This class handles the deletion of a group from the 'from' list of a rule in the Proxmox Mail Gateway.
 */
class RuleFromGroupDeleteEndpoint extends Endpoint
{
    /**
     * Delete group from 'from' list.
     *
     * @param RuleFromGroupDeleteRequest $request The request object containing the rule ID and group ID.
     * @return Result The result of the delete operation.
     */
    public function delete(RuleFromGroupDeleteRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/rules/%d/from/%d', $request->id, $request->ogroup),
                method: 'DELETE',
            );
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(success: true);
    }
}
