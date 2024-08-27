<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\Ldap;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Config\Ldap\LdapProfileSyncRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Ldap\LdapProfileListUsersRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Ldap\LdapProfileAddressListRequest;
use Cyberfusion\ProxmoxMGW\Models\Config\Ldap\LdapUser;
use Cyberfusion\ProxmoxMGW\Models\Config\Ldap\LdapUserEmail;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class LdapProfileEndpoint extends Endpoint
{
    /**
     * Synchronize LDAP users to local database.
     *
     * @param LdapProfileSyncRequest $request
     * @return Result
     */
    public function sync(LdapProfileSyncRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ldap/%s/sync', $request->profile),
                method: 'POST',
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
     * List LDAP users.
     *
     * @param LdapProfileListUsersRequest $request
     * @return Result
     */
    public function listUsers(LdapProfileListUsersRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ldap/%s/users', $request->profile),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $users = collect();
        foreach (Arr::get($data, 'data', []) as $userData) {
            $users->push(new LdapUser(
                account: Arr::get($userData, 'account'),
                dn: Arr::get($userData, 'dn'),
                pmail: Arr::get($userData, 'pmail'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'users' => $users,
            ],
        );
    }

    /**
     * Get all email addresses for the specified user.
     *
     * @param LdapProfileAddressListRequest $request
     * @return Result
     */
    public function getAddressList(LdapProfileAddressListRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ldap/%s/users/%s', $request->profile, $request->email),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $emails = collect();
        foreach (Arr::get($data, 'data', []) as $emailData) {
            $emails->push(new LdapUserEmail(
                email: Arr::get($emailData, 'email'),
                primary: Arr::get($emailData, 'primary'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'emails' => $emails,
            ],
        );
    }
}
