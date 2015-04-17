<?php
require_once 'autoload.php';

use Wechat\Client\CustomMenu\CustomMenu;
use Wechat\Client\CustomMenu\ClickButton;
use Wechat\Client\CustomMenu\ViewButton;

$customMenu = new CustomMenu();

$button = new ClickButton('PHP', 'V_LANG_PHP');
$customMenu->addButton($button);

$button = new ClickButton('JAVA', 'V_LANG_JAVA');
$customMenu->addButton($button);

$button = new ClickButton('其它语言');

$subButton = new ViewButton('Html', 'http://www.jiangsugqt.org/');
$button->addSubButton($subButton);

$subButton = new ClickButton('赞一下我们', 'V_GOOD');
$button->addSubButton($subButton);

$customMenu->addButton($button);

$json = $customMenu->toJson();

$result = $customMenu->setAccessToken($token)
                     ->create($json);

if ($result === false) {
    echo $customMenu->getErrCode();
} else {
    echo 'OK';
}