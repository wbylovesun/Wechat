<?php
require_once 'autoload.php';

use Wechat\Client\Json;

echo Json::encode(
    array('button' => array(array('name' => '菜单', 'type' => 'click')))
);