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
    use EventKeyTrait;
    
    protected function fields()
    {
        $arrFields = parent::fields();
        $arrFields['EventKey'] = 'setEventKey';
        return $arrFields;
    }
}