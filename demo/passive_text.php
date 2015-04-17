<?php
require_once 'autoload.php';

use Wechat\Request\MessageFactory as Message;
use Wechat\Response\Passive\Text;

$message = Message::create();
$msgText = new Text();
$xml = $msgText->setMessageReceiver($message->getMessageTrigger())
        ->setMessageSender($message->getServiceProvider())
        ->setText('我们已收到您的位置，即将奔赴现场(' . $message->getLabel() . ')！')
        ->generateXml();
echo $xml;