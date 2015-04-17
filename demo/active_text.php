<?php
require_once 'autoload.php';

use Wechat\Response\Active\Text;


$text = new Text();
$token = '';
$result = $text->setAccessToken($token)
               ->setContent('要推送的客服消息，只能针对客户做针对性消息发送！nimei')
               ->setMessageReceiver($open_id)  // 消息接收者OpenID
               ->sendRequest();
echo $result ? 'OK' : $text->getErrCode();