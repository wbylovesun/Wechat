<?php
require_once 'Wechat/Autoload.php';

use Wechat\Request\MessageFactory as Message;
use Wechat\Request\Event\CustomMenu;
use Wechat\Request\Event\Geo;
use Wechat\Request\Event\QrScene;
use Wechat\Request\Event\Scan;
use Wechat\Request\Event\Subscribe;
use Wechat\Request\Event\Unsubscribe;
use Wechat\Request\Message\Location;
use Wechat\Response\Passive\Text;
use Wechat\Response\Passive\Image;
use Wechat\Response\Passive\Voice;
use Wechat\Response\Passive\Music;
use Wechat\Response\Passive\Video;
use Wechat\Response\Passive\News;
use Wechat\Response\Passive\NewsItem;

use Wechat\MultiMedia\Voice as MMVoice;

$message = Message::create();
file_put_contents("./logs/run.log", $message->getEventXml() . "\n", FILE_APPEND);
if ($message instanceof CustomMenu) {
    // 自定义菜单事件响应
    // $message->getEventKey()为自定义菜单中定义的key值，由click事件触发
    if ($message->getEventKey() == 'V_GOOD') {
        $msgText = new Text();
        $xml = $msgText->setMessageReceiver($message->getMessageTrigger())
                ->setMessageSender($message->getServiceProvider())
                ->setText('Hello,' . $message->getMessageTrigger() . ', Thanks for your support!')
                ->generateXml();
        echo $xml;
    } elseif ($message->getEventKey() == 'V_LANG_PHP') {
        $items = array();
        $items[0] = new NewsItem();
        $items[0]->setTitle('PHPChina.COM')
             ->setDescription('这是一个不可告人的秘密，不要对别人讲')
             ->setPicUrl('http://www.phpchina.com/templets/default/images/logoArea_logo.gif')
             ->setUrl('http://www.phpchina.com/tags/PHP');
        $items[1] = new NewsItem();
        $items[1]->setTitle('Google劈腿MySQL，恋上MariaDB')
                 ->setDescription('Google劈腿MySQL，恋上MariaDB')
                 ->setUrl('http://www.phpchina.com/archives/view-43113-1.html');
        $news = new News();
        $items[2] = new NewsItem();
        $items[2]->setTitle('俄罗斯系软件Nginx将统治互联Í?？')
                 ->setDescription('俄罗斯系软件Nginx将统治互联网？')
                 ->setUrl('http://www.phpchina.com/archives/view-43102-1.html');
        $news = new News();
        $xml = $news->setMessageReceiver($message->getMessageTrigger())
                    ->setMessageSender($message->getServiceProvider())
                    ->setNewsItems($items)
                    ->generateXml();
        file_put_contents("./logs/run.log", $xml . "\n", FILE_APPEND);
        echo $xml;
    } elseif ($message->getEventKey() == 'V_LANG_JAVA') {
        // Click Button 'V_LANG_JAVA'
    }
} elseif ($message instanceof Geo) {
    // 用户对话开启上报地理位置功能或对话中每5分钟上报一次地理位置功能后收到Geo对象消息
    $msgText = new Text();
    $xml = $msgText->setMessageReceiver($message->getMessageTrigger())
            ->setMessageSender($message->getServiceProvider())
            ->setText('我们已收到您的位置，即将奔赴现场！')
            ->generateXml();
    echo $xml;
} elseif ($message instanceof Subscribe || $message instanceof Unsubscribe) {
    // 订阅事件与取消订阅事件
} elseif ($message instanceof QrScene) {
    // 扫描二维码且未关注的用户进行关注触发
} elseif ($message instanceof Scan) {
    // 扫描二维码且已关注的用户进行触发
} elseif ($message instanceof Location) {
    // 用户主动上发当前位置消息，与Geo对象不同(进入对话或对话中间隔触发)，此消息为用户自行发送位置消息
    $msgText = new Text();
    $xml = $msgText->setMessageReceiver($message->getMessageTrigger())
            ->setMessageSender($message->getServiceProvider())
            ->setText('我们已收到您的位置，即将奔赴现场(' . $message->getLabel() . ')！')
            ->generateXml();
    echo $xml;
} elseif ($message instanceof Voice) {
    // 收到语音消息，正常处理
    // $recognition为语音识别结果，需要在接口权限中开启方可读取，否则为空
    $recognition = $message->getRecognition();
    // 通过MediaID可以下载语音文件至本地
    $mediaId = $message->getMediaId();
    $mmVoice = new MMVoice();
    // access_token可以通过Wechat\Client\AccessToken::get($appid, $secret)获取
    $mmVoice->setAccessToken($access_token)->download($mediaId, './download_mm');
    // 业务处理
} elseif ($message instanceof Text) {
    // 收到文本消息
    $text = $message->getContent();
    // 业务处理
} elseif ($message instanceof Image) {
    // 下载MediaID文件同Voice部分
} elseif ($message instanceof Video) {
    // 下载MediaID文件同Voice部分
} elseif ($message instanceof Link) {
    // 获取参数
    $title       = $message->getTitle();
    $description = $message->getDescription();
    $url         = $message->getUrl();
}

/*

$xml = '<xml>
    <ToUserName><![CDATA[toUser]]></ToUserName>
    <FromUserName><![CDATA[FromUser]]></FromUserName>
    <CreateTime>123456789</CreateTime>
    <MsgType><![CDATA[event]]></MsgType>
    <Event><![CDATA[CLICK]]></Event>
    <EventKey><![CDATA[V_GOOD]]></EventKey>
</xml>';



$customMenuEvent = new CustomMenuEvent($xml);
if ($customMenuEvent->getEventKey() == 'V_GOOD') {
    $msgText = new Text();
    $xml = $msgText->setMessageReceiver($customMenuEvent->getMessageTrigger())
            ->setMessageSender($customMenuEvent->getServiceProvider())
            ->setCreateTime()
            ->setMsgType('text')
            ->setText('Hello,Yemulin')
            ->generateXml();
    echo $xml;
}
*/
