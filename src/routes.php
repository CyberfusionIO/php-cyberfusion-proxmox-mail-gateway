<?php
/**
 * Created with PhpStorm.
 * Project: Management
 * Developer: Yvan Watchman from Cyberfusion
 * Date: 2019-04-17
 * Time: 10:10
 */

use Illuminate\Support\Facades\Route;

Route::get('pmg', function () {
    return (new \YWatchman\ProxmoxMGW\Models\SMTPServer())->getSMTPServers();
});
