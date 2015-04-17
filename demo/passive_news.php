<?php
require_once 'autoload.php';

use Wechat\Request\MessageFactory as Message;
use Wechat\Response\Passive\News;
use Wechat\Response\Passive\NewsItem;

$items = array();
$items[0] = new NewsItem();
$items[0]->setTitle('小米Note黑色纪念版首发')
     ->setDescription('这是一个不可告人的秘密，不要对别人讲')
     ->setPicUrl('http://c1.mifile.cn/f/i/g/2015/cn-index/042101kfgm.jpg')
     ->setUrl('http://www.phpchina.com/tags/PHP');
$items[1] = new NewsItem();
$items[1]->setTitle('Google劈腿MySQL，恋上MariaDB')
         ->setDescription('Google劈腿MySQL，恋上MariaDB')
         ->setUrl('http://www.phpchina.com/archives/view-43113-1.html');
$items[2] = new NewsItem();
$items[2]->setTitle('俄罗斯系软件Nginx将统治互联网？')
         ->setDescription('俄罗斯系软件Nginx将统治互联网？')
         ->setUrl('http://www.phpchina.com/archives/view-43102-1.html');
$news = new News();
$xml = $news->setMessageReceiver($message->getMessageTrigger())
            ->setMessageSender($message->getServiceProvider())
            ->setNewsItems($items)
            ->generateXml();
echo $xml;