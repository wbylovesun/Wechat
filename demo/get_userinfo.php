<?php
require_once 'autoload.php';

use Wechat\Client\OpenUser\OpenUser;

$openuser = new OpenUser();
$uesrinfo = $openuser->setAccessToken($token)
                     ->getinfo($open_id);

if ($uesrinfo === false) {
    echo 'Failed to fetch groups from server';
} else {
    print_r($uesrinfo);
}