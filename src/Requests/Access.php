<?php
/**
 * Created with PhpStorm.
 * Project: Management
 * Developer: Yvan Watchman from Cyberfusion
 * Date: 2019-04-17
 * Time: 10:19
 */

namespace YWatchman\ProxmoxMGW\Requests;


class Access
{
    
    private $client;
    
    public function __construct(Gateway $client)
    {
        $this->client = $client;
    }
    
    public function getTicket()
    {
        $ticket = $this->client->makeRequest('/access/ticket', 'POST', [
            'username' => $this->client->getUsername(),
            'password' => $this->client->getPassword(),
            'realm' => $this->client->getRealm()
        ]);
        return $ticket;
    }
    
}
