<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\Ldap;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\LdapGroup;
use Cyberfusion\ProxmoxMGW\Requests\LdapGroupsListRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class LdapGroupsEndpoint extends Endpoint
{
    /**
     * List LDAP groups.
     *
     * @param LdapGroupsListRequest $request
     * @return Result
     */
    public function list(LdapGroupsListRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ldap/%s/groups', $request->profile),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $groups = collect();
        foreach (Arr::get($data, 'data', []) as $group) {
            $groups->push(new LdapGroup(
                dn: Arr::get($group, 'dn'),
                gid: Arr::get($group, 'gid'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'groups' => $groups,
            ],
        );
    }
}
