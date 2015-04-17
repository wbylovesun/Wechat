<?php
require_once 'autoload.php';

use Wechat\Client\OpenUser\OpenUser;

$openuser = new OpenUser();
$follower = $openuser->setAccessToken($token)
                     ->getlist();

if ($follower === false) {
    echo 'Failed to fetch groups from server';
} else {
    print_r($follower);
}