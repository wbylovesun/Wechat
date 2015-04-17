<?php
require_once 'autoload.php';

use Wechat\Request\MessageFactory as Message;
use Wechat\Response\Passive\News;
use Wechat\Response\Passive\NewsItem;

$items = array();
$items[0] = new NewsItem();
$items[0]->setTitle('С��Note��ɫ������׷�')
     ->setDescription('����һ�����ɸ��˵����ܣ���Ҫ�Ա��˽�')
     ->setPicUrl('http://c1.mifile.cn/f/i/g/2015/cn-index/042101kfgm.jpg')
     ->setUrl('http://www.phpchina.com/tags/PHP');
$items[1] = new NewsItem();
$items[1]->setTitle('Google����MySQL������MariaDB')
         ->setDescription('Google����MySQL������MariaDB')
         ->setUrl('http://www.phpchina.com/archives/view-43113-1.html');
$items[2] = new NewsItem();
$items[2]->setTitle('����˹ϵ���Nginx��ͳ�λ�������')
         ->setDescription('����˹ϵ���Nginx��ͳ�λ�������')
         ->setUrl('http://www.phpchina.com/archives/view-43102-1.html');
$news = new News();
$xml = $news->setMessageReceiver($message->getMessageTrigger())
            ->setMessageSender($message->getServiceProvider())
            ->setNewsItems($items)
            ->generateXml();
echo $xml;