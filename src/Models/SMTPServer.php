<?php

namespace YWatchman\ProxmoxMGW\Models;

use Illuminate\Database\Eloquent\Model;
use YWatchman\ProxmoxMGW\Requests\Config;
use YWatchman\ProxmoxMGW\Requests\Gateway;

class SMTPServer extends Model
{
    public $timestamps = true;
    protected $fillable = ['description', 'cidr'];
    protected $table = 'smtp_servers';
    
    /**
     * @var \YWatchman\ProxmoxMGW\Requests\Gateway $gateway
     */
    private $gateway;
    
    /**
     * SMTPServer constructor.
     *
     * @param string $hostname
     * @param string $username
     * @param string $password
     *
     * @throws \YWatchman\ProxmoxMGW\Exceptions\AuthenticationException
     */
    public function __construct(string $hostname, string $username, string $password)
    {
        parent::__construct();
        $this->gateway = new Gateway($hostname, $username, $password);
    }
    
    /**
     * Retrieve allowed servers (Networks)
     *
     * @author Yvan Watchman
     * @return mixed
     */
    public function getSMTPServers()
    {
        $this->getTicket();
        $servers = new Config($this->gateway);
        return json_decode($servers->getNetworks()->getBody())->data;
    }
    
    /**
     * Prepare authentication ticket
     *
     * @author Yvan Watchman
     * @return mixed
     */
    private function getTicket()
    {
        $ticket = json_decode($this->gateway->getAccess()->getTicket()->getBody())->data;
        $this->gateway->setCsrf($ticket->CSRFPreventionToken);
        $this->gateway->setTicket($ticket->ticket);
        return $ticket;
    }
    
    /**
     * Delete network from trusted networks
     *
     * @author Yvan Watchman
     *
     * @param $cidr
     * @return bool
     */
    public function deleteSMTPServer($cidr)
    {
        $this->getTicket();
        $config = new Config($this->gateway);
        if ( $config->delNetwork($cidr) ) {
            return true;
        }
        return false;
    }
}
