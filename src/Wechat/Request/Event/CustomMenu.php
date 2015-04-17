<?php
/**
 * <xml>
 * <ToUserName><![CDATA[toUser]]></ToUserName>
 * <FromUserName><![CDATA[FromUser]]></FromUserName>
 * <CreateTime>123456789</CreateTime>
 * <MsgType><![CDATA[event]]></MsgType>
 * <Event><![CDATA[CLICK]]></Event>
 * <EventKey><![CDATA[EVENTKEY]]></EventKey>
 * </xml>
 */
namespace Wechat\Request\Event;

class CustomMenu extends AbstractEvent
{
    protected $eventKey = null;
    
    protected function setEventKey($eventKey)
    {
        $this->eventKey = $eventKey;
        return $this;
    }
    
    public function getEventKey()
    {
        return $this->eventKey;
    }
    
    protected function setRequestParam($param, $element)
    {
        switch ($param) {
            case 'ToUserName':
                $this->setServiceProvider($element);
            break;
            case 'FromUserName':
                $this->setMessageTrigger($element);
            break;
            case 'CreateTime':
                $this->setCreateTime($element);
            break;
            case 'MsgType':
                $this->setMsgType($element);
            break;
            case 'Event':
                $this->setEvent($element);
            break;
            case 'EventKey':
                $this->setEventKey($element);
            break;
        }
    }
}