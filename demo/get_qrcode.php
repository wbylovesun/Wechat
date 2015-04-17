<?php
require_once 'autoload.php';

use Wechat\Client\QrCode;

$qrcode = new QrCode();
$result = $qrcode->getQrCodeImage('gQGQ8DoAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xL3BYV01DSFRsWTFjYTBHX0ZTVnZyAAIEJyOgUgMECAcAAA==', 'E:\\');

if ($result === false) {
    echo $image->getErrCode();
} else print_r($result);