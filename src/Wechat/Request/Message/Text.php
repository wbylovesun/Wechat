<?php
namespace Wechat\Request\Message;

class Text extends AbstractMessage
{
    protected $content = null;
    
    protected function setContent($content)
    {
        $this->content = (string) $content;
        return $this;
    }
    
    public function getContent()
    {
        return $this->content;
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
            case 'Content':
                $this->setContent($element);
            break;
            case 'MsgId':
                $this->setMessageId($element);
            break;
        }
    }
}