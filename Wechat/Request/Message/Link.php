<?php
namespace Wechat\Request\Message;

class Link extends AbstractMessage
{
    protected $title       = null;
    protected $description = null;
    protected $url         = null;
    
    protected function setTitle($title)
    {
        $this->title = (string) $title;
        return $this;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    protected function setDescription($description)
    {
        $this->description = (string) $description;
        return $this;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    protected function setUrl($url)
    {
        $this->url = (string) $url;
        return $this;
    }
    
    public function getUrl()
    {
        return $this->url;
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
            case 'Title':
                $this->setTitle($element);
            break;
            case 'Description':
                $this->setDescription($element);
            break;
            case 'Url':
                $this->setUrl($element);
            break;
            case 'MsgId':
                $this->setMessageId($element);
            break;
        }
    }
}