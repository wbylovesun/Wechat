<?php
require_once 'autoload.php';

use Wechat\MultiMedia\Image;

$image = new Image();
$result = $image->setAccessToken($token)
                ->setMediaFile('C:\Users\Administrator\Desktop\0656e83446689714.jpg')
                ->upload();

if ($result === false) {
    echo $image->getErrCode();
} else print_r($result);