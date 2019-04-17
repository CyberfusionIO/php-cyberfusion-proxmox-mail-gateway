<?php
/**
 * Created with PhpStorm.
 * Project: Management
 * Developer: Yvan Watchman from Cyberfusion
 * Date: 2019-04-17
 * Time: 11:40
 */

namespace YWatchman\ProxmoxMGW\Requests;


use Exception;

class Config
{
    private $client;
    
    public function __construct(Gateway $client)
    {
        $this->client = $client;
    }
    
    public function getNetworks()
    {
        $networks = $this->client->makeRequest('/config/mynetworks');
        return $networks;
    }
    
    public function delNetwork($cidr)
    {
        try{
            $this->client->makeRequest('/config/mynetworks/' . $cidr, 'DELETE');
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
    
}
