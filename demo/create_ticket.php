<?php
require_once 'autoload.php';

use Wechat\Client\QrCode;

$qrcode = new QrCode();
$result = $qrcode->setAccessToken($token)
                 ->createTemporaryTicket(1);

if ($result === false) {
    echo $image->getErrCode();
} else print_r($result);