<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes;

class Subscription
{
    public function __construct(array $data)
    {
        // Map subscription data to properties
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
