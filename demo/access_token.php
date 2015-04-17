<?php
require_once 'autoload.php';

use Wechat\Client\AccessToken;

$appid  = 'wxfa9c93ac62407c3d';//'wxd4a2ca597951d628';
$secret = 'e81bfcbbcdb5784806cd85325b599bb6';//'f3dac1d31af1a8aa2305e75e77d6e54b';
$token = AccessToken::get($appid, $secret);

if ($token === false) {
    echo 'Failed to get AccessToken';
} else {
    echo $token;
}