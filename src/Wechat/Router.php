<?php
namespace Wechat;

use Wechat\Request\Message\AbstractMessage;

class Router
{
    private static $_root, $_type, $_event, $_evtKey;
    
    public static function dispatch(AbstractMessage $message)
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
        self::$_type   = strtolower((string) $root->MsgType);
        self::$_event  = strtolower((string) $root->Event);
        self::$_evtkey = (string) $root->EventKey;
    }
    
    private static function dispatchEvent()
    {
        switch (self::$_event) {
            case 'subscribe':
                if (self::$_evtkey) {
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