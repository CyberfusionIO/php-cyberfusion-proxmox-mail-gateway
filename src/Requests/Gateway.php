<?php
/**
 * Created with PhpStorm.
 * Project: Management
 * Developer: Yvan Watchman from Cyberfusion
 * Date: 2019-04-17
 * Time: 10:16
 */

namespace YWatchman\ProxmoxMGW\Requests;


use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

class Gateway
{
    
    public $hostname;
    private $username, $password, $access, $realm;
    
    private $ticket = null, $csrf = null;
    
    private $responseType = 'json';
    
    public function __construct(string $hostname, string $username, string $password, string $realm = 'pam')
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->realm = $realm;
        
        $this->client = $this;
        $this->httpClient = new Client();
    }
    
    /**
     * @return null
     */
    public function getTicket()
    {
        return $this->ticket;
    }
    
    /**
     * @param null $ticket
     */
    public function setTicket($ticket): void
    {
        $this->ticket = $ticket;
    }
    
    /**
     * @return null
     */
    public function getCsrf()
    {
        return $this->csrf;
    }
    
    /**
     * @param null $csrf
     */
    public function setCsrf($csrf): void
    {
        $this->csrf = $csrf;
    }
    
    function getUsername() {
        return $this->username;
    }
    
    function getPassword() {
        return $this->password;
    }
    
    function getRealm() {
        return $this->realm;
    }
    
    public function getAccess()
    {
        return $this->access ?: ($this->access = new Access($this->client));
    }
    
    public function getApiUrl()
    {
        return "https://{$this->hostname}:8006/api2/{$this->responseType}";
    }
    
    public function makeRequest($res, $method = 'GET', $params = [])
    {
        $url = $this->getApiUrl() . $res;
        $cookies = $headers = null;
        
        if ($this->ticket !== null) {
            $cookies = [
                'PMGAuthCookie' => $this->ticket
            ];
            $headers = ['CSRFPreventionToken' => $this->csrf];
        }
        
        $params = array_filter($params, function ($value) {
            return $value !== null;
        });
        
        switch($method) {
            case 'GET':
                return $this->httpClient->get($url, [
                    'verify' => false,
                    'exceptions' => false,
                    'cookies' => $cookies,
                    'headers' => $headers,
                    'query' => $params
                ]);
            case 'POST':
                return $this->httpClient->post($url, [
                    'verify' => false,
                    'exceptions' => false,
                    'cookies' => $cookies,
                    'headers' => $headers,
                    'body' => $params,
                ]);
            case 'PUT':
                return $this->httpClient->put($url, [
                    'verify' => false,
                    'exceptions' => false,
                    'cookies' => $cookies,
                    'headers' => $headers,
                    'body' => $params
                ]);
            case 'DELETE':
                return $this->httpClient->delete($url, [
                    'verify' => false,
                    'exceptions' => false,
                    'cookies' => $cookies,
                    'headers' => $headers,
                    'body' => $params
                ]);
        }
    }
    
}
