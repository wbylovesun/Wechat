<?php
require_once 'autoload.php';

use Wechat\Wechat;
use Wechat\Response\Passive\Text;

$wechat = new Wechat();
//$wechat->getHandler()->setMessageHandlerMapper([
//    'text' => 'handleText',
//]);
$wechat->handle();

function handleText($request)
{
    /* @var $request Wechat\Request\Message\Text */
    $content = $request->getContent();
    
    // select response text from database where content = content
    $response = 'Hello';
    
    // Send passive text response
    $textResp = new Text();
    echo $textResp->setMessageReceiver($request->getMessageTrigger())
                  ->setMessageSender($request->getServiceProvider())
                  ->setContent($response)
                  ->generateXml();
}