<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\Ldap;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\LdapGroupMember;
use Cyberfusion\ProxmoxMGW\Requests\LdapGroupMembersListRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class LdapGroupMembersEndpoint extends Endpoint
{
    /**
     * List LDAP group members.
     *
     * @param LdapGroupMembersListRequest $request
     * @return Result
     */
    public function list(LdapGroupMembersListRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ldap/%s/groups/%d', $request->profile, $request->gid),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $members = collect();
        foreach (Arr::get($data, 'data', []) as $member) {
            $members->push(new LdapGroupMember(
                account: Arr::get($member, 'account'),
                dn: Arr::get($member, 'dn'),
                pmail: Arr::get($member, 'pmail'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'members' => $members,
            ],
        );
    }
}
