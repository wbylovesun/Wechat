<?php
require_once 'autoload.php';

use Wechat\Request\MessageFactory as Message;
use Wechat\Response\Passive\Image;

$message = Message::create();
$msgImage = new Image();
$xml = $msgImage->setMessageReceiver($message->getMessageTrigger())
        ->setMessageSender($message->getServiceProvider())
        ->setMediaId('IYM_xL6p7i_VefxDVE8yk4bSLbvEUZTyQvFBR1uuJ6hnNOSNvCcaCTX8anJkidSy')
        ->generateXml();
echo $xml;