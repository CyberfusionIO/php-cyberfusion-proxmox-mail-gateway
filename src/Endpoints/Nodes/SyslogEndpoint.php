<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\SyslogRequest;
use Cyberfusion\ProxmoxMGW\Models\Nodes\SyslogEntry;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

/**
 * Class SyslogEndpoint
 *
 * This class handles operations related to reading the system log.
 */
class SyslogEndpoint extends Endpoint
{
    /**
     * Read system log.
     *
     * @param SyslogRequest $request The request object containing the node name and optional parameters.
     * @return Result The result object containing the syslog entries or error message.
     */
    public function get(SyslogRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/syslog', $request->node),
                method: 'GET',
                params: $request->toArray(),
            );

            $data = json_decode($response->getBody()->getContents(), true);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $syslogEntries = collect($data)->map(function ($entry) {
            return new SyslogEntry(
                n: $entry['n'],
                t: $entry['t'],
            );
        });

        return new Result(
            success: true,
            data: [
                'syslogEntries' => $syslogEntries,
            ],
        );
    }
}
