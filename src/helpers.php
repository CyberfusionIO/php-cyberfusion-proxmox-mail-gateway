<?php
/**
 * Created with PhpStorm.
 * Project: Management
 * Developer: Yvan Watchman from Cyberfusion
 * Date: 2019-04-17
 * Time: 15:17
 */

if( !function_exists('validateCidr') ) {
    function validateCidr($cidr) {
        $split = explode('/', $cidr);
        if(sizeof($cidr) != 2) {
            return false;
        }
        
        $addr = $split[0];
        $netmask = (integer) $split[1];
        
        if( $netmask < 0 || $netmask > 128) {
            return false;
        }
        
        if(filter_var($addr, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return $netmask <= 32;
        } elseif (filter_var($addr, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return $netmask <= 128;
        }
        
        return false;
        
    }
}
