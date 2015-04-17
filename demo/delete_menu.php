<?php
require_once 'autoload.php';

use Wechat\Client\CustomMenu\CustomMenu;

$customMenu = new CustomMenu();
$result = $customMenu->setAccessToken($token)
                     ->delete();

if ($result === false) {
    echo $customMenu->getErrCode();
} else {
    echo 'OK';
}