<?php
namespace Wechat\Request;

class MessageFactory
{
    private static $_root, $_type, $_event, $_evtKey;
    
    public static function create()
    {
        self::load();
        
        $message = null;
        if (self::$_event) {
            $message = self::dispatchEvent();
        } else {
            $message = self::dispatchMessage();
        }
        
        return $message;
    }
    
    private static function load()
    {
        $data = '';
        $f = fopen("php://input", "r");
        while ($s = fgets($f, 1024)) {
            $data .= $s;
        }
        /*$data = '<xml><ToUserName><![CDATA[airnet_mk]]></ToUserName><FromUserName><![CDATA[oh-Zxt-XCKQj1-aiBNGhMMepXg7Y]]></FromUserName><CreateTime>1429268143</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[abcdefg]]></Content><MsgId>234141234123413241234214122414</MsgId></xml>';*/
        if (!$data) {
            throw new Exception\InvalidXmlException("invalid data while reading");
        }
        $doc = @simplexml_load_string($data);
        if (!$doc) {
            throw new Exception\InvalidXmlException("invalid xml");
        }
        $roots = $doc->xpath('/xml');
        if (!$roots) {
            throw new Exception\InvalidXmlException("invalid xml format");
        }
        self::$_root   = $roots[0];
        self::$_type   = strtolower((string) self::$_root->MsgType);
        self::$_event  = strtolower((string) self::$_root->Event);
        self::$_evtKey = (string) self::$_root->EventKey;
    }
    
    private static function dispatchEvent()
    {
        switch (self::$_event) {
            case 'subscribe':
                if (self::$_evtKey) {
                    // subscribe event through qrscene scaning
                    return new Event\QrScene(self::$_root);
                } else {
                    // only subscribe event
                    return new Event\Subscribe(self::$_root);
                }
            break;
            case 'unsubscribe':
                // unsubscribe event
                return new Event\Unsubscribe(self::$_root);
            break;
            case 'scan':
                // qrscene scan triggers in attention status
                return new Event\Scan(self::$_root);
            break;
            case 'location':
                return new Event\Geo(self::$_root);
            break;
            case 'click':
                return new Event\CustomMenu(self::$_root);
            break;
        }
    }
    
    private static function dispatchMessage()
    {
        switch (self::$_type) {
            case 'text':
                return new Message\Text(self::$_root);
            break;
            case 'image':
                return new Message\Image(self::$_root);
            break;
            case 'voice':
                return new Message\Voice(self::$_root);
            break;
            case 'video':
                return new Message\Video(self::$_root);
            break;
            case 'location':
                return new Message\Location(self::$_root);
            break;
            case 'link':
                return new Message\Link(self::$_root);
            break;
        }
    }
}