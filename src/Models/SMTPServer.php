<?php

namespace YWatchman\ProxmoxMGW\Models;

use Illuminate\Database\Eloquent\Model;
use YWatchman\ProxmoxMGW\Requests\Config;
use YWatchman\ProxmoxMGW\Requests\Gateway;

class SMTPServer extends Model
{
    protected $fillable = ['description', 'cidr'];
    protected $table = 'smtp_servers';
    
    public $timestamps = true;
    
    public function __construct()
    {
        parent::__construct();
        $this->gateway = new Gateway('testinboundpmg.cyberfusion.nl', 'root', 'Lekker gezellig mailen');
    }
    
    public function getSMTPServers() {
        $this->getTicket();
        $servers = new Config($this->gateway);
        return json_decode($servers->getNetworks()->getBody())->data;
    }
    
    public function deleteSMTPServer($cidr)
    {
        $this->getTicket();
        $config = new Config($this->gateway);
        if($config->delNetwork($cidr)) {
            return true;
        }
        return false;
    }
    
    private function getTicket()
    {
        $ticket = json_decode($this->gateway->getAccess()->getTicket()->getBody())->data;
        $this->gateway->setCsrf($ticket->CSRFPreventionToken);
        $this->gateway->setTicket($ticket->ticket);
        return $ticket;
    }
}
