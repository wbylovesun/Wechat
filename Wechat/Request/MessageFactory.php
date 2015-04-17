<?php
namespace Wechat\Request;

class MessageFactory
{
    public static function create()
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
        $root   = $roots[0];
        $type   = strtolower((string) $root->MsgType);
        $event  = strtolower((string) $root->Event);
        $evtkey = (string) $root->EventKey;
        
        if ($event) {
            // Event
            switch ($event) {
                case 'subscribe':
                    if ($evtkey) {
                        // subscribe event through qrscene scaning
                        return new Event\QrScene($root);
                    } else {
                        // only subscribe event
                        return new Event\Subscribe($root);
                    }
                break;
                case 'unsubscribe':
                    // unsubscribe event
                    return new Event\Unsubscribe($root);
                break;
                case 'scan':
                    // qrscene scan triggers in attention status
                    return new Event\Scan($root);
                break;
                case 'location':
                    return new Event\Geo($root);
                break;
                case 'click':
                    return new Event\CustomMenu($root);
                break;
            }
        } else {
            // Msg
            switch ($type) {
                case 'text':
                    return new Message\Text($root);
                break;
                case 'image':
                    return new Message\Image($root);
                break;
                case 'voice':
                    return new Message\Voice($root);
                break;
                case 'video':
                    return new Message\Video($root);
                break;
                case 'location':
                    return new Message\Location($root);
                break;
                case 'link':
                    return new Message\Link($root);
                break;
            }
        }
        
        throw new Exception\UnknownXmlException("Unsupported Message");
    }
}