<?php
require_once 'autoload.php';

use Wechat\Response\Active\Image;

$image = new Image();
$result = $image->setAccessToken($token)
                ->setMediaId('IYM_xL6p7i_VefxDVE8yk4bSLbvEUZTyQvFBR1uuJ6hnNOSNvCcaCTX8anJkidSy')
                ->setMessageReceiver($open_id)
                ->sendRequest();
echo $result ? 'OK' : $image->getErrCode();