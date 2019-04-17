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
use YWatchman\ProxmoxMGW\Exceptions\AuthenticationException;

class Gateway
{
    
    /**
     * PMG hostname
     * @var string $hostname
     */
    public $hostname;
    
    /**
     * PMG username
     * @var string $username
     */
    private $username;
    
    /**
     * PMG Password
     * @var string $password
     */
    private $password;
    
    /**
     * Access request object for retrieving tokens etc.
     * @var \YWatchman\ProxmoxMGW\Requests\Access $access
     */
    private $access;
    
    /**
     * Authentication realm
     * @var string $realm
     */
    private $realm;
    
    /**
     * Login cookie from PMG
     * @var string $ticket
     */
    private $ticket = "";
    
    /**
     * Protection token retrieved from API
     * @var string $csrf
     */
    private $csrf = "";
    
    /**
     * Can be json or extjs
     * @var string $responseType
     */
    private $responseType = 'json';
    
    /**
     * @var \YWatchman\ProxmoxMGW\Requests\Gateway $client
     */
    private $client;
    
    /**
     * @var \GuzzleHttp\Client $httpClient
     */
    private $httpClient;
    
    public function __construct(string $hostname, string $username, string $password, string $realm = 'pam')
    {
        if ( empty($username) || empty($password) ) {
            // Throw exception if username or password is empty
            throw new AuthenticationException('Missing username or password', 401);
        }
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->realm = $realm;
        
        $this->client = $this;
        $this->httpClient = new Client([
            'defaults' => [
                'User-Agent' => 'Cyberfusion-PMG-PHP-v1.0'
            ]
        ]);
    }
    
    /**
     * Get ticket
     *
     * @author Yvan Watchman
     * @return string
     */
    public function getTicket()
    {
        return $this->ticket;
    }
    
    /**
     * Set ticket
     *
     * @author Yvan Watchman
     *
     * @param string $ticket
     */
    public function setTicket($ticket): void
    {
        $this->ticket = $ticket;
    }
    
    /**
     * @author Yvan Watchman
     * @return string
     *
     *
     */
    public function getCsrf()
    {
        return $this->csrf;
    }
    
    /**
     * @author Yvan Watchman
     *
     * @param string $csrf
     */
    public function setCsrf($csrf): void
    {
        $this->csrf = $csrf;
    }
    
    /**
     * @author Yvan Watchman
     * @return string
     */
    function getUsername()
    {
        return $this->username;
    }
    
    /**
     * @author Yvan Watchman
     * @return string
     */
    function getPassword()
    {
        return $this->password;
    }
    
    /**
     * @author Yvan Watchman
     * @return string
     */
    function getRealm()
    {
        return $this->realm;
    }
    
    /**
     * @author Yvan Watchman
     * @return \YWatchman\ProxmoxMGW\Requests\Access
     */
    public function getAccess()
    {
        // Set access and return it.
        return $this->access ?: ($this->access = new Access($this->client));
    }
    
    /**
     * @author Yvan Watchman
     *
     * @param        $res
     * @param string $method
     * @param array  $params
     *
     * @return \GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|null
     *
     *
     */
    public function makeRequest(string $res, string $method = 'GET', array $params = [])
    {
        // Get API url and append endpoint
        $url = $this->getApiUrl() . $res;
        
        // Initialise variables for later use
        $cookies = $headers = null;
        
        if ( $this->ticket !== null ) {
            
            $cookies = [
                'PMGAuthCookie' => $this->ticket // Authentication cookie for PMG
            ];
            
            $headers = ['CSRFPreventionToken' => $this->csrf];
        }
        
        $params = array_filter($params, function ($value) {
            return $value !== null;
        });
        
        switch ($method) {
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
    
    /**
     * @author Yvan Watchman
     * @return string
     */
    public function getApiUrl()
    {
        // All of our instances run on the default port, so no port variable required.
        return "https://{$this->hostname}:8006/api2/{$this->responseType}";
    }
    
}
