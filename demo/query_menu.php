<?php
require_once 'autoload.php';

use Wechat\Client\CustomMenu\CustomMenu;

$customMenu = new CustomMenu();
$result = $customMenu->setAccessToken($token)
                     ->query();

if ($result === false) {
    echo $customMenu->getErrCode();
} else {
    echo 'OK';
}