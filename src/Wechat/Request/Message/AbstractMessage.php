<?php
namespace Wechat\Request\Message;

use Wechat\Request\BaseMessage;

abstract class AbstractMessage extends BaseMessage
{
    protected $msgid = null;
    
    protected function fields()
    {
        $arrFields = parent::fields();
        $arrFields['MsgId'] = 'setMessageId';
        return $arrFields;
    }
    
    protected function setMessageId($msgid)
    {
        $this->msgid = $msgid;
        return $this;
    }
    
    public function getMessageId()
    {
        return $this->msgid;
    }
}