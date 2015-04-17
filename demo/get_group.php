<?php
require_once 'autoload.php';

use Wechat\Client\OpenUser\Group;

$group = new Group();
$groups = $group->setAccessToken($token)
                ->get();

if ($groups === false) {
    echo 'Failed to fetch groups from server';
} else {
    print_r($groups);
}