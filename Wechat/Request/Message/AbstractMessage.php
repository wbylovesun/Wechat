<?php
namespace Wechat\Request\Message;

use Wechat\Request\AbstractRequest;

abstract class AbstractMessage extends AbstractRequest
{
    protected $msgid = null;
    
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