<?php
require_once 'autoload.php';

use Wechat\Request\MessageFactory as Message;
use Wechat\Response\Passive\Text;

$message = Message::create();
$msgText = new Text();
$xml = $msgText->setMessageReceiver($message->getMessageTrigger())
        ->setMessageSender($message->getServiceProvider())
        ->setText('�������յ�����λ�ã����������ֳ�(' . $message->getLabel() . ')��')
        ->generateXml();
echo $xml;